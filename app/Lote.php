<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aviario;

class Lote extends Model {

    protected $primaryKey = 'id_lote';
    public $incrementing = false;
    protected $fillable = [
        'id_lote',
        'data_lote',
        'periodo',
        'lote',
        'femeas',
        'machos'
    ];

    public function aviarios() {
        return $this->hasMany(Aviario::class);
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
