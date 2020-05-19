<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Financeiro\Despesa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DespesaController extends Controller {
    /*
     * @var
     */

    protected $periodo;
    protected $despesa;

    public function __construct(Periodo $periodo, Despesa $despesa) {
        $this->periodo = $periodo;
        $this->despesa = $despesa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $despesas = $this->despesa->paginate(15);
        $pordata = '';
        return view('financeiro/despesas/index', compact('despesas', 'pordata'));
    }

    public function search(Request $request) {
        $pordata = $request->pordata;
        $despesas = $this->despesa->where('vencimento', Carbon::createFromFormat('d/m/Y', $pordata)->format('Y-m-d'))->get();
        if ($despesas->count() > 0):
            return view('financeiro/despesas.index', compact('despesas', 'pordata'));
        else:
            flash('<i class="fa fa-check"></i> Despesas não encontradas para esta data, verifique se selecionou corretamente a data!')->error();
            return redirect()->route('despesas.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('financeiro/despesas.create');
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
            'vencimento' => 'required',
            'descritivo' => 'required',
            'valor' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
        $data['id_despesa'] = $this->despesa->lastdespesa();
        $data['periodo'] = $this->periodo->periodoativo();
        $data['vencimento'] = Carbon::createFromFormat('d/m/Y', $request->vencimento)->format('Y-m-d');
        $this->despesa->create($data);
        flash('<i class="fa fa-check"></i> Despesa salva com sucesso!')->success();
            return redirect()->route('despesas.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir despesa!';
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
    public function show(Despesa $despesa) {
        return view('financeiro/despesas.edit', compact('despesa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesas $despesas) {
        return redirect()->route('despesas.show', ['despesa' => $despesa->id_despesa]);
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
