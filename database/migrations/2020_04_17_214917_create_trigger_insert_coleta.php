<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertColeta extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TGR_insert_coletas` AFTER INSERT ON `coletas` 
FOR EACH ROW
BEGIN
                CALL SP_AtualizaEstoqueOvos (
                new.periodo,
                new.lote_id,
                new.incubaveis,
                new.comerciais,
                new.postura_dia
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
        DB::unprepared('DROP TRIGGER `TRG__insert_coletas');
    }

}
