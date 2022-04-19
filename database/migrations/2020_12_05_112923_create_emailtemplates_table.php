<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailtemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *'name','headertext','footertext','photo','titlephoto','textafterphoto','footerphoto','textafterfooterphoto','color'
     * @return void
     */
    public function up()
    {
        Schema::create('emailtemplates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('titlephoto')->nullable();
            $table->bigtext('headertext')->nullable();
            $table->string('photo')->nullable();
            $table->bigtext('textafterphoto')->nullable();
            $table->string('footerphoto')->nullable();
            $table->bigtext('footertext')->nullable();
            $table->bigtext('textafterfooterphoto')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('emailtemplates');
    }
}
