<?php

namespace App\Configuracao;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'id_empresa';
    
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
}
