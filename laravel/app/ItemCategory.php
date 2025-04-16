<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = ['name'];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
