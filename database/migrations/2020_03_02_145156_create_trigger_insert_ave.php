<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerInsertAve extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
                CREATE TRIGGER `TRG_insert_aves` AFTER INSERT ON `aviarios` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (new.id_aviario, new.lote_id, new.aviario, new.tot_femea, new.tot_macho);
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER `TRG_insert_aves`');
    }

}
