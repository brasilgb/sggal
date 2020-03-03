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
            $table->integer('periodo');
            $table->integer('lote');
            $table->integer('aviario');
            $table->integer('box1_femea');
            $table->integer('box1_macho');
            $table->integer('box2_femea');
            $table->integer('box2_macho');
            $table->integer('box3_femea');
            $table->integer('box3_macho');
            $table->integer('box4_femea');
            $table->integer('box4_macho');
            $table->integer('tot_femea');
            $table->integer('tot_macho');
            $table->integer('tot_ave');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
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
