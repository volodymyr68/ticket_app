<?php

namespace App\Console;

use App\Events\SendMessageEvent;
use Illuminate\Console\Command;

class testCommand extends Command
{
    protected $signature = 'test_command';

    protected $description = 'Command description';

    public function handle(): void
    {
        $data = ['chat_id' => 2, 'sender_id' => 2, 'message' => "test message"];
        broadcast(new SendMessageEvent($data));
        $this->info('Message sent successfully.');
    }
}
