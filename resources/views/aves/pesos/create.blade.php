@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-balance-scale"></i> Pesos</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pesos.index')}}"> Pesos</a></li>
                    <li class="breadcrumb-item active"> Adicionar pesagem</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-1">
            <div class="d-flex justify-content-between">
                <h3 class="card-title"><a href="{{route('pesos.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'pesos/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porlote', null, ['class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por lote']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submite', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => 'pesos.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Data de pesagem: </label>
                    <div class="col-lg-8">
                        <input id="dataform" class="form-control" type="text" name="data_peso" value="<?= date("d/m/Y"); ?>">
                        @error('data_peso')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote_id', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote')->prepend('Selecione o lote', ''), old('lote_id'),['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('lote_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('aviario_id', 'Aviário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('aviario_id', ['' => 'Selecione o lote'], old('aviario'), ['id' => 'aviariosdolote', 'class' => 'form-control']) !!}
                        @error('aviario_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    {!! Form::label('semana', 'Semana', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('semana', $semanas->pluck('semana', 'id_semana')->prepend('Selecione a semana', ''), old('id_semana'),['id' => 'semana', 'class' => 'form-control']) !!}
                        @error('semana')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('sexo', 'Sexo da ave', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('sexo', ['' => 'Selecione o sexo', '1' => 'Fêmea', '2' => 'Macho'], old('sexo'), ['id' => 'sexo', 'class' => 'form-control input-total']) !!}
                        @error('sexo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('peso', 'Pesos médio', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('peso', old('peso'), ['id' => 'peso', 'class' => 'form-control input-total']) !!}
                        @error('peso')
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