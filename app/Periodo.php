<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $primaryKey = 'id_periodo';
    
    protected $fillable = [
        'ativo',
        'desativacao'
    ];
    
}
