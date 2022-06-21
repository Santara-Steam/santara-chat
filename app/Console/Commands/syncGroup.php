<?php

namespace App\Console\Commands;

use App\Models\Conversation;
use App\Models\Group;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

        $emitensActive = DB::connection('mysql2')
            ->table('emitens')
            ->where('is_active', '=', true)
            ->where('last_emiten_journey', '!=', 'PRA PENAWARAN SAHAM')
            ->Where('last_emiten_journey', '!=', 'PENAWARAN SAHAM')
            ->get(['id', 'company_name', 'pictures', 'trademark']);

        $this->info("Found " . $emitensActive->count() . " Emitens...");
        $this->info("Ready to executing...");

        foreach ($emitensActive as $emiten) {
            $db = DB::connection('mysql');

            $groupExist = $db->table('groups')
                ->where('emiten_id', $emiten->id)
                ->first();

            if (!$groupExist) {
                $this->info("Creating group with emiten ID [". $emiten->id . "] ...");
                $db->table('groups')
                    ->insert([
                        "id" => $emiten->id,
                        "name" => $emiten->company_name,
                        "description" => $emiten->trademark,
                        "photo_url" => $emiten->pictures,
                        "emiten_id" => $emiten->id,
                        "privacy" => 2,
                        "group_type" => 2,
                        "created_by" => 1,
                        "created_at" => now()->format('Y-m-d H:i:s'),
                        "updated_at" => now()->format('Y-m-d H:i:s')
                    ]);
                $this->info("group created");
                $db->table('conversations')->insert([
                    'to_type' => Group::class,
                    'to_id' => $emiten->id,
                    'message' => "Group created...",
                    'message_type' => Conversation::MESSAGE_TYPE_BADGES,
                    "created_at" => now()->format('Y-m-d H:i:s'),
                    "updated_at" => now()->format('Y-m-d H:i:s')
                ]);

            } else {
                $this->warn("groups with emiten ID [" . $emiten->id . "] already exist, skipped...");
            }
        }
    }
}
