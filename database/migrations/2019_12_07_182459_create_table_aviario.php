<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAviario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviarios', function (Blueprint $table) {
            $table->bigIncrements('id_aviario');
            $table->date('data_aviario');
            $table->string('aviario');
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
            $table->integer('tot_aves');
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
        Schema::dropIfExists('aviarios');
    }
}
