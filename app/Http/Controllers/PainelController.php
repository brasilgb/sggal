<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Aviario;
use App\Coleta;
use App\Semana;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PainelController extends Controller {

    private $periodo;
    private $semana;

    public function __construct(Periodo $periodo, Semana $semana) {
        $this->periodo = $periodo;
        $this->semana = $semana;
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
//                $semana = $this->semana->semanaatual();
                $listdatas =  json_encode($this->semana->listdatas());
            endforeach;
        else:
            $ativo = 0;
            $lotes = 0;
            $aviarios = 0;
            $aves = 0;
            $dtatual = 0;
            $posturadia =0;
            $datacriacao = '';
        endif;
        return view('painel', compact('ativo', 'datacriacao', 'lotes', 'aviarios', 'aves', 'posturadia', 'listdatas'));
    }

}
