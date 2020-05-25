<?php

namespace App\Configuracao;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $primaryKey = 'id_email';
    
    protected $fillable = [
        'id_email',
        'smtp',
        'porta',
        'seguranca',
        'usuario',
        'senha',
        'remetente',
        'destino_coleta',
        'destino_semanal',
        'assunto',
        'mensagem'
    ];
    
        public function lastemail() {
        $lastemail = Email::orderBy('id_email', 'desc')->get();

        if ($lastemail->count() > 0):
            foreach ($lastemail as $last):
                return $last->id_email + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
