<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertAviario extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_insert_aviarios` AFTER INSERT ON `aviarios` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.lote_id, 
      new.femea, 
      new.macho,
      new.tot_ave
      );
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER `TRG_insert_aviarios`');
    }

}
