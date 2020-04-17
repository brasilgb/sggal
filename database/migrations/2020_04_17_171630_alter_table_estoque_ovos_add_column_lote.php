<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEstoqueOvosAddColumnLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estoque_ovos', function (Blueprint $table) {
            $table->integer('lote')->after('periodo');
            $table->foreign('lote')->references('id_lote')->on('lotes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estoque_ovos', function (Blueprint $table) {
            $table->dropForeign('ovos_lote_foreign');
            $table->dropColumn('lote');
        });
    }
}
