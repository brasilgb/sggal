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
                    <li class="breadcrumb-item active"> Empresa</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-1">
            <h3 class="card-title"><i class="fa fa-plus-square"></i> Dados da empresa</h3>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8 text-center">
                        <div class="image" style="margin-bottom: 20px;">
                            <img class="img-rounded elevation-1" src="{{asset('/thumbnail/'.$empresa->logotipo)}}">
                        </div>
                    </div>
                </div>

                {!! Form::open(['route' => ['empresa.update', 'empresa' => $empresa->id_empresa], 'method' => 'PUT', 'files' => 'true', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    {!! Form::label('logotipo', 'Logotipo', ['class' => 'col-lg-4 col-form-label']) !!}

                    <div class="col-lg-8">
                        {!! Form::file('logotipo', ['id' => 'logotipo', 'class' => 'form-control logotipo']) !!}
                        <div class="input-group">
                            {!! Form::text('file', false, ['id' => 'file', 'class' => 'form-control', 'placeholder' => 'Imagem para o logotipo', 'readonly' => 'readonly']) !!}
                            <span class="input-group-btn">
                                {!! Form::button('Selecione', ['class' => 'btn btn-file btn-primary pull-right btn-flat']) !!}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cnpj', 'CNPJ', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('cnpj', $empresa->cnpj, ['id' => 'cnpj', 'class' => 'form-control']) !!}
                        @error('cnpj')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('razao_social', 'Razão social', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('razao_social', $empresa->razao_social, ['id' => 'razao_social', 'class' => 'form-control']) !!}
                        @error('razao_social')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    {!! Form::label('endereco', 'Endereço', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('endereco', $empresa->endereco, ['id' => 'endereco', 'class' => 'form-control']) !!}
                        @error('endereco')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cidade', 'Cidade', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('cidade', $empresa->cidade, ['id' => 'cidade', 'class' => 'form-control']) !!}
                        @error('cidade')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('uf', 'UF', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('uf', $empresa->uf, ['id' => 'uf', 'class' => 'form-control']) !!}
                        @error('uf')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('telefone', 'Telefone', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        <div class="input-group">
                            <span class="input-group-btn">
                                {!! Form::button('Tel', ['class' => 'btn btn-tel btn-info pull-left btn-flat']) !!}
                                {!! Form::button('Cel', ['class' => 'btn btn-cel btn-info pull-left btn-flat']) !!}
                            </span>
                            {!! Form::text('telefone', $empresa->telefone, ['id' => 'telefone', 'class' => 'form-control', 'placeholder' => 'Selecione o tipo do aparelho', 'readonly' => true]) !!}
                        </div>
                        @error('telefone')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('email', 'E-mail', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('email', $empresa->email, ['id' => 'email', 'class' => 'form-control']) !!}
                        @error('email')
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