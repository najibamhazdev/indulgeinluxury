<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('client_id')->unsigned();
            

            $table->decimal('price');
           
            
            $table->date('date')->nullable();
            
            $table->text('details')->nullable();
            $table->text('shipping_to')->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->timestamps();
           
            $table->foreign('client_id')->references('id')->on('clients');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
