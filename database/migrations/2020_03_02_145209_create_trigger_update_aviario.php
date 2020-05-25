<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateAviario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_update_aviarios` AFTER UPDATE ON `aviarios`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.lote_id, 
      new.femea - old.femea, 
      new.macho - old.macho,
      new.tot_ave - old.tot_ave
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
        DB::unprepared('DROP TRIGGER `TRG_update_aviarios`');
    }
}
