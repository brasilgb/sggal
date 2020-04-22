<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    protected $primarykey = 'id_peso';
    public $incrementing = false;
    protected $fillable =[
        'id_peso',
        'data_peso',
        'periodo',
        'semana',
        'lote_id',
        'aviario_id',
        'sexo',
        'peso'
    ];
    
    public function lote() {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function lastpeso() {
        $lastpeso = Peso::orderBy('id_peso', 'desc')->get();

        if ($lastpeso->count() > 0):
            foreach ($lastpeso as $last):
                return $last->id_peso + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
    
    public function numaviario($idaviario){
        $aviarios = Aviario::where('id_aviario', $idaviario)->get();
        foreach ($aviarios as $aviario){
            return $aviario->aviario;
        }
    }
}
