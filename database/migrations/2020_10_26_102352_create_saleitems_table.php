<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saleitems', function (Blueprint $table) {
            $table->bigInteger('sale_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();

            $table->decimal('price');
            $table->integer('empl_commision')->nullable();
                     
            $table->decimal('expences')->nullable();
            
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('saleitems');
    }
}
