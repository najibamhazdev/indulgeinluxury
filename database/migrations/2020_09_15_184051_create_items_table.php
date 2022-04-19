<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('maincategory')->unsigned();
            $table->bigInteger('subcategory')->unsigned();
            $table->bigInteger('brand')->nullable();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
            $table->foreign('category')->references('id')->on('categories');
            $table->foreign('brand')->references('id')->on('brands');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
