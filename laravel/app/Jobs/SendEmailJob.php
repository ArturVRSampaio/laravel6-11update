<?php

namespace App\Jobs;

use App\Mail\TestMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle():void
    {

        $data = [
            'name' => 'Test User',
            'message' => 'This is a test message.'
        ];

        Mail::to('recipient@example.com')->send(new TestMail($data));

    }
}
