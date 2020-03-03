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
      CALL SP_AtualizaEstoqueAves (old.id_aviario, old.lote_id, old.aviario, old.tot_femea * -1, old.tot_macho * -1);
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
