<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coleta extends Model {

    protected $prymarykey = 'id_coleta';
    public $incrementing = false;
    protected $fillable = [
        'id_coleta',
        'id_lote',
        'aviario_id',
        'periodo',
        'data_coleta',
        'hora_coleta',
        'coleta',
        'limpos_ninho',
        'sujos_ninho',
        'cama_incubaveis',
        'duas_gemas',
        'pequenos',
        'trincados',
        'casca_fina',
        'deformados',
        'frios',
        'sujos_nao_aproveitados',
        'esmagados_quebrados',
        'descarte',
        'cama_nao_incubaveis',
        'incubaveis',
        'incubaveis_bons',
        'comerciais',
        'postura_dia'
    ];

    public function lote() {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function nextcoleta($data, $idlote, $idaviario) {
        return Coleta::where('data_coleta', $data)->where('lote_id', $idlote)->where('aviario_id', $idaviario)->orderBy('coleta', 'desc')->first();
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastcoleta() {
        $lascoleta = Coleta::orderBy('id_coleta', 'desc')->get();

        if ($lascoleta->count() > 0):
            foreach ($lascoleta as $last):
                return $last->id_coleta + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
