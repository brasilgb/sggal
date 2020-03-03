<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use Carbon\Carbon;

class PeriodoController extends Controller {
    /*
     * @var Periodo
     */

    private $periodo;

    public function __construct(Periodo $periodo) {
        $this->periodo = $periodo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $periodos = $this->periodo->paginate(15);
        $pordata = '';
        return view('periodos.index', compact('periodos', 'pordata'));
    }
    
    
    public function search(Request $request) {
        $search = $request->pordata;
        $data = Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d');
        if (!empty($search)) {
            
            $periodos = $this->periodo->where('created_at', 'like', '%'.$data.'%')->get();

            return view('periodos.index', [
                'periodos' => $periodos,
                'pordata' => $search
            ]);
        }
    }
    
    public function ativaperiodo(Request $request){
        $ativo = $request->segment(3);
        $data['ativo'] = $ativo;
        $this->periodo->create($data);
        return redirect()->route('periodos.index');
    }
    
    public function atualizaperiodo(Request $request) {
        $equilibra = $this->periodo->where('ativo', 1);
        $data['ativo'] = 0;
        $data['desativacao'] = Carbon::now();
        $equilibra->update($data);
        
        $idperiodo = $request->segment(3);
        $ativo = $request->segment(4);
        $data['ativo'] = $ativo;
        $data['desativacao'] = $ativo == 1 ?null : Carbon::now();
        $produto = $this->periodo->find($idperiodo);
        $produto->update($data);
        return redirect()->route('periodos.index');
    }
    
    public function periodoativo(){
        $ativo = $this->periodo->where('ativo', 1)->get();
        return $ativo->count();
    }
}
