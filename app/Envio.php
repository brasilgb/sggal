<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model {

    protected $primaryKey = 'id_envio';
    public $incrementing = false;
    protected $fillable = [
        'id_envio',
        'data_envio',
        'hora_envio',
        'periodo',
        'lote_id',
        'incubaveis',
        'comerciais',
        'postura_dia'
    ];

    public function lote() {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastenvio() {
        $lastenvio = Envio::orderBy('id_envio', 'desc')->get();

        if ($lastenvio->count() > 0):
            foreach ($lastenvio as $last):
                return $last->id_envio + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
