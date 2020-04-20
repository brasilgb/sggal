<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteEnvio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_delete_envios` AFTER DELETE ON `envios` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueOvos (
      old.id_aviario, 
      old.periodo, 
      old.lote_id, 
      old.incubaveis, 
      old.comerciais,
      old.postura_dia
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
    public function down()
    {
        DB::unprepared('DROP TRIGGER `TRG_delete_envios`');
    }
}
