<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteColeta extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_delete_coletas` AFTER DELETE ON `coletas` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueOvos (
      old.periodo, 
      old.lote_id, 
      old.incubaveis * -1, 
      old.comerciais * -1,
      old.postura_dia * -1
      )
      ;
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER `TRG_delete_coletas`');
    }

}
