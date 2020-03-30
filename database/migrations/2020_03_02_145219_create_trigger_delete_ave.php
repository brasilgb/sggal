<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteAve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_delete_aves` AFTER DELETE ON `aves` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.lote_id, 
      old.femea, 
      old.macho,
      old.tot_ave
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
        DB::unprepared('DROP TRIGGER `TRG_delete_aves`');
    }
}
