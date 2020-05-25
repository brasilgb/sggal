<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuracao\Email;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller {
    /*
     * @var Email
     */

    protected $email;

    public function __construct(Email $email) {
        $this->email = $email;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email) {
        $emails = $email->get()->first();
        if ($emails):
            return redirect()->route('email.show', ['email' => $emails->id_email]);
        endif;
        return redirect()->route('email.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('configuracoes/email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Email $email) {
        $data = $request->all();
        $rules = [
            'smtp' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'remetente' => 'required',
            'destino_coleta' => 'required',
            'destino_semanal' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_email'] = $this->email->lastemail();
            $email->create($data);
            $emid = $email->get()->first();
            flash('<i class="fa fa-check"></i> Dados do e-mail salvo com sucesso!')->success();
            return redirect()->route('email.show', ['email' => $emid->id_email]);
        } catch (Exception $ex) {
            $message = 'Erro ao inserir dados do e-mail!';
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
    public function show(Email $email) {
        return view('configuracoes/email.edit', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email) {
        return redirect()->route('email.show', ['email' => $email->id_email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email) {
        $data = $request->all();
        $rules = [
            'smtp' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'nullable|confirmed',
            'remetente' => 'required',
            'destino_coleta' => 'required',
            'destino_semanal' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            if (!empty($request->password)):
                $data['senha'] = $request->senha;
            else:
                $data['senha'] = $email->senha;
            endif;
            $email->update($data);
            $bkid = $email->get()->first();
            flash('<i class="fa fa-check"></i> Dados do e-mail salvo com sucesso!')->success();
            return redirect()->route('email.show', ['email' => $bkid->id_email]);
        } catch (Exception $ex) {
            $message = 'Erro ao inserir dados do e-mail!';
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
    public function destroy($id) {
        //
    }

}
