<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configuracao\Backup;
use Illuminate\Support\Facades\Validator;

class BackupController extends Controller {
    /*
     * @var Backup
     */

    protected $backup;

    public function __construct(Backup $backup) {
        $this->backup = $backup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Backup $backup) {
        $backups = $backup->get()->first();
        if ($backups):
            return redirect()->route('backup.show', ['backup' => $backups->id_backup]);
        endif;
        return redirect()->route('backup.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('configuracoes/backup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Backup $backup) {
        $data = $request->all();
        $rules = [
            'base_dados' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'diretorio' => 'required',
            'agendamento' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $data['id_backup'] = $this->backup->lastbackup();
            $backup->create($data);
            $bkid = $backup->get()->first();
            flash('<i class="fa fa-check"></i> Dados do backup salvo com sucesso!')->success();
            return redirect()->route('backup.show', ['backup' => $bkid->id_backup]);
        } catch (Exception $ex) {
            $message = 'Erro ao inserir dados do backup!';
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
    public function show(Backup $backup) {
        return view('configuracoes/backup.edit', compact('backup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup $backup) {
        return redirect()->route('backup.show', ['backup' => $backup->id_backup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backup $backup) {
        $data = $request->all();
        $rules = [
            'base_dados' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'diretorio' => 'required',
            'agendamento' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        try {
            $backup->update($data);
            $bkid = $backup->get()->first();
            flash('<i class="fa fa-check"></i> Dados do backup salvo com sucesso!')->success();
            return redirect()->route('backup.show', ['backup' => $bkid->id_backup]);
        } catch (Exception $ex) {
            $message = 'Erro ao inserir dados do backup!';
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
