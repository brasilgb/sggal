<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
CREATE TRIGGER `TRG_update_aves` AFTER UPDATE ON `aviarios`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.lote_id, 
      new.aviario, 
      new.box1_femea - old.box1_femea, 
      new.box1_macho - old.box1_macho,
      new.box2_femea - old.box2_femea, 
      new.box2_macho - old.box2_macho,
      new.box3_femea - old.box3_femea, 
      new.box3_macho - old.box3_macho,
      new.box4_femea - old.box4_femea, 
      new.box4_macho - old.box4_macho,
      new.tot_femea - old.tot_femea, 
      new.tot_macho - old.tot_macho,
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
        DB::unprepared('DROP TRIGGER `TRG_update_aves`');
    }
}
