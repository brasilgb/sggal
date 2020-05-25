<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lote;
class Coleta extends Model {
    
    protected $primaryKey = 'id_coleta';
    public $incrementing = false;
    protected $fillable = [
        'id_coleta',
        'lote_id',
        'id_aviario',
        'periodo',
        'coleta',
        'data_coleta',
        'hora_coleta',
        'limpos_ninho',
        'sujos_ninho',
        'cama_incubaveis',
        'duas_gemas',
        'pequenos',
        'trincados',
        'casca_fina',
        'deformados',
        'frios',
        'sujos_nao_aproveitaveis',
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
        return Coleta::where('data_coleta', $data)->where('lote_id', $idlote)->where('id_aviario', $idaviario)->orderBy('coleta', 'desc')->first();
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
    
    public function numaviario($idaviario){
        $aviarios = Aviario::where('id_aviario', $idaviario)->get();
        foreach ($aviarios as $aviario){
            return $aviario->aviario;
        }
    }
}
