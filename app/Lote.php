<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aviario;
use App\Ave;
use App\Coleta;
use App\Racao\Recebimento;
class Lote extends Model {

    protected $primaryKey = 'id_lote';
    public $incrementing = false;
    protected $fillable = [
        'id_lote',
        'data_lote',
        'periodo',
        'lote',
        'femea',
        'macho'
    ];

    public function aviarios() {
        return $this->hasMany(Aviario::class);
    }

    public function aves() {
        return $this->hasMany(Ave::class);
    }

    public function coletas() {
        return $this->hasMany(Coleta::class);
    }

    public function recebimentos() {
        return $this->hasMany(Recebimento::class);
    }

    public function lastlote() {
        $lastlote = Lote::orderBy('id_lote', 'desc')->get();

        if ($lastlote->count() > 0):
            foreach ($lastlote as $last):
                return $last->id_lote + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
