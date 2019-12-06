<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lote;
use Carbon\Carbon;

class LoteController extends Controller {
    /*
     * @var Lote
     */

    private $lote;

    public function __construct(Lote $lote) {
        $this->lote = $lote;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $lotes = $this->lote->paginate(15);
        return view('lotes.index', compact('lotes'));
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

        try {
            $data['data_lote'] = Carbon::createFromFormat('d/m/Y', $request->data_lote)->format('Y-m-d');

            $lote = $this->lote->create($data);

            flash('Lote criado com sucesso!')->success();
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


        try {
            $data['data_lote'] = Carbon::createFromFormat('d/m/Y', $request->data_lote)->format('Y-m-d');
            $lote->update($data);
            flash('Lote atualizado com sucesso!')->success();
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

            flash('Lote removido com sucesso!')->success();
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
