<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlientikartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klientikartes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('klients_id')->nullable()->references('id')->on('users');
            $table->decimal('numurs', 16, 0);
            $table->decimal('CVC', 3, 0);
            $table->date('termins_lidz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klientikartes');
    }
}
