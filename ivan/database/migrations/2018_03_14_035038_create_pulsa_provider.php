<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePulsaProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pulsa_providers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('pulsa_id')->unsigned();
            $table->string('flag');
            $table->integer('nominal');
            $table->integer('harga');
            //$table('pulsa_provider')->pulsa_id=$table('pulsa_coba')->
            $table->timestamps();
            $table->foreign('pulsa_id')->references('id')->on('providers');
        });
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulsa_providers');

    }
}
