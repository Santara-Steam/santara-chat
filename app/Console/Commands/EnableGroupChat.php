<?php

namespace App\Console\Commands;

use App\Models\Conversation;
use App\Models\Group;
use Illuminate\Console\Command;

class EnableGroupChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable group chat for member by cron on tuesday & thursday';

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
        $groups = Group::where('group_type', 2)->get();

        $this->info("get {$groups->count()} disabled group..");

        foreach ($groups as $group) {
            $this->info("Enabling group with emitenID [{$group->emiten_id}] ...");
            $group->group_type = 1;
            $group->save();
            $this->line("Group with emitenID [{$group->emiten_id}] was enabled!");
        }
    }
}
