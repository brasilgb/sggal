<?php

namespace App\Racao;

use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model {

    protected $primaryKey = 'id_recebimento';
    public $incrementing = false;
    protected $fillable = [
        'id_recebimento',
        'periodo',
        'lote_id',
        'data_recebimento',
        'hora_recebimento',
        'femea',
        'macho',
        'nota_fiscal'
    ];

    public function lote() {
        return $this->belongsTo(\App\Lote::class, 'lote_id');
    }

    public function lastrecebimento() {
        $lastrecebimento = Recebimento::orderBy('id_recebimento', 'desc')->get();

        if ($lastrecebimento->count() > 0):
            foreach ($lastrecebimento as $last):
                return $last->id_recebimento + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
