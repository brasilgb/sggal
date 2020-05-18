<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id_email');
            $table->char('smtp', 50);
            $table->char('porta', 50);
            $table->char('seguranca', 50);
            $table->char('usuario', 50);
            $table->char('senha', 50);
            $table->char('remetente', 50);
            $table->text('destino_coleta');
            $table->text('destino_semanal');
            $table->char('assunto', 50);
            $table->text('mensagem');
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
        Schema::dropIfExists('emails');
    }
}
