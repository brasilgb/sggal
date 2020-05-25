<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureEstoqueOvos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueOvos`;            
CREATE PROCEDURE `SP_AtualizaEstoqueOvos` (
IN `SP_periodo` INT(10),
IN `SP_lote` INT(10),
IN `SP_incubaveis` INT(10),
IN `SP_comerciais` INT(10),
IN `SP_total` INT(10)
)

BEGIN
declare contador int(10);
select count(*) into contador from estoque_ovos where lote_id = SP_lote;

if contador > 0 then
update estoque_ovos set 
periodo = SP_periodo, 
lote_id = SP_lote, 
incubaveis = incubaveis + SP_incubaveis, 
comerciais = comerciais + SP_comerciais,
postura_dia = postura_dia + SP_total
where lote_id = SP_lote;
else
insert into estoque_ovos (
periodo,
lote_id, 
incubaveis, 
comerciais,
postura_dia
) values(
SP_periodo,
SP_lote,
SP_incubaveis, 
SP_comerciais,
SP_total
);
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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueOvos`');
    }

}
