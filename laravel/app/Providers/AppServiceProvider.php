<?php

namespace App\Providers;

use App\InventoryItem;
use App\Observers\InventoryItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        InventoryItem::observe(InventoryItemObserver::class);
        //
    }
}
