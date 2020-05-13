<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecebimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebimentos', function (Blueprint $table) {
            $table->integer('id_recebimento')->primary();
            $table->integer('periodo');
            $table->date('data_recebimento');
            $table->time('hora_recebimento');
            $table->decimal('femea', 10, 2);
            $table->decimal('macho', 10, 2);
            $table->integer('nota_fiscal');
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
        Schema::dropIfExists('recebimentos');
    }
}
