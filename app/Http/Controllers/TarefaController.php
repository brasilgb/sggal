<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Tarefa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller {
    /*
     * @var Tarefa
     */

    protected $periodo;
    protected $tarefa;

    public function __construct(Periodo $periodo, Tarefa $tarefa) {
        $this->periodo = $periodo;
        $this->tarefa = $tarefa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tarefas = $this->tarefa->paginate(15);
        $pordata = '';
        $situacao = function($value){
        switch ($value){
            case 0 : return 'Aberta';
            break;
            case 1 : return 'Fechada';
            break;
            case 2 : return 'Cancelada';
        }
        };
        
        $badgecolor = function($color){
            switch ($color){
            case 0 : return 'warning';
            break;
            case 1 : return 'success';
            break;
            case 2 : return 'danger';
        }
        };
        return view('tarefas.index', compact('tarefas', 'situacao', 'badgecolor', 'pordata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tarefas.create');
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
            'data_inicio' => 'required',
            'hora_inicio' => 'required',
            'data_previsao' => 'required',
            'hora_previsao' => 'required',
            'descritivo' => 'required',
            'descricao' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['id_tarefa'] = $this->tarefa->lasttarefa();
            $data['periodo'] = $this->periodo->periodoativo();
            $data['data_inicio'] = Carbon::createFromFormat('d/m/Y', $request->data_inicio)->format('Y-m-d');
            $data['data_previsao'] = Carbon::createFromFormat('d/m/Y', $request->data_previsao)->format('Y-m-d');
            $data['situacao'] = '0';
            $this->tarefa->create($data);
            flash('<i class="fa fa-check"></i> Tarefa salva com sucesso!')->success();
            return redirect()->route('tarefas.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir tarefa!';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa) {
        return view('tarefas.edit', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa) {
        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id_tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
