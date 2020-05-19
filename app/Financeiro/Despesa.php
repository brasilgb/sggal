<?php

namespace App\Financeiro;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $primaryKey = 'id_despesa';
    public $incrementing = false;
    protected $fillable = [
        'id_despesa',
        'periodo',
        'vencimento',
        'descritivo',
        'valor'
    ];
    
    public function lastdespesa() {
        $lastdespesa = Despesa::orderBy('id_despesa', 'desc')->get();

        if ($lastdespesa->count() > 0):
            foreach ($lastdespesa as $last):
                return $last->id_despesa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
