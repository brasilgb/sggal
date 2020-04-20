<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Envio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EnvioController extends Controller {
    /*
     * @var Periodo
     * @var Lote
     * @var Aviario
     * @var Envio
     */

    protected $periodo;
    protected $lote;
    protected $envio;

    public function __construct(Periodo $periodo, Lote $lote, Envio $envio) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->envio = $envio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $envios = $this->envio->paginate(15);
        $pordata = '';
        return view('envios.index', compact('envios', 'pordata'));
    }

    public function search(Request $request) {
        $pordata = $request->pordata;
        $envios = $this->envio->where('data_envio', Carbon::createFromFormat('d/m/Y', $pordata)->format('Y-m-d'))->get();
        if ($envios->count() > 0):
            return view('envios.index', compact('envios', 'pordata', 'numaviario'));
        else:
            flash('<i class="fa fa-check"></i> Envios não encontradas para esta data, verifique se selecionou corretamente a data!')->error();
            return redirect()->route('envios.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('envios.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $rules = [
            'data_envio' => 'required',
            'hora_envio' => 'required',
            'lote_id' => 'required',
            'incubaveis' => 'required',
            'comerciais' => 'required',
            'postura_dia' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['id_envio'] = $this->envio->lastenvio();
            $data['data_envio'] = Carbon::createFromFormat('d/m/Y', $request->data_envio)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $this->envio->create($data);
            flash('<i class="fa fa-check"></i> Envio salvo com sucesso!')->success();
            return redirect()->route('envios.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir envio!';
            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Envio $envio) {
        $idenvio = $request->segment(2);
        $envios = $this->envio->where('id_envio', $idenvio)->get();
        foreach ($envios as $lote) {
            $idlote = $lote->lote_id;
        }
        $lotes = $this->lote->where('id_lote', $idlote)->get();
        return view('envios.edit', compact('envio', 'lotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio) {
        return redirect()->route('envios.show', ['envio' => $envio->id_envio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio) {
        $data = $request->all();
        $rules = [
            'data_envio' => 'required',
            'hora_envio' => 'required',
            'lote_id' => 'required',
            'incubaveis' => 'required',
            'comerciais' => 'required',
            'postura_dia' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['data_envio'] = Carbon::createFromFormat('d/m/Y', $request->data_envio)->format('Y-m-d');
            $envio->update($data);
            flash('<i class="fa fa-check"></i> Envio alterardo com sucesso!')->success();
            return redirect()->route('envios.index', ['envio' => $envio->id_envio]);
        } catch (Exception $e) {
            $message = 'Erro ao alterar envio!';
            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio) {
        try {
            $envio->delete();

            flash('<i class="fa fa-check"></i> Envio removido com sucesso!')->success();
            return redirect()->route('envios.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o envio';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }
    
    public function estoqueovos($loteid = 0){
        $incubaveis = DB::table('estoque_ovos')->where('lote_id', $loteid)->get()->sum('incubaveis');
        $comerciais = DB::table('estoque_ovos')->where('lote_id', $loteid)->get()->sum('comerciais');
        return response()->json(['incubaveis' => $incubaveis, 'comerciais' => $comerciais]);
    }

}
