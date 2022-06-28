<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;

class DisableGroupChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable group chat for member by cron on end of tuesday & thursday';

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
        $groups = Group::where('group_type', 1)->get();

        $this->info("get {$groups->count()} enabled group..");

        foreach ($groups as $group) {
            $this->info("Disabling group with emitenID [{$group->emiten_id}] ...");
            $group->group_type = 2;
            $group->save();
            $this->line("Group with emitenID [{$group->emiten_id}] was disabled!");
        }
    }
}
