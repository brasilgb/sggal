<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coletas', function (Blueprint $table) {
            $table->integer('id_coleta')->primary();
            $table->integer('id_lote');
            $table->integer('aviario_id');
            $table->integer('periodo');
            $table->integer('coleta');
            $table->dateTime('data_coleta');
            $table->dateTime('hora_coleta');
            $table->integer('limpos_ninho');
            $table->integer('sujos_ninho');
            $table->integer('cama_incubaveis');
            $table->integer('duas_gemas');
            $table->integer('pequenos');
            $table->integer('trincados');
            $table->integer('casca_fina');
            $table->integer('deformados');
            $table->integer('frios');
            $table->integer('sujos_nao_aproveitados');
            $table->integer('esmagados_quebrados');
            $table->integer('descarte');
            $table->integer('cama_nao_incubaveis');
            $table->integer('incubaveis');
            $table->integer('incubaveis_bons');
            $table->integer('comerciais');
            $table->integer('postura_dia');
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
        Schema::dropIfExists('coletas');
    }
}
