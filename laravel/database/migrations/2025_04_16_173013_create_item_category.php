<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('inventory_items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_category_id')->nullable();
            $table->foreign('item_category_id')
                ->references('id')
                ->on('item_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            $table->dropColumn('item_category_id');
        });

        Schema::dropIfExists('item_categories');
    }
}
