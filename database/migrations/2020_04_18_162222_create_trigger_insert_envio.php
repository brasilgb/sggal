<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertEnvio extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_insert_envios` AFTER INSERT ON `envios` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.id_aviario, 
      new.periodo, 
      new.lote_id, 
      new.incubaveis * -1, 
      new.comerciais * -1,
      new.postura_dia * -1
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
        DB::unprepared('DROP TRIGGER `TGR_insert_envios`');
    }

}
