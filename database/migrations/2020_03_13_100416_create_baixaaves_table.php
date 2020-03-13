<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaixaavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baixaaves', function (Blueprint $table) {
            $table->integer('id_baixa')->primary();
            $table->integer('periodo');
            $table->date('data_baixa');
            $table->string('aviario');
            $table->integer('box1_femea');
            $table->integer('box1_macho');
            $table->integer('box2_femea')->nullable();
            $table->integer('box2_macho')->nullable();
            $table->integer('box3_femea')->nullable();
            $table->integer('box3_macho')->nullable();
            $table->integer('box4_femea')->nullable();
            $table->integer('box4_macho')->nullable();
            $table->integer('tot_femea');
            $table->integer('tot_macho');
            $table->integer('tot_ave');
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
        Schema::dropIfExists('baixaaves');
    }
}
