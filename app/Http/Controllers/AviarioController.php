<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aviario;
use App\Lote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AviarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /*
     * @var Lote
     * @var Aviario
     */
    private $lote;
    protected $aviario;

    public function __construct(Aviario $aviario, Lote $lote) {
        $this->aviario = $aviario;
        $this->lote = $lote;
    }

    public function index() {
        $aviarios = $this->aviario->paginate(15);
        $poraviario = '';
        return view('aviarios.index', compact('aviarios', 'poraviario'));
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
        $lotes = $this->lote->all();
        return view('aviarios.create', [
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
