<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateEnvio extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_update_envios` AFTER UPDATE ON `envios`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.periodo, 
      new.lote_id, 
      old.incubaveis - new.incubaveis, 
      old.comerciais - new.comerciais,
      old.postura_dia - new.postura_dia
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
        DB::unprepared('DROP TRIGGER `TGR_update_envios`');
    }

}
