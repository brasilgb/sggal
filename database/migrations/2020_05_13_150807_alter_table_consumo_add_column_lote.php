<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableConsumoAddColumnLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('consumos', function (Blueprint $table) {
            $table->integer('lote_id')->after('periodo');
            $table->foreign('lote_id')->references('id_lote')->on('lotes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('consumos', function (Blueprint $table) {
            $table->dropForeign('consumos_lote_foreign');
            $table->dropColumn('lote_id');
        });
    }
}
