<?php

namespace App\Racao;

use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model {

    protected $prymarykey = 'id_recebimento';
    public $incrementing = false;
    protected $fillable = [
        'id_recebimento',
        'periodo',
        'lote_id',
        'data_racao',
        'hora_racao',
        'femea',
        'macho',
        'quantidade',
        'nota_fiscal'
    ];

}
