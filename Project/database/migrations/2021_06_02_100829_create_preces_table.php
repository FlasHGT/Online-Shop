<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('kategorija_id')->references('id')->on('kategorijas');
            $table->string('nosaukums');
            $table->string('apraksts');
            $table->double('cena');
            $table->double('sakuma_cena');
            $table->integer('atlaides_procenti')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preces');
    }
}
