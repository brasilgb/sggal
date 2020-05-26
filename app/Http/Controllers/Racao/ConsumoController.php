<?php

namespace App\Http\Controllers\Racao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Aviario;
use App\Racao\Consumo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ConsumoController extends Controller
{
    
    protected $periodo;
    protected $lote;
    protected $aviario;
    protected $consumo;

    public function __construct(Periodo $periodo, Lote $lote, Aviario $aviario, Consumo $consumo) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->aviario = $aviario;
        $this->consumo = $consumo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $consumos = $this->consumo->paginate(15);
        $pordata = '';

        return view('racao/consumos.index', compact('consumos', 'pordata'));
    }

    public function search(Request $request) {
        $pordata = $request->pordata;
        $consumos = $this->consumo->where('data_consumo', Carbon::createFromFormat('d/m/Y', $pordata)->format('Y-m-d'))->get();
        if ($consumos->count() > 0):
            return view('racao/consumos.index', compact('consumos', 'pordata'));
        else:
            flash('<i class="fa fa-check"></i> Consumos de ração não encontradas para esta data, verifique se selecionou corretamente a data!')->error();
            return redirect()->route('consumos.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('racao/consumos.create', compact('lotes'));
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
            'lote_id' => 'required|integer',
            'aviario_id' => 'required|integer',
            'box' => 'required|integer',
            'data_consumo' => 'date_format:"d/m/Y"|required',
            'sexo' => 'required|integer',
            'quantidade' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_consumo'] = $this->consumo->lastconsumo();
            $data['data_consumo'] = Carbon::createFromFormat('d/m/Y', $request->data_consumo)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $this->consumo->create($data);
            flash('<i class="fa fa-check"></i> Consumo salvo com sucesso!')->success();
            return redirect()->route('consumos.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir consumo!';
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
     * @param  int  $id_consumo
     * @return \Illuminate\Http\Response
     */
    public function show(Consumo $consumo) {
        $lotes = $this->lote->all();
        $aviarios = function($loteid){
            return $this->aviario->where('lote_id', $loteid);
        };
        return view('racao/consumos.edit', compact('lotes', 'aviarios', 'consumo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumo $consumo) {
        return redirect()->route('consumos.show', ['consumo' => $consumo->id_consumo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumo $consumo) {
        $data = $request->all();
        $rules = [
            'lote_id' => 'required|integer',
            'aviario_id' => 'required|integer',
            'box' => 'required|integer',
            'data_consumo' => 'date_format:"d/m/Y"|required',
            'sexo' => 'required|integer',
            'quantidade' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_consumo'] = Carbon::createFromFormat('d/m/Y', $request->data_consumo)->format('Y-m-d');
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $consumo->update($data);
            flash('<i class="fa fa-check"></i> Consumo editado com sucesso!')->success();
            return redirect()->route('consumos.index');
        } catch (Exception $e) {
            $message = 'Erro ao editar consumo!';
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
    public function destroy(Consumo $consumo) {
        try {
            $consumo->delete();
            flash('<i class="fa fa-check"></i> Consumo removido com sucesso!')->success();
            return redirect()->route('consumos.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o consumo';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }
}
