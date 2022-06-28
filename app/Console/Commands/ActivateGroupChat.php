<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ActivateGroupChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate group chat for all member by cron t+5 after group created';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $groups = Group::active()->get();

        $this->info("get {$groups->count()} groups need to activate");

        foreach ($groups as $group) {
            $this->info("Activate group with emitenID [{$group->emiten_id}] ...");
            $group->is_active = 1;
            $group->save();
            $this->line("Group with emitenID [{$group->emiten_id}] was active!");
        }
    }
}
