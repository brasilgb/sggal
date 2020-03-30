<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateAve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_update_aves` AFTER UPDATE ON `aves`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.lote_id, 
      old.femea - new.femea, 
      old.macho - new.macho,
      old.tot_ave - new.tot_ave
      );
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
        DB::unprepared('DROP TRIGGER `TRG_update_aves`');
    }
}
