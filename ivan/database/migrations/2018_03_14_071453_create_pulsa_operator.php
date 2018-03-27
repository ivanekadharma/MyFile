<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePulsaOperator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pulsa_operators', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_provider')->unsigned();
            $table->integer('kode_provider');
            $table->timestamps(); // ini sama aja bikin created at sama updated at
            $table->foreign('id_provider')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulsa_operators');
    }
}
