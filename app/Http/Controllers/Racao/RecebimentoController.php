<?php

namespace App\Http\Controllers\Racao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Racao\Recebimento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class RecebimentoController extends Controller {

    protected $periodo;
    protected $lote;
    protected $recebimento;

    public function __construct(Periodo $periodo, Lote $lote, Recebimento $recebimento) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->recebimento = $recebimento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $recebimentos = $this->recebimento->paginate(15);
        $pordata = '';

        return view('racao/recebimentos.index', compact('recebimentos', 'pordata'));
    }

    public function search(Request $request) {
        $pordata = $request->pordata;
        $recebimentos = $this->recebimento->where('data_recebimento', Carbon::createFromFormat('d/m/Y', $pordata)->format('Y-m-d'))->get();
        if ($recebimentos->count() > 0):
            return view('racao/recebimentos.index', compact('recebimentos', 'pordata'));
        else:
            flash('<i class="fa fa-check"></i> Recebimentos de ração não encontradas para esta data, verifique se selecionou corretamente a data!')->error();
            return redirect()->route('recebimentos.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('racao/recebimentos.create', compact('lotes'));
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
            'lote_id' => 'required',
            'data_recebimento' => 'date_format:"d/m/Y"|required',
            'hora_recebimento' => 'required',
            'sexo' => 'required|integer',
            'quantidade' => 'required',
            'nota_fiscal' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_recebimento'] = $this->recebimento->lastrecebimento();
            $data['data_recebimento'] = Carbon::createFromFormat('d/m/Y', $request->data_recebimento)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $this->recebimento->create($data);
            flash('<i class="fa fa-check"></i> Recebimento salvo com sucesso!')->success();
            return redirect()->route('recebimentos.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir recebimento!';
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
     * @param  int  $id_recebimento
     * @return \Illuminate\Http\Response
     */
    public function show(Recebimento $recebimento) {
        $lotes = $this->lote->all();
        return view('racao/recebimentos.edit', compact('lotes', 'recebimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recebimento $recebimento) {
        return redirect()->route('recebimentos.show', ['requerimento' => $recebimento->id_recebimento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recebimento $recebimento) {
        $data = $request->all();
        $rules = [
            'lote_id' => 'required',
            'data_recebimento' => 'date_format:"d/m/Y"|required',
            'hora_recebimento' => 'required',
            'sexo' => 'required|integer',
            'quantidade' => 'required',
            'nota_fiscal' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_recebimento'] = Carbon::createFromFormat('d/m/Y', $request->data_recebimento)->format('Y-m-d');
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $recebimento->update($data);
            flash('<i class="fa fa-check"></i> Recebimento editado com sucesso!')->success();
            return redirect()->route('recebimentos.index');
        } catch (Exception $e) {
            $message = 'Erro ao editar recebimento!';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recebimento $recebimento) {
        try {
            $recebimento->delete();
            flash('<i class="fa fa-check"></i> Recebimento removido com sucesso!')->success();
            return redirect()->route('recebimentos.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o recebimento';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }
}
