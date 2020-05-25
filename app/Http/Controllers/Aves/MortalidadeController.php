<?php

namespace App\Http\Controllers\Aves;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aviario;
use App\Aves\Mortalidade;
use App\Lote;
use App\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MortalidadeController extends Controller
{
    
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
     * @var Mortalidade
     * @var Aviario
     * @var Periodo
     * @var Estoque_mortalidade
     */

    private $periodo;
    private $lote;
    private $aviario;
    protected $mortalidade;
    protected $estoque_aves;
    protected $motivos;

    public function __construct(Periodo $periodo, Lote $lote, Aviario $aviario, Mortalidade $mortalidade) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->aviario = $aviario;
        $this->mortalidade = $mortalidade;
        $this->motivos = $motivos = function($motivo = 0) {
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
    }

    public function index() {
        $mortalidades = $this->mortalidade->paginate(15);
        $pormortalidade = '';
        $motivos = $this->motivos;
        $numaviarios = function($idaviario) {
            return $this->mortalidade->numaviario($idaviario);
        };
        return view('aves/mortalidades.index', compact('mortalidades', 'pormortalidade', 'motivos', 'numaviarios', 'pormortalidade'));
    }

    public function search(Request $request) {
        $search = $request->porlote;
        $loteid = $this->lote->where('lote', $search)->get();
        if ($loteid->count() > 0):
            foreach ($loteid as $lid) {
                $lt = $lid->id_lote;
            }
            $mortalidades = $this->mortalidade->where('lote_id', $lt)->get();
            return view('mortalidades.index', [
                'mortalidades' => $mortalidades,
                'pormortalidade' => $search,
                'motivos' => $this->motivos
            ]);
        else:
            flash('<i class="fa fa-check"></i> Lote não encontrado, verifique se digitou corretamente o nome do lote!')->error();
            return redirect()->route('mortalidades.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lotes = $this->lote->all();
        return view('aves/mortalidades.create', [
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
            'data_mortalidade' => 'date_format:"d/m/Y"|required',
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
            $data['id_mortalidade'] = $this->mortalidade->lastmortalidade();
            $data['data_mortalidade'] = Carbon::createFromFormat('d/m/Y', $request->data_mortalidade)->format('Y-m-d');
            $data['periodo'] = $this->periodo->periodoativo();
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $data['tot_ave'] = $data['quantidade'];
            $this->mortalidade->create($data);

            flash('<i class="fa fa-check"></i> Mortalidade criado com sucesso!')->success();
            return redirect()->route('mortalidades.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar mortalidade';

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
    public function show(Mortalidade $mortalidade) {
        $lotes = $this->lote->all();
        $motivos = self::OPT_MOTIVOS;
        $aviarios = function($loteid){
            return $this->aviario->where('lote_id',$loteid)->get();
        };
        return view('aves/mortalidades.edit', compact('mortalidade', 'lotes', 'aviarios', 'motivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mortalidade $mortalidade) {
        return redirect()->route('mortalidades.show', ['mortalidade' => $mortalidade->id_mortalidade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mortalidade $mortalidade) {
        $data = $request->all();
        $rules = [
            'data_mortalidade' => 'date_format:"d/m/Y"|required',
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
            $data['data_mortalidade'] = Carbon::createFromFormat('d/m/Y', $request->data_mortalidade)->format('Y-m-d');
            $data['femea'] = $data['sexo'] == 1 ? $data['quantidade'] : '0';
            $data['macho'] = $data['sexo'] == 2 ? $data['quantidade'] : '0';
            $data['tot_mortalidade'] = $data['quantidade'];
            $mortalidade->update($data);
            flash('<i class="fa fa-check"></i> Aviário atualizado com sucesso!')->success();
            return redirect()->route('mortalidades.show', ['mortalidade' => $mortalidade->id_mortalidade]);
        } catch (\Exception $e) {
            $message = 'Erro ao atualizar mortalidade!';

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
    public function destroy(Mortalidade $mortalidade) {
        try {
            $mortalidade->delete();

            flash('<i class="fa fa-check"></i> Mortalidade removida com sucesso!')->success();
            return redirect()->route('mortalidades.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o mortalidades';

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
        $mortalidades['data'] = $this->mortalidade->getAviarios($idlote);
        echo json_encode($mortalidades);
    }

//    // Compara com os dados em estoque
    public function avesestoque(Request $request) {
        $idlote = $request->segment(4);
        $idaviario = $request->segment(5);
        $valsexo = $request->segment(6);
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
