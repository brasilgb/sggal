<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;

class PainelController extends Controller {

    private $periodo;

    public function __construct(Periodo $periodo) {
        $this->periodo = $periodo;
    }

    public function painel() {

        $ativos = $this->periodo->where('ativo', 1)->get();
        if (count($ativos) > 0):
            foreach ($ativos as $at):
                $datacriacao = $at->created_at;
                $ativo = $at->ativo;
            endforeach;
        else:
            $ativo = 0;
            $datacriacao = '';
        endif;

        $teste = '';
        return view('painel', compact('teste', 'ativo', 'datacriacao'));
    }

}
