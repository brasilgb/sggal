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
                {!! Form::open(['route' => 'empresa.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
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
                        @error('logotipo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cnpj', 'CNPJ', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('cnpj', old('cnpj'), ['id' => 'cnpj', 'class' => 'form-control']) !!}
                        @error('cnpj')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('razao_social', 'Razão social', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('razao_social', old('razao_social'), ['id' => 'razao_social', 'class' => 'form-control']) !!}
                        @error('razao_social')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    {!! Form::label('endereco', 'Endereço', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('endereco', old('endereco'), ['id' => 'endereco', 'class' => 'form-control']) !!}
                        @error('endereco')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cidade', 'Cidade', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('cidade', old('cidade'), ['id' => 'cidade', 'class' => 'form-control']) !!}
                        @error('cidade')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('uf', 'UF', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('uf', old('uf'), ['id' => 'uf', 'class' => 'form-control']) !!}
                        @error('uf')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('telefone', 'Telefone', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('telefone', old('telefone'), ['id' => 'telefone', 'class' => 'form-control']) !!}
                        @error('telefone')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('email', 'E-mail', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('email', old('email'), ['id' => 'email', 'class' => 'form-control']) !!}
                        @error('quantidade')
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