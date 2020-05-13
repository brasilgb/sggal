<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRecebimentosAddColumnLote extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('recebimentos', function (Blueprint $table) {
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
        Schema::table('recebimentos', function (Blueprint $table) {
            $table->dropForeign('racoes_lote_foreign');
            $table->dropColumn('lote_id');
        });
    }

}
