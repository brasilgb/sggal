<?php

use Illuminate\Database\Migrations\Migration;

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
IN `SP_aviario` INT(10),
IN `SP_periodo` INT(10),
IN `SP_lote` INT(10),
IN `SP_femea` INT(10),
IN `SP_macho` INT(10),
IN `SP_tot_ave` INT(10)
)

BEGIN
declare contador int(10);
select count(*) into contador from estoque_aves where id_aviario = SP_aviario;

if contador > 0 then
update estoque_aves set 
id_aviario = SP_aviario, 
periodo = SP_periodo, 
lote = SP_lote, 
femea = femea + SP_femea, 
macho = macho + SP_macho,
tot_ave = tot_ave + SP_tot_ave
where id_aviario = SP_aviario;
else
insert into estoque_aves (
id_aviario, 
periodo,
lote, 
femea, 
macho,
tot_ave
) values(
SP_aviario, 
SP_periodo,
SP_lote,
SP_femea, 
SP_macho,
SP_tot_ave
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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueAves`');
    }

}
