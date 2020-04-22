<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PeriodoController extends Controller {
    /*
     * @var Periodo
     */

    protected $periodo;

    public function __construct(Periodo $periodo) {
        $this->periodo = $periodo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $periodos = $this->periodo->paginate(15);
        $pordata = '';
        return view('periodos.index', compact('periodos', 'pordata'));
    }

    public function search(Request $request) {
        $search = $request->pordata;
        $data = Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d');
        $periodos = $this->periodo->where('created_at', 'like', '%' . $data . '%')->get();
        if ($periodos->count() > 0):
            return view('periodos.index', [
                'periodos' => $periodos,
                'pordata' => $search
            ]);
        else:
            flash('<i class="fa fa-check"></i> Período não encontrado, verifique se selecionou a data desejada corretamente!')->error();
            return redirect()->route('periodos.index');
        endif;
    }

    public function store(Request $request) {

        $data = $request->all();
        $periodo = $rules = [
            'data_inicial' => 'date_format:"d/m/Y"|required',
            'semana_inicial' => 'required|integer',
            'semana_final' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {

            $data['id_periodo'] = $this->periodo->lastperiodo();
            $data['data_inicial'] = Carbon::createFromFormat('d/m/Y', $request->data_inicial)->format('Y-m-d');
            $data['ativo'] = 1;
            $this->periodo->create($data);

            flash('<i class="fa fa-check"></i> Período criado com sucesso!')->success();
            return redirect()->route('periodos.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar periodo';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }
    
    public function show(Request $request){
        //
    }
    
    public function ativaperiodo(Request $request) {
        $ativo = $request->segment(3);
        $data['ativo'] = $ativo;
        $this->periodo->create($data);
        return redirect()->route('periodos.index');
    }

    public function atualizaperiodo(Request $request) {
        $equilibra = $this->periodo->where('ativo', 1);
        $data['ativo'] = 0;
        $data['desativacao'] = Carbon::now();
        $equilibra->update($data);

        $idperiodo = $request->segment(3);
        $ativo = $request->segment(4);
        $data['ativo'] = $ativo;
        $data['desativacao'] = $ativo == 1 ? null : Carbon::now();
        $produto = $this->periodo->find($idperiodo);
        $produto->update($data);
        return redirect()->route('periodos.index');
    }

    public function periodoativo($ativo) {
        $ativo = $this->periodo->where('ativo', $ativo)->get()->count();
        return response()->json($ativo);
    }

}
