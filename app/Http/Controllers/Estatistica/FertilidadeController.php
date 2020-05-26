<?php

namespace App\Http\Controllers\Estatistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Semana;

class FertilidadeController extends Controller
{
    
    public function fertilidade(Periodo $periodo, Semana $semana) {
        $ativo = $periodo->periodoativo();
        $semanas = $semana->where('periodo', $ativo)->get();
        return view('estatistica.fertilidade', compact('semanas'));
    }

    public function update(Semana $semana, $idsemana, $valor) {

       $semana->where('id_semana', $idsemana)->update(['fertilidade' => $valor]);
    }

}
