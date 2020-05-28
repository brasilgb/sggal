<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {
    /*
     * @var Usuario
     */

    protected $usuario;

    public function __construct(User $usuario) {
        $this->usuario = $usuario;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usuarios = $this->usuario->paginate(15);
        $porusuario = '';
        return view('usuarios.index', compact('usuarios', 'porusuario'));
    }

    public function search(Request $request) {
        $search = $request->porusuario;
        $usuarios = $this->usuario->where('username', $search)->get();
        if ($usuarios->count() > 0):
            return view('usuarios.index', [
                'usuarios' => $usuarios,
                'porusuario' => $search
            ]);
        else:
            flash('<i class="fa fa-check"></i> Usuário não encontrado, verifique se digitou corretamente o nome do usuário!')->error();
            return redirect()->route('usuarios.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(\Auth::user()->username == 'administrador'):
        return view('usuarios.create');
        else:
        return redirect()->route('usuarios.index');    
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $periodo = $rules = [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'funcao' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {

//            $data['id_lote'] = $this->lote->lastlote();
            $data['password'] = Hash::make($request->password);
            $this->usuario->create($data);

            flash('<i class="fa fa-check"></i> Usuário criado com sucesso!')->success();
            return redirect()->route('usuarios.index');
        } catch (Exception $e) {

            $message = 'Erro ao criar usuario';

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
    public function show(User $usuario) {

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario) {

        return redirect()->route('usuarios.show', ['usuario' => $usuario->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario) {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'funcao' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            if (!empty($request->password)):
                $data['password'] = Hash::make($request->password);
            else:
                $data['password'] = $usuario->password;
            endif;
            $usuario->update($data);

            flash('<i class="fa fa-check"></i> Usuário alterado com sucesso!')->success();
            return redirect()->route('usuarios.index');
        } catch (Exception $e) {

            $message = 'Erro ao alterar usuario';

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
    public function destroy(User $usuario) {
        try {
            $usuario->delete();

            flash('<i class="fa fa-check"></i> Usuário removido com sucesso!')->success();
            return redirect()->route('usuarios.index');
        } catch (Exception $e) {
            $message = 'Erro ao remover o usuário';

            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }
    }

}
