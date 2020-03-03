<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
CREATE TRIGGER `TRG_delete_aves` AFTER DELETE ON `aviarios` FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.lote_id, 
      old.aviario, 
      old.box1_femea * -1, 
      old.box1_macho * -1,
      old.box2_femea * -1, 
      old.box2_macho * -1,
      old.box3_femea * -1, 
      old.box3_macho * -1,
      old.box4_femea * -1, 
      old.box4_macho * -1,
      old.tot_femea * -1, 
      old.tot_macho * -1,
      old.tot_ave * -1
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
