<?php

namespace App\Console\Commands;

use App\Helpers\AuthHelper;
use App\Models\Conversation;
use App\Models\emitens_old;
use App\Models\Group;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class syncGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:group';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $chatRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Running...");

//        $emitensActive = DB::connection('mysql2')
//            ->table('emitens')
//            ->join('emiten_journeys','emitens.id', '=', 'emiten_journeys.emiten_id')
//            ->where('emitens.is_active', '=', true)
//            ->groupBy('emiten_journeys.emiten_id')
////            ->where('last_emiten_journey', '!=', 'PRA PENAWARAN SAHAM')
////            ->Where('last_emiten_journey', '!=', 'PENAWARAN SAHAM')
//            ->get(['emitens.id', 'emitens.company_name', 'emitens.pictures', 'emitens.trademark']);
//        dd($emitensActive->toArray());

        $emitensActive = emitens_old::select('emitens.*','categories.category as ktg', DB::raw("SUM(Distinct(devidend.devidend)) as dvd"),  DB::raw("COUNT(Distinct(devidend.id)) as dvc"))
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('devidend', 'devidend.emiten_id','=','emitens.id')
            ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
            // ->where('emitens.is_deleted',0)
            // ->whereRaw('emitens.end_period < now()')
            ->orderby('emitens.id','DESC')
            ->groupBy('emitens.id')
            ->havingRaw('CONVERT(ROUND(
            IF(
              (SUM(
                IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                  (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
                    and
                    emitens.is_deleted = 0
                    and emitens.is_active = 1
                    and emitens.begin_period < now()')
            ->get();
        dd($em->map(function ($value){
            return [
                "id" =>$value->id,
                "name" => $value->company_name
            ];
        })->toArray());

        $this->info("Found " . $emitensActive->count() . " Emitens...");
        $this->info("Ready to executing...");

        foreach ($emitensActive as $emiten) {
            $db = DB::connection('mysql');

            $groupExist = $db->table('groups')
                ->where('emiten_id', $emiten->id)
                ->first();

            if (!$groupExist) {
                $this->info("Creating group with emiten ID [". $emiten->id . "] ...");
                $response = Http::withHeaders([
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                    "email" => "admin@gmail.com",
                    "password" => "12345678",
                ])->post('http://localhost:8888/api/groups', [
                    "name" => $emiten->company_name,
                    "description" => $emiten->trademark,
                    "group_type" => 1, //closed group
                    "privacy" => 2,
                    "photo_url" => $emiten->pictures,
                    "users" => [1],
                    "emiten_id" => $emiten->id
                ])->json();
                $this->info("group created successfully");

            } else {
                $this->warn("groups with emiten ID [" . $emiten->id . "] already exist, skipped...");
            }
        }
    }
}
