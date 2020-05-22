<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model {

    protected $primaryKey = 'id_tarefa';
    public $incrementing = false;
    protected $fillable = [
        'id_tarefa',
        'periodo',
        'data_inicio',
        'hora_inicio',
        'data_previsao',
        'hora_previsao',
        'descritivo',
        'descricao',
        'data_termino',
        'hora_termino',
        'situacao',
        'observacao'
    ];

    public function lasttarefa() {
        $lasttarefa = Tarefa::orderBy('id_tarefa', 'desc')->get();

        if ($lasttarefa->count() > 0):
            foreach ($lasttarefa as $last):
                return $last->id_tarefa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
