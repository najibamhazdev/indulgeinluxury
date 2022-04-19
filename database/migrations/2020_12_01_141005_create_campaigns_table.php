<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('subject');
            
            $table->bigInteger('template')->unsigned();
            $table->boolean('status');
            $table->text('message')->nullable();
            
            $table->timestamps();
            $table->foreign('template')->references('id')->on('emailtemplates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
