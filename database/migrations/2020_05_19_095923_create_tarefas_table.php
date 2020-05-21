<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->integer('id_despesa')->primary();
            $table->integer('periodo');
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_previsão');
            $table->time('hora_prrevisao');
            $table->char('titulo');
            $table->text('descricao');
            $table->date('data_termino');
            $table->time('hora_termino');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tarefas');
    }

}
