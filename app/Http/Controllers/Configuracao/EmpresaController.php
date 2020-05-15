<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuracao\Empresa;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EmpresaController extends Controller {
    /*
     * @var Empresa
     */

    protected $empresa;

    public function __construct(Empresa $empresa) {
        $this->empresa = $empresa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empresa $empresa) {
        $empresas = $empresa->get()->first();
        $count = $this->empresa->all()->count();

        if ($count > 0):
            return redirect()->route('empresa.show', ['empresa' => $empresas->id_empresa]);
        endif;
        return redirect()->route('empresa.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('configuracoes/empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empresa $empresa) {
        $data = $request->all();
        $rules = [
            'logotipo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cnpj' => 'required',
            'razao_social' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'telefone' => 'required',
            'email' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
//            $fileName = time() . '.' . $request->logotipo->extension();
//            $request->logotipo->move(public_path('image'), $fileName);

            $image = $request->file('logotipo');

            $input['imagename'] = time() . '.' . $image->extension();



            $destinationPath = public_path('/thumbnail');

            $img = Image::make($image->path());

            $img->resize(100, 100, function ($constraint) {

                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);



            $destinationPath = public_path('/images');

            $image->move($destinationPath, $input['imagename']);

            $data['logotipo'] = $input['imagename'];
            $data['id_empresa'] = $this->empresa->lastempresa();
            $this->empresa->create($data);
            $empid = $empresa->get()->first();
            flash('<i class="fa fa-check"></i> Dados da empresa salvo com sucesso!')->success();
            return redirect()->route('empresa.show', ['empresa' => $empid->id_empresa]);
        } catch (Exception $e) {
            $message = 'Erro ao inserir dados da empresa!';
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
    public function show(Empresa $empresa) {
        return view('configuracoes/empresa.edit', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa) {
        return redirect()->route('empresa.show', ['empresa' => $empresa->id_empresa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa) {
        $data = $request->all();
        $rules = [
            'logotipo' => 'required',
            'cnpj' => 'required',
            'razao_social' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'telefone' => 'required',
            'email' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $empresa->update($data);
            flash('<i class="fa fa-check"></i> Dados da empresa salvo com sucesso!')->success();
            return redirect()->route('empresa.show', ['empresa' => $empresa->id_empresa]);
        } catch (Exception $e) {
            $message = 'Erro ao inserir dados da empresa!';
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
