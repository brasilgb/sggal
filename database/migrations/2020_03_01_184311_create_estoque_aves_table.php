<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueAvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_ave', function (Blueprint $table) {
            $table->bigIncrements('id_estoque');
            $table->integer('lote');
            $table->integer('aviario');
            $table->integer('femea');
            $table->integer('macho');
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
        Schema::dropIfExists('table_estoque_aves');
    }
}