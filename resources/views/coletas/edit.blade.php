@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-cart-plus"></i> Coletas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('coletas.index')}}">Coletas</a></li>
                    <li class="breadcrumb-item active">Adicionar coleta</li>
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
                <h3 class="card-title"><a href="{{route('coletas.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'coletas/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
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
            {!! Form::open(['route' => ['coletas.update', 'coleta' => $coleta->id_coleta], 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        {!! Form::label('dataform', 'Data da coleta', ['class' => 'col-lg-4 col-form-label', 'autofocus' => true]) !!}
                        <div class="col-lg-6">
                            {!! Form::text('data_coleta', date("d/m/Y", strtotime($coleta->data_coleta)), ['id' => 'dataform', 'class' => 'form-control']) !!}
                            @error('data_coleta')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('horacoleta', 'Hora da coleta', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('hora_coleta', date("H:i", strtotime($coleta->hora_coleta)), ['id' => 'horacoleta', 'class' => 'form-control']) !!}
                            @error('hora_coleta')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('loteid', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote'), $coleta->lote_id, ['id' => 'loteid', 'class' => 'form-control']) !!}
                            @error('lote_id')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('id_aviario', 'Aviario', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::select('id_aviario', $aviarios->pluck('aviario', 'id_aviario'), $coleta->id_aviario, ['id' => 'aviariosdolote', 'class' => 'form-control']) !!}
                            @error('id_aviario')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('coleta', 'N° da coleta', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('coleta', $coleta->coleta, ['id' => 'numcoleta', 'class' => 'form-control']) !!}
                            @error('coleta')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('limpos_ninho', 'Limpos do ninho', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('limpos_ninho', $coleta->limpos_ninho, ['id' => 'limpos_ninho', 'class' => 'incubaveisbons incubaveis posturadia form-control']) !!}
                            @error('limpos_ninho')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('sujos_ninho', 'Sujos do ninho', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('sujos_ninho', $coleta->sujos_ninho, ['id' => 'sujos_ninho', 'class' => 'incubaveisbons incubaveis posturadia form-control']) !!}
                            @error('sujos_ninho')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('cama_incubaveis', 'De cama incubáveis', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('cama_incubaveis', $coleta->cama_incubaveis, ['id' => 'cama_incubaveis', 'class' => 'incubaveis posturadia form-control']) !!}
                            @error('cama_incubaveis')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('duas_gemas', 'Duas gemas', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('duas_gemas', $coleta->duas_gemas, ['id' => 'duas_gemas', 'class' => 'comerciais posturadia form-control']) !!}
                            @error('duas_gemas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('pequenos', 'Pequenos', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('pequenos', $coleta->pequenos, ['id' => 'pequenos', 'class' => 'comerciais posturadia form-control']) !!}
                            @error('pequenos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('trincados', 'Trincados', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('trincados', $coleta->trincados, ['id' => 'trincados', 'class' => 'comerciais posturadia form-control']) !!}
                            @error('trincados')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        {!! Form::label('casca_fina', 'Casca fina', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('casca_fina', $coleta->casca_fina, ['id' => 'casca_fina', 'class' => 'comerciais posturadia form-control']) !!}
                            @error('casca_fina')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('deformados', 'Deformados', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('deformados', $coleta->deformados, ['id' => 'deformados', 'class' => 'comerciais posturadia form-control']) !!}
                            @error('deformados')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('frios', 'Frios', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('frios', $coleta->frios, ['id' => 'frios', 'class' => 'comerciais posturadia form-control']) !!}
                        @error('frios')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('sujos_nao_aproveitaveis', 'Sujos não aproveitaveis', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('sujos_nao_aproveitaveis', $coleta->sujos_nao_aproveitaveis, ['id' => 'sujos_nao_aproveitaveis', 'class' => 'posturadia form-control']) !!}
                        @error('sujos_nao_aproveitaveis')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('esmagados_quebrados', 'Esmagados e quebrados', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('esmagados_quebrados', $coleta->esmagados_quebrados, ['id' => 'esmagados_quebrados', 'class' => 'posturadia form-control']) !!}
                        @error('esmagados_quebrados')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('descarte', 'Descarte', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('descarte', $coleta->descarte, ['id' => 'descarte', 'class' => 'posturadia form-control']) !!}
                        @error('descarte')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('cama_nao_incubaveis', 'De cama não incubáveis', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('cama_nao_incubaveis', $coleta->cama_nao_incubaveis, ['id' => 'cama_nao_incubaveis', 'class' => 'comerciais posturadia form-control']) !!}
                        @error('cama_nao_incubaveis')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('incubaveis', 'Incubáveis', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('incubaveis', $coleta->incubaveis, ['id' => 'incubaveis', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('incubaveis_bons', 'Incubáveis bons', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('incubaveis_bons', $coleta->incubaveis_bons, ['id' => 'incubaveisbons', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('comerciais', 'Comerciais', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('comerciais', $coleta->comerciais, ['id' => 'comerciais', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('postura_dia', 'Postura do dia', ['class' => 'col-lg-4 col-form-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('postura_dia', $coleta->postura_dia, ['id' => 'posturadia', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4 col-form-label"></div>
                        <div class="col-lg-6 text-right">
                            {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary salvar']) !!}
                        </div>
                    </div>

                </div>

            </div></form>
        </div>
    </div> 
    <!-- /.card -->

</div>

@endsection