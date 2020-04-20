<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateColeta extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_update_coleta` AFTER UPDATE ON `coletas`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.periodo, 
      new.lote_id, 
      new.incubaveis - old.incubaveis, 
      new.comerciais - old.comerciais,
      new.postura_dia - old.postura_dia
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
        Schema::unprepared('DROP TRIGGER `TGR_update_coletas`');
    }

}
