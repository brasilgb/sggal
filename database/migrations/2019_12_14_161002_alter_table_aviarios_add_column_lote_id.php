<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAviariosAddColumnLoteId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aviarios', function (Blueprint $table) {
            $table->unsignedBigInteger('lote_id')->after('id_aviario');
            $table->foreign('lote_id')->references('id_lote')->on('lotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aviarios', function (Blueprint $table) {
            $table->dropForeign('aviarios_lote_id_foreign');
            $table->dropColumn('lote_id');
        });
    }
}
