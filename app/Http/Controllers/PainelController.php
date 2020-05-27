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

    public function painel(Periodo $periodo, Semana $semana) {

        $ativos = $periodo->where('ativo', 1)->get();
        if (count($ativos) > 0):
            foreach ($ativos as $at):
                $datacriacao = $at->created_at;
                $ativo = $at->ativo;
                $lotes = Lote::all();
                $aviarios = Aviario::all();
                $aves = DB::table('estoque_aves')->get();
                $dtatual = date('Y-m-d', strtotime(Carbon::now()));
                $posturadia = Coleta::where('data_coleta', $dtatual)->get();
                $semanaatual = $semana->semanaatual();
                $metasemanal = $semana->metasemanal($periodo->periodoativo());
                $mediasemanal = $semana->mediasemanal($periodo->periodoativo());
                $listdatas =  json_encode($semana->listdatas());
                $producaosemana = json_encode($semana->producaosemana($periodo->periodoativo()));

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
        return view('painel', compact('ativo', 'datacriacao', 'lotes', 'aviarios', 'aves', 'posturadia', 'listdatas', 'semanaatual', 'producaosemana', 'mediasemanal', 'metasemanal'));
    }

}
