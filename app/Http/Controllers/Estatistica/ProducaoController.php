<?php

namespace App\Http\Controllers\Estatistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Semana;

class ProducaoController extends Controller
{
    public function producao(Periodo $periodo, Semana $semana){
        $ativo = $periodo->periodoativo();
        $semanas = $semana->where('periodo', $ativo)->get();
        return view('estatistica.producao', compact('semanas'));
    }
}
