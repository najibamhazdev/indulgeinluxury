<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestitems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('requestitem_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('requestitem_id')->references('id')->on('clientrequests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestitems');
    }
}
