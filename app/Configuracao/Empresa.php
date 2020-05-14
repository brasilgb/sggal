<?php

namespace App\Configuracao;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'id_empresa';
    public $incrementing = false;
    protected $fillable = [
        'id_empresa',
        'logotipo',
        'cnpj',
        'razao_social',
        'endereco',
        'cidade',
        'uf',
        'telefone',
        'email'
    ];
    
        public function lastempresa() {
        $lastempresa = Empresa::orderBy('id_empresa', 'desc')->get();

        if ($lastempresa->count() > 0):
            foreach ($lastempresa as $last):
                return $last->id_empresa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
