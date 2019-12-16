<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aviario;

class Lote extends Model
{
    protected $primaryKey = 'id_lote';

    protected $fillable = [
        'data_lote',
        'lote',
        'femeas',
        'machos'
    ];

    public function aviarios() 
    {
        return $this->hasMany(Aviario::class);
    }

    public function nextAviario($search)
    {
        return Aviario::where('lote_id', $search)->orderBy('aviario', 'desc')->first();
    }
}
