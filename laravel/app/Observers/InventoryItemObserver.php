<?php

namespace App\Observers;

use App\InventoryItem;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class InventoryItemObserver
{
    public function created(InventoryItem $InventoryItem): void
    {
             $data = [
            'name' => 'Test User',
            'message' => 'created.'
        ];

        Mail::to('recipient@example.com')->send(new TestMail($data));

    }


    public function updated(InventoryItem $InventoryItem): void
    {
             $data = [
            'name' => 'Test User',
            'message' => 'updated'
        ];

        Mail::to('recipient@example.com')->send(new TestMail($data));

    }


    public function deleted(InventoryItem $InventoryItem): void
    {
             $data = [
            'name' => 'Test User',
            'message' => 'deleted'
        ];

        Mail::to('recipient@example.com')->send(new TestMail($data));

    }


    public function restored(InventoryItem $InventoryItem): void
    {


    }

    public function forceDeleted(InventoryItem $InventoryItem): void
    {

    }
}
