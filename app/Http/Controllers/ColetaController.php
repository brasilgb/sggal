<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lote;
use App\Aviario;
use App\Coleta;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ColetaController extends Controller {
    /*
     * @var Coleta
     */

    protected $lote;
    protected $aviario;
    protected $coleta;
    protected $periodo;

    public function __construct(Periodo $periodo, Lote $lote, Aviario $aviario, Coleta $coleta) {
        $this->periodo = $periodo;
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
        $coletas = $this->coleta->where('data_coleta',date("Y-m-d", strtotime(\Carbon\Carbon::now())))->paginate(15);
        $pordata = '';
        $numaviario = function($idaviario) {
            return $this->coleta->numaviario($idaviario);
        };
        return view('coletas.index', compact('coletas', 'pordata', 'numaviario'));
    }

    public function search(Request $request) {
        $pordata = $request->pordata;
        $coletas = $this->coleta->where('data_coleta', Carbon::createFromFormat('d/m/Y', $pordata)->format('Y-m-d'))->get();
        if ($coletas->count() > 0):
            $numaviario = function($idaviario) {
            return $this->coleta->numaviario($idaviario);
        };
        return view('coletas.index', compact('coletas', 'pordata', 'numaviario'));
        else:
            flash('<i class="fa fa-check"></i> Coletas não encontradas para esta data, verifique se selecionou corretamente a data!')->error();
            return redirect()->route('coletas.index');
        endif;
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
            'lote_id' => 'required',
            'id_aviario' => 'required',
            'data_coleta' => 'date_format:"d/m/Y"|required',
            'hora_coleta' => 'required',
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
            'sujos_nao_aproveitaveis' => 'required|integer',
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
            $data['id_coleta'] = $this->coleta->lastcoleta();
            $data['data_coleta'] = Carbon::createFromFormat('d/m/Y', $request->data_coleta)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $this->coleta->create($data);
            flash('<i class="fa fa-check"></i> Coleta salva com sucesso!')->success();
            return redirect()->route('coletas.index');
        } catch (Exception $e) {
            $message = 'Erro ao inserir coleta!';
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
    public function show(Request $request, Coleta $coleta) {
        $idcoleta = $request->segment(2);
        $coletas = $this->coleta->where('id_coleta', $idcoleta)->get();
        foreach ($coletas as $lote) {
            $idlote = $lote->lote_id;
        }
        $aviarios = $this->aviario->where('lote_id', $idlote)->get();
        $lotes = $this->lote->where('id_lote', $idlote)->get();
        return view('coletas.edit', compact('coleta', 'lotes', 'aviarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coleta $coleta) {
        return redirect()->route('coletas.show', ['coleta' => $coleta->id_coleta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coleta $coleta) {
        $data = $request->all();
        $rules = [
            'data_coleta' => 'date_format:"d/m/Y"|required',
            'hora_coleta' => 'required',
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
            'sujos_nao_aproveitaveis' => 'required|integer',
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
            $data['data_coleta'] = Carbon::createFromFormat('d/m/Y', $request->data_coleta)->format('Y-m-d');
            $coleta->update($data);
            flash('<i class="fa fa-check"></i> Coleta alterada com sucesso!')->success();
            return redirect()->route('coletas.show', ['coleta' => $coleta->id_coleta]);
        } catch (Exception $e) {
            $message = 'Erro ao atualizar coleta!';
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
    public function destroy(Coleta $coleta) {
        try {
            $coleta->delete();

            flash('<i class="fa fa-check"></i> Coleta removido com sucesso!')->success();
            return redirect()->route('coletas.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o coleta';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }

    // Funcoes personalizadas **************************************************
    // Retorna o valor do aviário à partir do lote
    public function numcoleta($data, $idlote, $idaviario) {
        $coletas = $this->coleta->nextcoleta($data, $idlote, $idaviario);
        if ($coletas):
            return response()->json(['coleta' => $coletas['coleta'] + 1]);
        else:
            return response()->json(['coleta' => 1]);
        endif;
    }
    
    // Envio do relatório diário de coletas
    public function relatoriodiario(){
        $dtatual = date('Y-m-d', strtotime(Carbon::now()));
        $lotecoleta = $this->coleta->where('data_coleta', $dtatual)->distinct()->get(['lote_id']);
        
        $numcoleta = function($loteid){
            $dtatual = date('Y-m-d', strtotime(Carbon::now()));
            return $this->coleta->where('lote_id', $loteid)->where('data_coleta', $dtatual)->distinct()->get(['coleta']);
        };
        
        $coletaslote = function($loteid, $numcoleta){
            $dtatual = date('Y-m-d', strtotime(Carbon::now()));
            return $this->coleta->where('data_coleta', $dtatual)->where('lote_id', $loteid)->where('coleta', $numcoleta)->get();
        };
        $aviarioslote = function($loteid){
            return $this->aviario->where('lote_id', $loteid)->orderBy('id_aviario', 'asc')->get();
        };
        $dadoscoleta = function($aviarioid){
            $dtatual = date('Y-m-d', strtotime(Carbon::now()));
            return $this->coleta->where('id_aviario', $aviarioid)->where('data_coleta', $dtatual)->get();
        };
        $listcoletas = function($loteid){
            $dtatual = date('Y-m-d', strtotime(Carbon::now()));
            return $this->coleta->where('lote_id', $loteid)->where('data_coleta', $dtatual)->get();
        };
        $datacoleta = Carbon::createFromFormat('Y-m-d', $dtatual)->format('d/m/Y');
        return \PDF::loadView('coletas.relatoriodiario', compact('listcoletas', 'numcoleta', 'coletaslote', 'lotecoleta', 'datacoleta', 'aviarioslote', 'dadoscoleta'))->setPaper('a4', 'landscape')
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->download('nome-arquivo-pdf-gerado.pdf');
    }

}
