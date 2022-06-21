<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class syncUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->line("running...");

        $users = DB::connection('mysql2')
            ->table('users')
            ->join('traders', 'users.id', '=', 'traders.user_id')
            ->get(['users.*', 'traders.name']);

        $this->info("Found " . $users->count() . " users on Santara...");

        foreach ($users as $user) {
            $this->line("Search user on chat group...");

            $chatUser = DB::connection('mysql')
                ->table('users')
                ->find($user->id);

            if (!$chatUser) {
                $this->info("User not found, creating...");

                $email = $user->email;

                DB::connection('mysql2')->table('users')
                    ->insert([
                        'id' => $user->id,
                        'name' => $user->name ?: $email,
                        'email' => $email,
                        'email_verified_at' => now()->format('Y-m-d H:i:s'),
                        'password' => $user->password,
                        'is_active' => true,
                    ]);

                $this->info("record with email {$email} created");
            } else {
                $this->warn("User found, skipped..");
            }
        }
    }
}
