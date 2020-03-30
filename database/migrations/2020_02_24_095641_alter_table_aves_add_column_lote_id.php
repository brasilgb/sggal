<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAvesAddColumnLoteId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aves', function (Blueprint $table) {
            $table->integer('lote_id')->after('id_ave');
            $table->foreign('lote_id')->references('id_lote')->on('lotes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aves', function (Blueprint $table) {
            $table->dropForeign('aves_lote_id_foreign');
            $table->dropColumn('lote_id');
        });
    }
}