<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Baixaave;
use App\Lote;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class BaixaaveController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     * @var Lote
     * @var Baixaave
     */
    private $periodo;
    private $lote;
    protected $baixaave;
    protected $estoque_ave;

    public function __construct(Periodo $periodo, Lote $lote, Baixaave $baixaave) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->baixaave = $baixaave;
    }

    public function index() {
        $baixaaves = $this->baixaave->paginate(15);
        $porlote = '';
        return view('baixaaves.index', compact('baixaaves', 'porlote'));
    }

    public function search(Request $request) {
        $search = $request->porlote;
        $loteid = $this->lote->where('lote', $search)->get();
        if ($loteid->count() > 0):
            foreach ($loteid as $lid) {
                $lt = $lid->id_lote;
            }
            $baixaaves = $this->baixaave->where('lote_id', $lt)->get();
            return view('baixaaves.index', [
                'baixaaves' => $baixaaves,
                'porlote' => $search
            ]);
        else:
            flash('<i class="fa fa-check"></i> Lote não encontrado, verifique se digitou corretamente o nome do lote!')->error();
            return redirect()->route('baixaaves.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('baixaaves.create', [
            'lotes' => $lotes
        ]);
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
            'data_baixaave' => 'date_format:"d/m/Y"|required',
            'baixaave' => 'required',
            'lote_id' => 'required',
            'box1_femea' => 'required|integer',
            'box1_macho' => 'required|integer',
//            'box2_femea' => 'required|integer',
//            'box2_macho' => 'required|integer',
//            'box3_femea' => 'required|integer',
//            'box3_macho' => 'required|integer',
//            'box4_femea' => 'required|integer',
//            'box4_macho' => 'required|integer',
            'tot_femea' => 'required|integer',
            'tot_macho' => 'required|integer',
            'tot_ave' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_baixaave'] = $this->baixaave->lastbaixaave();
            $data['data_baixaave'] = Carbon::createFromFormat('d/m/Y', $request->data_baixaave)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $this->baixaave->create($data);

            flash('<i class="fa fa-check"></i> Baixaave criado com sucesso!')->success();
            return redirect()->route('baixaaves.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar baixaave';

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
    public function show(Baixaave $baixaave) {
        $lotes = $this->lote->all();
        return view('baixaaves.edit', compact('baixaave', 'lotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Baixaave $baixaave) {
        return redirect()->route('baixaaves.show', ['baixaave' => $baixaave->id_lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Baixaave $baixaave) {
        $data = $request->all();
        $rules = [
            'data_baixaave' => 'date_format:"d/m/Y"|required',
            'baixaave' => 'required',
            'lote_id' => 'required',
            'box1_femea' => 'required|integer',
            'box1_macho' => 'required|integer',
//            'box2_femea' => 'required|integer',
//            'box2_macho' => 'required|integer',
//            'box3_femea' => 'required|integer',
//            'box3_macho' => 'required|integer',
//            'box4_femea' => 'required|integer',
//            'box4_macho' => 'required|integer',
            'tot_femea' => 'required|integer',
            'tot_macho' => 'required|integer',
            'tot_ave' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_baixaave'] = Carbon::createFromFormat('d/m/Y', $request->data_baixaave)->format('Y-m-d');
            $baixaave->update($data);
            flash('<i class="fa fa-check"></i> Aviário atualizado com sucesso!')->success();
            return redirect()->route('baixaaves.show', ['baixaave' => $baixaave->id_baixaave]);
        } catch (\Exception $e) {
            $message = 'Erro ao atualizar baixaave!';

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
    public function destroy(Baixaave $baixaave) {
        try {
            $baixaave->delete();

            flash('<i class="fa fa-check"></i> Baixaave removido com sucesso!')->success();
            return redirect()->route('baixaaves.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o baixaave';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }

    // Funcoes personalizadas **************************************************
    // Retorna o valor do aviário à partir do lote
    public function returnbaixaave(Request $request) {
        $search = $request->segment(3);
        $baixaaves = $this->baixaave->nextBaixaave($search);
        return response()->json(['success' => $baixaaves['baixaave'] + 1]);
    }

    // Retorna lote e compara com a soma de dados inseridos em aviários
    public function totlotefemeas(Request $request) {
        $idlote = $request->segment(3);
        $countbaixaave = $this->baixaave->where('lote_id', $idlote)->get()->count();
        $totfemealote = $this->baixaave->valLote($idlote);
        foreach ($totfemealote as $femea):
        $femealote = $femea->femea;
        endforeach;
        if ($countbaixaave > 0):
            $femeabaixaave = $this->baixaave->where('lote_id', $idlote)->get()->sum('tot_femea');
            $tf = $femealote - $femeabaixaave;
        else:
            $tf = $femealote;
        endif;
        return response()->json(['totfemeas' => $tf]);
    }

    public function totlotemachos(Request $request) {
        $idlote = $request->segment(3);
        $countmacho = $this->baixaave->where('lote_id', $idlote)->get()->count();
        $totmacholote = $this->baixaave->valLote($idlote);
        foreach ($totmacholote as $macho):
            $macholote = $macho->macho;
        endforeach;
        if ($countmacho > 0):
            $machobaixaave = $this->baixaave->where('lote_id', $idlote)->get()->sum('tot_macho');
            $tm = $macholote - $machobaixaave;
        else:
            $tm = $macholote;
        endif;
        return response()->json(['totmachos' => $tm]);
    }

}
