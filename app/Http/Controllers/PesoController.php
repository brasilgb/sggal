<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Peso;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesoController extends Controller {
    /*
     * @var Peso
     * @var Periodo
     * @var Lote
     */

    protected $periodo;
    protected $lote;
    protected $peso;

    public function __construct(Periodo $periodo, Lote $lote, Peso $peso) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->peso = $peso;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pesos = $this->peso->paginate(15);
        $porlote = '';
        $numaviarios = function($idaviario) {
            return $this->peso->numaviario($idaviario);
        };
        return view('pesos.index', compact('pesos', 'porlote', 'numaviarios'));
    }

    public function search(Request $request) {
        $porlote = $request->porlote;
        $loteid = $this->lote->where('lote', $porlote)->get();
        if ($loteid->count() > 0):
            foreach ($loteid as $lid) {
                $lt = $lid->id_lote;
            }
            $pesos = $this->peso->where('lote_id', $lt)->get();
            $numaviarios = function($idaviario) {
            return $this->peso->numaviario($idaviario);
        };
            return view('pesos.index', compact('pesos', 'porlote', 'numaviarios'));
        else:
            flash('<i class="fa fa-check"></i> Dados de pesagem não encontrado, verifique se digitou corretamente o nome do lote!')->error();
            return redirect()->route('pesos.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('pesos.create', compact('lotes'));
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
            'data_peso' => 'required',
            'lote_id' => 'required',
            'aviario_id' => 'required',
            'semana' => 'required',
            'sexo' => 'required',
            'peso' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['id_peso'] = $this->peso->lastpeso();
            $data['data_peso'] = Carbon::createFromFormat('d/m/Y', $request->data_peso)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $this->peso->create($data);
            flash('<i class="fa fa-check"></i> Pesagem salva com sucesso!')->success();
            return redirect()->route('pesos.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir pesagem!';
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
     * @param  \App\Peso  $peso
     * @return \Illuminate\Http\Response
     */
    public function show(Peso $peso) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peso  $peso
     * @return \Illuminate\Http\Response
     */
    public function edit(Peso $peso) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peso  $peso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peso $peso) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peso  $peso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peso $peso) {
        //
    }

}
