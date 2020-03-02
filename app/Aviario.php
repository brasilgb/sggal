<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lote;
use App\Periodo;

class Aviario extends Model {

    protected $primaryKey = 'id_aviario';
    public $incrementing = false;
    protected $fillable = [
        'id_aviario',
        'data_aviario',
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

    public function nextAviario($search) {
        return Aviario::where('lote_id', $search)->orderBy('aviario', 'desc')->first();
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastaviario() {
        $lastaviario = Aviario::orderBy('id_aviario', 'desc')->get();

        if ($lastaviario->count() > 0):
            foreach ($lastaviario as $last):
                return $last->id_aviario + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
