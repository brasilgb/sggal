<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Aviario;
use App\Coleta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                $lotes = Lote::all();
                $aviarios = Aviario::all();
                $aves = DB::table('estoque_aves')->get();
                $dtatual = date('Y-m-d', strtotime(Carbon::now()));
                $posturadia = Coleta::where('data_coleta', $dtatual)->get();
            endforeach;
        else:
            $ativo = 0;
            $datacriacao = '';
        endif;
        $teste = '';
        return view('painel', compact('teste', 'ativo', 'datacriacao', 'lotes', 'aviarios', 'aves', 'posturadia'));
    }

}
