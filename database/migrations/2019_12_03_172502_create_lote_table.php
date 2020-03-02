<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->integer('id_lote')->primary();
            $table->integer('periodo');
            $table->date('data_lote');
            $table->string('lote', 50);
            $table->integer('femea');
            $table->integer('macho');
            $table->integer('femea_capitalizada')->nullable();
            $table->integer('macho_capitalizado')->nullable();
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
        Schema::dropIfExists('lotes');
    }
}
