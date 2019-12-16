<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lote;

class Aviario extends Model
{
    protected $primaryKey = 'id_aviario';
    
    protected $fillable = [
        'data_aviario',
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
    public function lote()
    {
        return $this->belongsTo(Lote::class, 'lote_id');
    }
    
}
