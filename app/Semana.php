<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;
use DatePeriod;
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

    public function iniciacoletas(){
        return Coleta::all()->sum->incubaveis;
    }
    public function semanaatual() {
        $dtatual = date("Y-m-d");
        $semanas = Semana::where('data_inicial', '<=', $dtatual)->where('data_final', '>', $dtatual)->get();
        foreach ($semanas as $sem):
            return $sem->semana;
        endforeach;
    }

    public function datasdasemana($field){
        $datas = Semana::where('semana', $this->semanaatual())->get();
        foreach ($datas as $data):
            return $data->$field;
        endforeach;
    }
    
    public function listdatas() {
        $datas = Semana::where('semana', $this->semanaatual())->get();
        foreach ($datas as $data):
            $datainicial = new DateTime($data->data_inicial);
            $datafinal = new DateTime($data->data_final);
            $intervalo = new DateInterval('P1D');
            $periodos = new DatePeriod($datainicial, $intervalo, $datafinal);
            foreach ($periodos as $period):
                $resp[] = $period->format('d/m/Y');
            endforeach;
        endforeach;
        return $resp;
    }

    public function capitalizadas() {
        return Lote::get()->sum->femea_capitalizada;
    }

    public function producaosemana($periodoativo) {
        if ($this->capitalizadas() > 0 && $this->iniciacoletas() > 0):
            $datas = Semana::where('periodo', $periodoativo)->where('semana', $this->semanaatual())->get();
            foreach ($datas as $data):
                $datainicial = new DateTime($data->data_inicial);
                $datafinal = new DateTime($data->data_final);
                $intervalo = new DateInterval('P1D');
                $periodos = new DatePeriod($datainicial, $intervalo, $datafinal);
                foreach ($periodos as $period):
                    $dtpostura = $period->format('Y-m-d');
                    $posturadia = Coleta::where('data_coleta', $dtpostura)->get();
                    foreach ($posturadia as $postura):
                        $resp[] = number_format(($posturadia->sum->incubaveis / $this->capitalizadas()) * 100, 2, '.', '');
                    endforeach;
                endforeach;
            endforeach;
            return $resp;
        else:
            return 0;
        endif;
    }

    public function mediasemanal($periodoativo) {
        if ($this->capitalizadas() > 0 && $this->iniciacoletas() > 0):
            $datas = Semana::where('periodo', $periodoativo)->where('semana', $this->semanaatual())->get();
            foreach ($datas as $data):
                $medias = Coleta::where('data_coleta', '>=', $data->data_inicial)->where('data_coleta', '<', $data->data_final)->get();
                return number_format((($medias->sum->incubaveis / 7) / $this->capitalizadas()) * 100, 2, '.', '');
            endforeach;
        else:
            return 0;
        endif;
    }

    public function metasemanal($periodoativo) {
        if ($this->capitalizadas() > 0 && $this->iniciacoletas() > 0):
            $metas = Semana::where('periodo', $periodoativo)->where('semana', $this->semanaatual())->get();
            foreach ($metas as $meta):
                return $meta->producao;
            endforeach;
        else:
            return 0;
        endif;
    }

}
