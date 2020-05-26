<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $primaryKey = 'id_periodo';
    public $incrementing = false;
    protected $fillable = [
        'id_periodo',
        'semana_inicial',
        'semana_final',
        'data_inicial',
        'ativo',
        'desativacao'
    ];
    
    public function lastperiodo() {
        $lastperiodo = Periodo::orderBy('id_periodo', 'desc')->get();

        if ($lastperiodo->count() > 0):
            foreach ($lastperiodo as $last):
                return $last->id_periodo + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
    
    public function periodoativo(){
        $periodo = Periodo::where('ativo', 1)->get();
        
        foreach ($periodo as $p):
            return $p->id_periodo;
        endforeach;
    }
}
