<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lote;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LoteController extends Controller {
    /*
     * @var Lote
     */

    private $lote;
    private $periodo;
    public function __construct(Lote $lote, Periodo $periodo) {
        $this->lote = $lote;
        $this->periodo = $periodo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $lotes = $this->lote->paginate(15);
        $porlote = '';
        return view('lotes.index', compact('lotes', 'porlote'));
    }

    public function search(Request $request) {
        $search = $request->porlote;
        if (!empty($search)) {

            $lotes = $this->lote->where('lote', $search)->get();

            return view('lotes.index', [
                'lotes' => $lotes,
                'porlote' => $search
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('lotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $periodo = 
        $rules = [
            'data_lote' => 'date_format:"d/m/Y"|required',
            'lote' => 'required|unique:lotes',
            'femeas' => 'required|integer',
            'machos' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_lote'] = Carbon::createFromFormat('d/m/Y', $request->data_lote)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $lote = $this->lote->create($data);

            flash('<i class="fa fa-check"></i>Lote criado com sucesso!')->success();
            return redirect()->route('lotes.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar lote';

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
    public function show(Lote $lote) {

        return view('lotes.edit', compact('lote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lote $lote) {

        return redirect()->route('lotes.show', ['lote' => $lote->id_lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote) {
        $data = $request->all();
        $rules = [
            'data_lote' => 'date_format:"d/m/Y"|required',
            'lote' => 'required',
            'femeas' => 'required|integer',
            'machos' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_lote'] = Carbon::createFromFormat('d/m/Y', $request->data_lote)->format('Y-m-d');
            $lote->update($data);
            flash('<i class="fa fa-check"></i> Lote atualizado com sucesso!')->success();
            return redirect()->route('lotes.show', ['lote' => $lote->id_lote]);
        } catch (\Exception $e) {
            $message = 'Erro ao atualizar lote!';

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
    public function destroy(Lote $lote) {
        try {
            $lote->delete();

            flash('<i class="fa fa-check"></i> Lote removido com sucesso!')->success();
            return redirect()->route('lotes.index', ['lote' => $lote->id_lote]);
        } catch (Exception $e) {
            $message = 'Erro ao remover o lote';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }

}
