<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semana extends Model {

    protected $primaryKey = 'id_semana';
//    public $incrementing = true;
    protected $fillable = [
        'periodo',
        'semana',
        'data_inicial',
        'data_final'
    ];

    
}
