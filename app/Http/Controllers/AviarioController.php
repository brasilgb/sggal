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
        $loteid = $this->lote->where('lote', $search)->get();
        foreach ($loteid as $lid){$lt = $lid->id_lote;}
        if (!empty($search)) {

            $lotes = $this->aviario->where('lote_id', $lt)->get();

            return view('aviarios.index', [
                'aviarios' => $lotes,
                'poraviario' => $search
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
        $data = $request->all();
        $rules = [
            'data_aviario' => 'date_format:"d/m/Y"|required',
            'aviario' => 'required',
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
            $data['data_aviario'] = Carbon::createFromFormat('d/m/Y', $request->data_aviario)->format('Y-m-d');
            
            $aviario = $this->aviario->create($data);

            flash('<i class="fa fa-check"></i>Aviario criado com sucesso!')->success();
            return redirect()->route('aviarios.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar aviario';

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
    public function show(Aviario $aviario) {
        $lotes = $this->lote->all();
        return view('aviarios.edit', compact('aviario', 'lotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aviario $aviario) {
        return redirect()->route('aviarios.show', ['aviario' => $aviario->id_lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviario $aviario) {
        $data = $request->all();
        $rules = [
            'data_aviario' => 'date_format:"d/m/Y"|required',
            'aviario' => 'required',
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
            $data['data_aviario'] = Carbon::createFromFormat('d/m/Y', $request->data_aviario)->format('Y-m-d');
            $aviario->update($data);
            flash('<i class="fa fa-check"></i> Aviário atualizado com sucesso!')->success();
            return redirect()->route('aviarios.show', ['aviario' => $aviario->id_aviario]);
        } catch (\Exception $e) {
            $message = 'Erro ao atualizar aviario!';

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
    public function destroy(Aviario $aviario) {
        try {
            $aviario->delete();

            flash('<i class="fa fa-check"></i> Aviario removido com sucesso!')->success();
            return redirect()->route('aviarios.index', ['aviario' => $aviario->id_aviario]);
        } catch (Exception $e) {
            $message = 'Erro ao remover o aviario';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }
    
    // Funcoes personalizadas **************************************************
    
    // Retorna o valor do aviário à partir do lote
    public function returnaviario(Request $request) {
        $search = $request->segment(3);
        $aviarios = $this->lote->nextAviario($search);
        return response()->json(['success'=>$aviarios['aviario'] + 1]);
    }

}
