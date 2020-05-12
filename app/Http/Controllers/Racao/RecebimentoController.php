<?php

namespace App\Http\Controllers\Racao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periodo;
use App\Lote;
use App\Racao\Recebimento;

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
        $search = $request->porlote;
        $loteid = $this->lote->where('lote', $search)->get();
        if ($loteid->count() > 0):
            foreach ($loteid as $lid) {
                $lt = $lid->id_lote;
            }
            $aviarios = $this->aviario->where('lote_id', $lt)->get();
            return view('aviarios.index', [
                'aviarios' => $aviarios,
                'poraviario' => $search
            ]);
        else:
            flash('<i class="fa fa-check"></i> Lote não encontrado, verifique se digitou corretamente o nome do lote!')->error();
            return redirect()->route('aviarios.index');
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
        //
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

}
