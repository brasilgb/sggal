@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-truck"></i> Envios</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('envios.index')}}"> Envios</a></li>
                    <li class="breadcrumb-item active"> Adicionar envio</li>
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
                <h3 class="card-title"><a href="{{route('envios.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'envios/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('pordata', null, ['id' => 'datasearch', 'class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por data']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submite', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => 'envios.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Data do envio </label>
                    <div class="col-lg-8">
                        <input id="dataform" class="form-control" type="text" name="data_envio" value="<?= date("d/m/Y"); ?>">
                        @error('data_envio')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('horaenvio', 'Hora do envio', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('hora_envio', date("H:i", strtotime(\Carbon\Carbon::now())), ['id' => 'horaenvio', 'class' => 'form-control']) !!}
                        @error('hora_envio')
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
                    {!! Form::label('incubaveis', 'Incubáveis', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('incubaveis', old('incubaveis'), ['id' => 'envioincubaveis', 'class' => 'totalenvio form-control']) !!}
                        {!! Form::hidden('numincubaveis', '0', ['id' => 'numincubaveis']) !!}
                        <div class="info-incubaveis est-ovos" style="display: none;">Há <strong class="text-red"></strong> ovos incubávies disponíveis no lote.</div>
                        @error('incubaveis')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('comerciais', 'Comerciais', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('comerciais', old('comerciais'), ['id' => 'enviocomerciais', 'class' => 'totalenvio form-control']) !!}
                        {!! Form::hidden('numcomerciais', '0', ['id' => 'numcomerciais']) !!}
                        <div class="info-comerciais est-ovos" style="display: none;">Há <strong class="text-red"></strong> ovos comerciais disponíveis no lote.</div>
                        @error('comerciais')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('totalenvio', 'Total para envio', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('postura_dia', old('postura_dia'), ['id' => 'totalenvio', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-form-label"></div>
                    <div class="col-lg-8 text-right">
                        {!! Form::button('<i class="fa fa-senvio"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary salvar']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>
</div>

<!-- /.card -->
<!-- Modal -->
<div id="ovosenvios" class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Reajuste os dados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">O número de ovos <span class="tipoovos"></span> 
                    adicionado ao campo do formulário, ultrapassou o número de ovos 
                    <span class="tipoovos"></span> disponíveis no estoque!</p>
            </div>
            <div class="modal-footer right-content-between">
                <button type="button" class="btn btn-success float-right" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection