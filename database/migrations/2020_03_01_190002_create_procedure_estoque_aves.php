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
IN `SP_periodo` INT(10),
IN `SP_lote` INT(10),
IN `SP_aviario` INT(10),
IN `SP_box1_femea` INT(10),
IN `SP_box1_macho` INT(10),
IN `SP_box2_femea` INT(10),
IN `SP_box2_macho` INT(10),
IN `SP_box3_femea` INT(10),
IN `SP_box3_macho` INT(10),
IN `SP_box4_femea` INT(10),
IN `SP_box4_macho` INT(10),
IN `SP_tot_femea` INT(10),
IN `SP_tot_macho` INT(10),
IN `SP_tot_ave` INT(10)
)

BEGIN
declare contador int(10);
select count(*) into contador from estoque_ave where id_estoque = SP_id_ave;

if contador > 0 then
update estoque_ave set 
lote = SP_lote, 
periodo = SP_periodo, 
aviario = SP_aviario, 
box1_femea = box1_femea + SP_box1_femea, 
box1_macho = box1_macho + SP_box1_macho, 
box2_femea = box2_femea + SP_box2_femea, 
box2_macho = box2_macho + SP_box2_macho, 
box3_femea = box3_femea + SP_box3_femea, 
box3_macho = box3_macho + SP_box3_macho, 
box4_femea = box4_femea + SP_box4_femea, 
box4_macho = box4_macho + SP_box4_macho,
tot_femea = tot_femea + SP_tot_femea, 
tot_macho = tot_macho + SP_tot_macho,
tot_ave = tot_ave + SP_tot_ave
where id_estoque = SP_id_ave;
else
insert into estoque_ave (
id_estoque,
periodo,
lote, 
aviario, 
box1_femea, 
box1_macho,
box2_femea, 
box2_macho,
box3_femea, 
box3_macho,
box4_femea, 
box4_macho,
tot_femea, 
tot_macho,
tot_ave
) values(
SP_id_ave, 
SP_periodo,
SP_lote, 
SP_aviario, 
SP_box1_femea, 
SP_box1_macho,
SP_box2_femea, 
SP_box2_macho,
SP_box3_femea, 
SP_box3_macho,
SP_box4_femea, 
SP_box4_macho,
SP_tot_femea, 
SP_tot_macho,
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
