@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-cog"></i> Configurações</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/"> Home</a></li>
                    <li class="breadcrumb-item active"> Backup</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-1">
            <h3 class="card-title"><i class="fa fa-plus-square"></i> Dados do backup</h3>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => ['backup.update', 'backup' => $backup->id_backup], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    {!! Form::label('base_dados', 'Base de dados', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('base_dados', $backup->base_dados, ['id' => 'base_dados', 'class' => 'form-control']) !!}
                        @error('base_dados')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('usuario', 'Usuário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('usuario', $backup->usuario, ['id' => 'usuario', 'class' => 'form-control']) !!}
                        @error('usuario')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    {!! Form::label('senha', 'Senha', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::password('senha', ['id' => 'senha', 'class' => 'form-control', 'placeholder' => 'Senha oculta, para alterar digite a nova senha!']) !!}
                        @error('senha')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('diretorio', 'Diretório', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('diretorio', $backup->diretorio, ['id' => 'diretorio', 'class' => 'form-control']) !!}
                        @error('diretorio')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('agendamento', 'Agendamento', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('agendamento', $backup->agendamento, ['id' => 'agendamento', 'class' => 'form-control']) !!}
                        @error('agendamento')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-form-label"></div>
                    <div class="col-lg-8 text-right">
                        {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary salvar']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>
</div>

<!-- /.card -->
@endsection