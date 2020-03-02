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
      CALL SP_AtualizaEstoqueAves (new.id_aviario, new.lote_id, new.aviario, new.tot_femea - old.tot_femea, new.tot_macho - old.tot_macho);
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
