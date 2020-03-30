<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aviario;
use App\Ave;
use App\Lote;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AveController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Option de motivos de mortalidade
    const OPT_MOTIVOS = [
        '' => 'Selecione o motivo',
        'Mortalidade galpão' => [
            '1' => 'Arranhado',
            '2' => 'Artrite',
            '3' => 'Descarte eliminada',
            '4' => 'Machucado',
            '5' => 'Prolapso',
            '6' => 'Refugo',
            '7' => 'Outros'
        ],
        'Descarte galpão' => [
            '8' => 'Descarte abate',
            '9' => 'Descarte laboratório',
            '10' => 'Erros sexo',
            '11' => 'Papudas'
        ]
    ];

    /*
     * @var Lote
     * @var Ave
     * @var Aviario
     * @var Periodo
     * @var Estoque_ave
     */

    private $periodo;
    private $lote;
    private $aviario;
    protected $ave;
    protected $estoque_ave;

    public function __construct(Periodo $periodo, Lote $lote, Aviario $aviario, Ave $ave) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->aviario = $aviario;
        $this->ave = $ave;
    }

    public function index() {
        $aves = $this->ave->paginate(15);
        $porave = '';
        $motivos = function($motivo = 0) {
            switch ($motivo) {
                case 1: echo 'Arranhado';
                    break;
                case 2: echo 'Artrite';
                    break;
                case 3: echo 'Descarte eliminada';
                    break;
                case 4: echo 'Machucado';
                    break;
                case 5: echo 'Prolapso';
                    break;
                case 6: echo 'Refugo';
                    break;
                case 7: echo 'Outros';
                    break;
                case 8: echo 'Descarte abate';
                    break;
                case 9: echo 'Descarte laboratório';
                    break;
                case 10: echo 'Erros sexo';
                    break;
                case 11: echo 'Papudas';
                    break;
            }
        };
        return view('aves.index', compact('aves', 'porave', 'motivos'));
    }

    public function search(Request $request) {
        $search = $request->porlote;
        $loteid = $this->lote->where('lote', $search)->get();
        if ($loteid->count() > 0):
            foreach ($loteid as $lid) {
                $lt = $lid->id_lote;
            }
            $aves = $this->ave->where('lote_id', $lt)->get();
            return view('aves.index', [
                'aves' => $aves,
                'porave' => $search,
                'motivos' => function($motivo = 0) {
                    switch ($motivo) {
                        case 1: echo 'Arranhado';
                            break;
                        case 2: echo 'Artrite';
                            break;
                        case 3: echo 'Descarte eliminada';
                            break;
                        case 4: echo 'Machucado';
                            break;
                        case 5: echo 'Prolapso';
                            break;
                        case 6: echo 'Refugo';
                            break;
                        case 7: echo 'Outros';
                            break;
                        case 8: echo 'Descarte abate';
                            break;
                        case 9: echo 'Descarte laboratório';
                            break;
                        case 10: echo 'Erros sexo';
                            break;
                        case 11: echo 'Papudas';
                            break;
                    }
                }
            ]);
        else:
            flash('<i class="fa fa-check"></i> Lote não encontrado, verifique se digitou corretamente o nome do lote!')->error();
            return redirect()->route('aves.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('aves.create', [
            'lotes' => $lotes,
            'motivos' => self::OPT_MOTIVOS
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
            'data_ave' => 'date_format:"d/m/Y"|required',
            'id_aviario' => 'required',
            'lote_id' => 'required',
            'sexo' => 'required|integer',
            'quantidade' => 'required|integer',
            'motivo' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_ave'] = $this->ave->lastave();
            $data['data_ave'] = Carbon::createFromFormat('d/m/Y', $request->data_ave)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $data['tot_ave'] = $data['quantidade'];
            $this->ave->create($data);

            flash('<i class="fa fa-check"></i> Ave criado com sucesso!')->success();
            return redirect()->route('aves.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar ave';

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
    public function show(Request $request, Ave $ave) {
        $lotes = $this->lote->all();
        $idave = $request->segment(3);
        $aves = $this->ave->where('id_ave', $idave)->get();
        foreach ($aves as $lote) {
            $idlote = $lote->lote_id;
        }
        $aviarios = $this->aviario->where('lote_id', $idlote);
        $motivos = self::OPT_MOTIVOS;
        return view('aves.edit', compact('ave', 'lotes', 'aviarios', 'motivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ave $ave) {
        return redirect()->route('aves.show', ['ave' => $ave->id_lote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ave $ave) {
        $data = $request->all();
        $rules = [
            'data_ave' => 'date_format:"d/m/Y"|required',
            'id_aviario' => 'required',
            'lote_id' => 'required',
            'sexo' => 'required|integer',
            'quantidade' => 'required|integer',
            'motivo' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['data_ave'] = Carbon::createFromFormat('d/m/Y', $request->data_ave)->format('Y-m-d');
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $data['tot_ave'] = $data['quantidade'];
            $ave->update($data);
            flash('<i class="fa fa-check"></i> Aviário atualizado com sucesso!')->success();
            return redirect()->route('aves.show', ['ave' => $ave->id_ave]);
        } catch (\Exception $e) {
            $message = 'Erro ao atualizar ave!';

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
    public function destroy(Ave $ave) {
        try {
            $ave->delete();

            flash('<i class="fa fa-check"></i> Ave removido com sucesso!')->success();
            return redirect()->route('aves.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o ave';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }

    // Funcoes personalizadas **************************************************
    // Retorna o valor do aviário à partir do lote
    public function aviariosdolote($idlote = 0) {
        $aves['data'] = $this->ave->getAviarios($idlote);
        echo json_encode($aves);
    }

//    // Compara com os dados em estoque
    public function avesestoque(Request $request) {
        $idlote = $request->segment(3);
        $idaviario = $request->segment(4);
        $valsexo = $request->segment(5);
                switch ($valsexo){
            case 1: $sexo = 'femea';
                break;
            case 2: $sexo = 'macho';
                break;
        }
        $totaves = DB::table('estoque_aves')->where('lote', $idlote)->where('id_aviario', $idaviario)->get()->sum($sexo);
        return response()->json(['totaves' => $totaves]);
    }

}
