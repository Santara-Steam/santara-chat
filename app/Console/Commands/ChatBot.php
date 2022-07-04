<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Utils;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\Promise\settle;

class ChatBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:bot {user} {group} {total}';

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
    public function __construct(
    )
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
        $nbPages = $this->argument('total');

        $responses = Http::pool(function (Pool $pool) use ($nbPages) {
            return collect()
                ->range(1, $nbPages)
                ->map(
                    fn($page) => $pool->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'BotTesting' => 1
                    ])->post(env('APP_URL') . "/api/send-bot-message", [
                        'to_id' => $this->argument('group'),
                        'is_group' => 1,
                        'user_id' => $this->argument('user'),
                        'message' => 'test Async => ' . $page
                    ])
                );
        });
    }
}
