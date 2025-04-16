<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{


    public function sendMail()
    {
        $data = [
            'name' => 'Test User',
            'message' => 'This is a test message.'
        ];

        Mail::to('recipient@example.com')->send(new TestMail($data));

        return 'Email sent successfully!';
    }


}
