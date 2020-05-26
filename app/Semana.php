<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Periodo;
use App\Lote;
use App\Coleta;
class Semana extends Model {

    protected $primaryKey = 'id_semana';
//    public $incrementing = true;
    protected $fillable = [
        'periodo',
        'semana',
        'data_inicial',
        'data_final',
        'eclosao',
        'fertilidade',
        'producao'
    ];

    public function semanaatual() {
        $dtatual = date("Y-m-d");
        $semanas = Semana::where('data_inicial','<=', $dtatual)->where('data_final', '>', $dtatual)->get();
        foreach ($semanas as $semana):
            return $semana->semana;
        endforeach;
    }
    
    public function listdatas(){
        $datas = Semana::where('semana', $this->semanaatual())->get();
        foreach ($datas as $data):
            $datainicial = new DateTime($data->data_inicial);
            $datafinal = new DateTime($data->data_final);
            $intervalo = new DateInterval('P1D');
            $periodos = new DatePeriod($datainicial, $intervalo, $datafinal);
            foreach ($periodos as $periodo):
                $resp[] = $periodo->format('d/m/Y');
            endforeach;
        endforeach;
        return $resp;
    }
    public function capitalizadas(Lote $lote){
        return $lote->get()->sum->femea_capitalizada;
    }
    
    public function producaosemana(Periodo $periodo, Coleta $coleta){
        $datas = Semana::where('periodo', $periodo->periodoativo())->where('semana', $this->semanaatual())->get();
        foreach ($datas as $data):
            $datainicial = new DateTime($data->data_inicial);
            $datafinal = new DateTime($data->data_final);
            $intervalo = new DateInterval('P1D');
            $periodos = new DatePeriod($datainicial, $intervalo, $datafinal);
            foreach ($periodos as $periodo):
                $dtpostura = $periodo->format('d/m/Y');
                $posturadia = $coleta->where('data_coleta', $dtpostura)->get();
                foreach($posturadia as $postura):
                    $resp[] = number_format(($postura->sum->incubaveis / $this->capitalizadas()) * 100, 2, '.', '');
                endforeach;
            endforeach;
        endforeach;
        return $resp;
    }
/*
 
    public function listPosturaSemana($semana)
    {
        $this->db->where('IdPeriodo', periodoAtivo());
        $this->db->where('Semana', $semana);
        $datas = $this->db->get($this->producao)->result();
        if (count($datas) > 0):
        foreach ($datas as $data):
            $date_begin = new DateTime($data->DataInicio);
//            $dataadiantada=date('Y-m-d',strtotime("1 day", strtotime($data->DataFim)));
            $date_end = new DateTime($data->DataFim);
            // Definimos o intervalo de 1 ano
            $interval = new DateInterval('P1D');
            // Resgatamos datas de cada ano entre data de início e fim
            $period = new DatePeriod($date_begin, $interval, $date_end);
            foreach ($period as $date) {
                $dtpostura = $date->format('Y-m-d');
                $this->db->where('DataColeta', $dtpostura);
                $this->db->select_sum('TotalIncubaveis', 'Postura');
                $results = $this->db->get('coleta')->result();
                foreach ($results as $result){
                    $capitalizadas = number_format(($result->Postura / avesCapitalizadas()) * 100, 2, '.', '');
                    $resp[] = avesCapitalizadas() > 0 ? $capitalizadas : 0;
                }
            }
        endforeach;
        return $resp;
        else:
            return false;
        endif;
    }
 */
}
