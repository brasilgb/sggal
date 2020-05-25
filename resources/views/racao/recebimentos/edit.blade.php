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
                    <li class="breadcrumb-item"><a href="{{route('recebimentos.index')}}"> Recebimentos</a></li>
                    <li class="breadcrumb-item active"> Editar recebimento</li>
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
                <h3 class="card-title"><a href="{{route('recebimentos.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'racao/recebimentos/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
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
                {!! Form::open(['route' => ['recebimentos.update', 'recebimento' => $recebimento->id_recebimento], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Data do recebimento: </label>
                    <div class="col-lg-8">
                        <input id="dataform" class="form-control" type="text" name="data_recebimento" value="{{date("d/m/Y",strtotime($recebimento->data_recebimento))}}">
                        @error('data_recebimento')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('horarecebimento', 'Hora do recebimento', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('hora_recebimento', date("H:i", strtotime($recebimento->hora_recebimento)), ['id' => 'horarecebimento', 'class' => 'form-control']) !!}
                        @error('hora_recebimento')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote_id', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote'), $recebimento->lote_id, ['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('lote_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('sexo', 'Sexo das aves', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('sexo', ['1' => 'Fêmea', '2' => 'Macho'], $recebimento->femea > 0 ? 1 : 2, ['id' => 'sexo', 'class' => 'form-control input-total']) !!}
                        @error('sexo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('quantidade', 'Quantidade (Kg)', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('quantidade', $recebimento->femea > 0 ? $recebimento->femea : $recebimento->macho, ['id' => 'quantidade', 'class' => 'form-control input-total']) !!}
                        @error('quantidade')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    {!! Form::label('notafiscal', 'Nota fiscal', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('nota_fiscal', $recebimento->nota_fiscal, ['id' => 'notafiscal', 'class' => 'form-control input-total']) !!}
                        @error('nota_fiscal')
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