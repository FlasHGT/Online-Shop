<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasutijumiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasutijumi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('klients_id')->references('id')->on('users');
            $table->foreignId('adrese_id')->references('id')->on('adreses');
            $table->foreignId('klientakarte_id')->references('id')->on('klientikartes');
            $table->date('izpildes_datums');
            $table->double('cena');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasutijumi');
    }
}
