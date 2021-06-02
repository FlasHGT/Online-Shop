<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasutijumiprecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasutijumipreces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('prece_id')->references('id')->on('preces');
            $table->foreignId('pasutijums-id')->references('id')->on('pasutijumi');
            $table->integer('skaits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasutijumipreces');
    }
}
