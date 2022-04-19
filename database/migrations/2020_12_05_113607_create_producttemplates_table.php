<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducttemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producttemplates', function (Blueprint $table) {
           
            $table->id();
            $table->text('name')->nullable();
            $table->string('posttype')->nullable();
            $table->string('link')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('emailtemplate_id')->unsigned();
            $table->string('price')->nullable();
            
            $table->timestamps();
            $table->foreign('emailtemplate_id')->references('id')->on('emailtemplates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producttemplates');
    }
}
