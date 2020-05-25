@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-pallet"></i> Ração</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/"> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('consumos.index')}}"> Consumos</a></li>
                    <li class="breadcrumb-item active"> Adicionar consumo</li>
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
                <h3 class="card-title"><a href="{{route('consumos.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'racao/consumos/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('pordata', null, ['id' => 'datasearch', 'class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por data']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => 'consumos.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Data do consumo: </label>
                    <div class="col-lg-8">
                        <input id="dataform" class="form-control" type="text" name="data_consumo" value="<?= date("d/m/Y"); ?>">
                        @error('data_consumo')
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
                    {!! Form::label('aviariosdolote', 'Aviario', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('aviario_id', ['' => 'Selecione o lote'], old('aviario_id'), ['id' => 'aviariosdolote', 'class' => 'form-control']) !!}
                        @error('aviario_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box', 'Box', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box', old('box'), ['id' => 'box', 'class' => 'form-control input-total']) !!}
                        @error('box')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('sexo', 'Sexo das aves', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('sexo', ['' => 'Selecione o sexo', '1' => 'Fêmea', '2' => 'Macho'], old('sexo'), ['id' => 'sexo', 'class' => 'form-control input-total']) !!}
                        @error('sexo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('quantidade', 'Quantidade (Kg)', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('quantidade', old('quantidade'), ['id' => 'quantidade', 'class' => 'form-control input-total']) !!}
                        <div class="info-num-aves est-aves" style="display: none;">Há <strong class="text-red"></strong> aves <span></span> disponíveis no aviário.</div>
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