<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
    ];
}
