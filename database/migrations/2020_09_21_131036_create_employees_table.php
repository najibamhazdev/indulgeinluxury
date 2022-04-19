<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('country')->unsigned();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
          
            $table->date('dob')->nullable();
            $table->decimal('salary')->nullable();
            $table->timestamps();
            $table->foreign('country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
