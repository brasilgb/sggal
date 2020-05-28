<?php

namespace App\Http\Controllers\Estatistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Semana;

class ChecklistController extends Controller
{
    
//    public function eclosao(Periodo $periodo, Semana $semana) {
//        $ativo = $periodo->periodoativo();
//        $semanas = $semana->where('periodo', $ativo)->get();
//        return view('estatistica.eclosao', compact('semanas'));
//    }

    public function checklist(){
        return view('estatistica.checklist');
    }
    
    public function update(Semana $semana, $idsemana, $valor) {

       $semana->where('id_semana', $idsemana)->update(['eclosao' => $valor]);
    }

}
