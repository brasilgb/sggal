<?php

namespace App\Http\Controllers;

use App\Lote;
use App\Aviario;
use App\Coleta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ColetaController extends Controller {
    /*
     * @var Coleta
     */

    protected $lote;
    protected $aviario;
    protected $coleta;

    public function __construct(Lote $lote, Aviario $aviario, Coleta $coleta) {
        $this->lote = $lote;
        $this->aviario = $aviario;
        $this->coleta = $coleta;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $coletas = $this->coleta->paginate(15);
        $pordata = '';
        return view('coletas.index', compact('coletas', 'pordata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('coletas.create', compact('lotes'));
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
            'data_coleta' => 'date_format:"d/m/Y"|required',
            'hora_coleta' => 'required',
            'id_lote' => 'required',
            'id_aviario' => 'required',
            'coleta' => 'required|integer',
            'limpos_ninho' => 'required|integer',
            'sujos_ninho' => 'required|integer',
            'cama_incubaveis' => 'required|integer',
            'duas_gemas' => 'required|integer',
            'pequenos' => 'required|integer',
            'trincados' => 'required|integer',
            'casca_fina' => 'required|integer',
            'deformados' => 'required|integer',
            'frios' => 'required|integer',
            'sujos_nao_aproveitados' => 'required|integer',
            'esmagados_quebrados' => 'required|integer',
            'descarte' => 'required|integer',
            'cama_nao_incubaveis' => 'required|integer',
            'incubaveis' => 'required|integer',
            'incubaveis_bons' => 'required|integer',
            'comerciais' => 'required|integer',
            'postura_dia' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
        
            flash('<i class="fa fa-check"></i> Coleta salva com sucesso!')->success();
            return redirect()->route('aviario.index');
        } catch (Exception $e) {
            $message = 'Que merda!';
            if (env('APP_DEBUG')){
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
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

    // Funcoes personalizadas **************************************************
    // Retorna o valor do aviário à partir do lote
    public function numcoleta($data, $idlote, $idaviario) {
        $coletas = $this->coleta->nextcoleta($data, $idlote, $idaviario);
        return response()->json(['coleta' => $coletas['coleta'] + 1]);
    }

}
