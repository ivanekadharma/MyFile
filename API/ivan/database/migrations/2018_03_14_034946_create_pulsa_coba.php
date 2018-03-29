<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePulsaCoba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('providers', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            //$table->string('flag');
            $table->timestamps(); // ini sama aja bikin created at sama updated at

        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('providers'); //providers
    }
}
