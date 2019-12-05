<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $primaryKey = 'id_lote';
    protected $fillable = [
        'data_lote',
        'lote',
        'femeas',
        'machos'
    ];
}
