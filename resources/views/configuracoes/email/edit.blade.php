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
                    <li class="breadcrumb-item active"> Email</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-1">
            <h3 class="card-title"><i class="fa fa-plus-square"></i> Dados do e-mail</h3>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => ['email.update', 'email' => $email->id_email], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    {!! Form::label('smtp', 'SMTP', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('smtp', $email->smtp, ['id' => 'smtp', 'class' => 'form-control']) !!}
                        @error('smtp')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('porta', 'Porta', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('porta', $email->porta, ['id' => 'porta', 'class' => 'form-control']) !!}
                        @error('porta')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    {!! Form::label('seguranca', 'Segurança', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('seguranca', $email->seguranca, ['id' => 'seguranca', 'class' => 'form-control']) !!}
                        @error('seguranca')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('usuario', 'Usuário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('usuario', $email->usuario, ['id' => 'usuario', 'class' => 'form-control']) !!}
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
                    {!! Form::label('remetente', 'Remetente', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('remetente', $email->remetente, ['id' => 'remetente', 'class' => 'form-control']) !!}
                        @error('remetente')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('destino_coleta', 'Destino coleta', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('destino_coleta', $email->destino_coleta, ['rows' => 3, 'id' => 'destino_coleta', 'class' => 'form-control']) !!}
                        @error('destino_coleta')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('destino_semanal', 'Destino semanal', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('destino_semanal', $email->destino_semanal, ['rows' => 3, 'id' => 'destino_semanal', 'class' => 'form-control']) !!}
                        @error('destino_semanal')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('assunto', 'Assunto', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('assunto', $email->assunto, ['id' => 'assunto', 'class' => 'form-control']) !!}
                        @error('assunto')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('mensagem', 'Mensagem', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('mensagem', $email->mensagem, ['rows' => 3, 'id' => 'mensagem', 'class' => 'form-control']) !!}
                        @error('mensagem')
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