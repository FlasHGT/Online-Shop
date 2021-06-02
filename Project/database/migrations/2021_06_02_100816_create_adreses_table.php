<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adreses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('klients_id')->references('id')->on('users');
            $table->string('pilseta');
            $table->string('iela');
            $table->integer('majas_nr');
            $table->integer('dzivokla_nr')->nullable();
            $table->string('pasta_indekss', 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adreses');
    }
}
