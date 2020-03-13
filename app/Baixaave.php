<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baixaave extends Model
{
    
    protected $primaryKey = 'id_baixa';
    public $incrementing = false;
    protected $fillable = [
        'id_baixa',
        'data_baixa',
        'periodo',
        'lote_id',
        'aviario',
        'box1_femea',
        'box1_macho',
        'box2_femea',
        'box2_macho',
        'box3_femea',
        'box3_macho',
        'box4_femea',
        'box4_macho',
        'tot_femea',
        'tot_macho',
        'tot_ave'
    ];

    public function lote() {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function nextBaixa($search) {
        return Baixaave::where('lote_id', $search)->orderBy('id_baixa', 'desc')->first();
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastbaixa() {
        $lastbaixa = Baixaave::orderBy('id_baixa', 'desc')->get();

        if ($lastbaixa->count() > 0):
            foreach ($lastbaixa as $last):
                return $last->id_baixa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
