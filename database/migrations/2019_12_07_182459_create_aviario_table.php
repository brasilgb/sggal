<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAviarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviarios', function (Blueprint $table) {
            $table->integer('id_aviario')->primary();
            $table->integer('periodo');
            $table->date('data_aviario');
            $table->string('aviario');
            $table->integer('femea');
            $table->integer('macho');
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
        Schema::dropIfExists('aviarios');
    }
}
