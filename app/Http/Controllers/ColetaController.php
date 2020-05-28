<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lote;
use App\Aviario;
use App\Coleta;
use App\Periodo;
use App\Envio;
use App\Aves\Mortalidade;
use App\Configuracao\Email;
use App\Configuracao\Empresa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use Barryvdh\DomPDF\PDF;

class ColetaController extends Controller {
    /*
     * @var Coleta
     */

    protected $lote;
    protected $aviario;
    protected $coleta;
    protected $periodo;
    protected $dtatual;
    protected $mortalidade;
    protected $envio;
    protected $email;
    protected $empresa;

    public function __construct(Periodo $periodo, Lote $lote, Aviario $aviario, Coleta $coleta, Mortalidade $mortalidade, Envio $envio, Email $email, Empresa $empresa) {
        $this->periodo = $periodo;
        $this->lote = $lote;
        $this->aviario = $aviario;
        $this->coleta = $coleta;
        $this->mortalidade = $mortalidade;
        $this->envio = $envio;
        $this->email = $email;
        $this->empresa = $empresa;
        $this->dtatual = date('Y-m-d', strtotime(Carbon::now()));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $coletas = $this->coleta->where('data_coleta', date("Y-m-d", strtotime(\Carbon\Carbon::now())))->paginate(15);
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
    public function relatoriodiario(Email $email, PDF $pdf) {

        // Busca lote_id e retorna resultado distinto(um se houver muitos) da coleta
        $lotecoleta = $this->coleta->where('data_coleta', $this->dtatual)->distinct()->get(['lote_id']);

        // Busca em coletas o número da coleta e retorna resultado distinto(um se houver muitos)
        $numcoleta = function($loteid) {
            return $this->coleta->where('lote_id', $loteid)->where('data_coleta', $this->dtatual)->distinct()->get(['coleta']);
        };

        // Busca e retorna valores das coletas por lote e número da coleta
        $coletaslote = function($loteid, $numcoleta) {
            return $this->coleta->where('data_coleta', $this->dtatual)->where('lote_id', $loteid)->where('coleta', $numcoleta)->get();
        };

        // Lista os aviários do lote
        $aviarioslote = function($loteid) {
            return $this->aviario->where('lote_id', $loteid)->orderBy('id_aviario', 'asc')->get();
        };

        //Busca os valores das coletas por data e id do aviário
        $dadoscoleta = function($aviarioid) {
            return $this->coleta->where('id_aviario', $aviarioid)->where('data_coleta', $this->dtatual)->get();
        };

        // Lista coletas do lote por data
        $listcoletas = function($loteid) {
            return $this->coleta->where('lote_id', $loteid)->where('data_coleta', $this->dtatual)->get();
        };

        // Totais da coleta
        $totcoletalote = function($loteid) {
            return $this->coleta->where('lote_id', $loteid)->where('data_coleta', $this->dtatual)->get();
        };

        // Retorna o estoque de aves
        $avesemestoque = DB::table('estoque_aves')->get();

        // Retorna mortalidade de aves
        $mortalidades = function($motivo) {
            return $this->mortalidade->where('data_mortalidade', $this->dtatual)->where('motivo', $motivo)->get();
        };
        $totalmortas = $this->mortalidade->where('data_mortalidade', $this->dtatual)->get();

        // Retorna o estoque de ovos
        $ovosemestoque = DB::table('estoque_ovos')->get();

        // Retorna ovos do dia
        $ovosdiarios = $this->coleta->where('data_coleta', $this->dtatual)->get();

        // Retorna os ovos enviados
        $ovosenviados = $this->envio->where('data_envio', $this->dtatual)->get();

        // Define a data padrão brasileiro no view
        $datacoleta = Carbon::createFromFormat('Y-m-d', $this->dtatual)->format('d/m/Y');

        //Dados da empresa
        $dadosempresa = $this->empresa->get();
        if ($dadosempresa->count() > 0) {
            foreach ($dadosempresa as $dados):
                $razaosocial = $dados->razao_social;
            endforeach;
        } else {
            $razaosocial = 'Razao Social';
        }

        //Anexa relatório pdf e envia e-mail
        $emailresult = $this->email->all();
        if ($emailresult->count() > 0) {
            foreach ($emailresult as $result):
                $smtp = $result->smtp;
                $usuario = $result->usuario;
                $senha = $result->senha;
                $seguranca = $result->seguranca;
                $porta = $result->porta;
                $remetente = $result->remetente;
                $assunto = $result->assunto;
                $mensagem = $result->mensagem;
                $destinocoleta = $result->destino_coleta;

            endforeach;

            // Monta arquivo em PDF do relatório diário de coletas
            $pdf_name = "relatorio-coletas-diario.pdf";
            $path = public_path('/temp/' . $pdf_name);
            $pdf->loadView('coletas.relatoriodiario', compact(
                                    'listcoletas',
                                    'numcoleta',
                                    'coletaslote',
                                    'lotecoleta',
                                    'datacoleta',
                                    'aviarioslote',
                                    'dadoscoleta',
                                    'totcoletalote',
                                    'avesemestoque',
                                    'mortalidades',
                                    'totalmortas',
                                    'ovosemestoque',
                                    'ovosdiarios',
                                    'ovosenviados',
                                    'razaosocial'
                    ))
                    ->setPaper('a4', 'landscape')->save($path);


            $mail = new PHPMailer(true);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ),
            );
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
            $mail->Host = $smtp; //Podemos usar o servidor do gMail para enviar.
            $mail->SMTPAuth = true; //Habilitamos a autenticação do SMTP. (true ou false)
            $mail->Username = $usuario; //Usuário do gMail
            $mail->Password = $senha; //Senha do gMail
            $mail->SMTPSecure = $seguranca; //Estabelecemos qual protocolo de segurança será usado.
            $mail->Port = $porta; //Estabelecemos a porta utilizada pelo servidor do gMail.

            $mail->SetFrom('' . $usuario . '', '' . $remetente . ''); //Quem está enviando o e-mail.
            $mail->AddReplyTo('' . $usuario . '', '' . $remetente . ''); //Para que a resposta será enviada.
            $mail->Subject = $assunto; //Assunto do e-mail.
            $mail->Body = $mensagem . "<br/>";
            $mail->AltBody = "Para visualizar esse e-mail corretamente, use um visualizador de e-mail com suporte a HTML!";

            $remetentes = explode(',', $destinocoleta);
            foreach ($remetentes as $remetente):
                $mail->AddAddress(ltrim($remetente), "");
            endforeach;

            $mail->addAttachment($path);
            if (!$mail->Send()) {
                flash('<i class="fa fa-check"></i> ocorreu um erro durante o envio!' . $mail->ErrorInfo)->success();
                return redirect()->route('home');
            } else {
                flash('<i class="fa fa-check"></i> Relatório enviado com sucesso!')->success();
                return redirect()->route('home');
            }
        } else {
            flash('<i class="fa fa-exclamation-triangle"></i> Houve algum erro ao enviar o relatório, verifique o seguinte, os dados do email, os dados da empresa e/ou outros dados de coletas e aves estão faltando!')->error();
            return redirect()->route('home');
        }
    }

}
