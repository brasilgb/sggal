<?php

namespace App\Racao;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $primaryKey = 'id_consumo';
    public $incrementing = false;
    protected $fillable = [
        'id_consumo',
        'periodo',
        'lote_id',
        'aviario_id',
        'box',
        'data_consumo',
        'femea',
        'macho'
    ];

    public function lote() {
        return $this->belongsTo(\App\Lote::class, 'lote_id');
    }

    public function lastconsumo() {
        $lastconsumo = Consumo::orderBy('id_consumo', 'desc')->get();

        if ($lastconsumo->count() > 0):
            foreach ($lastconsumo as $last):
                return $last->id_consumo + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
