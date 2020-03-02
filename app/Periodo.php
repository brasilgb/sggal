<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $primaryKey = 'id_periodo';
    
    protected $fillable = [
        'ativo',
        'desativacao'
    ];
    
    public function periodoativo(){
        $periodo = Periodo::where('ativo', 1)->get();
        
        foreach ($periodo as $p):
            return $p->id_periodo;
        endforeach;
    }
}
