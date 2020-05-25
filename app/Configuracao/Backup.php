<?php

namespace App\Configuracao;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    protected $primaryKey = 'id_backup';
    
    protected $fillable = [
        'id_backup',
        'base_dados',
        'usuario',
        'senha',
        'diretorio',
        'agendamento'
    ];
    
        public function lastbackup() {
        $lastbackup = Backup::orderBy('id_backup', 'desc')->get();

        if ($lastbackup->count() > 0):
            foreach ($lastbackup as $last):
                return $last->id_backup + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
