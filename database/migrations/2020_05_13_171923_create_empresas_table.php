<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id_empresa');
            $table->text('logotipo');
            $table->char('cnpj', 50);
            $table->char('razao_social', 50);
            $table->char('endereco', 50);
            $table->char('cidade', 50);
            $table->char('uf', 2);
            $table->char('telefone', 15);
            $table->char('email', 50);
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
        Schema::dropIfExists('empresas');
    }
}
