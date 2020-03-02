<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureEstoqueAves extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueAves`;
                CREATE PROCEDURE `SP_AtualizaEstoqueAves` (
IN `SP_id_ave` INT(10),
IN `SP_lote` INT(10),
IN `SP_aviario` INT(10),
IN `SP_femea` INT(10),
IN `SP_macho` INT(10))

BEGIN
declare contador int(10);
select count(*) into contador from estoque_ave where id_estoque = SP_id_ave;

if contador > 0 then
update estoque_ave set lote = SP_lote, aviario = SP_aviario, femea = femea + SP_femea, macho = macho + SP_macho where id_estoque = SP_id_ave;
else
insert into estoque_ave (id_estoque, lote, aviario, femea, macho) values(SP_id_ave, SP_lote, SP_aviario, SP_femea, SP_macho);
end if;
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
//        Schema::dropIfExists('procedure_estoque_aves');
    }

}
