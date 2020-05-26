@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-cube"></i> Aves</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('mortalidades.index')}}">Aves</a></li>
                    <li class="breadcrumb-item active">Editar baixa</li>
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
                <h3 class="card-title"><a href="{{route('mortalidades.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'aves/mortalidades/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
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
                {!! Form::open(['route' => ['mortalidades.update', 'mortalidade' => $mortalidade->id_mortalidade], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    {!! Form::label('data_mortalidade', 'Data baixa', ['class' => 'col-lg-4 col-label-form']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('data_mortalidade', date('d/m/Y', strtotime($mortalidade->data_mortalidade)), ['id' => 'dataform', 'class' => 'form-control']) !!}
                        @error('data_mortalidade')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote_id', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote'), $mortalidade->lote_id,['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('lote_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('id_aviario', 'Identificação do aviário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('id_aviario', $aviarios($mortalidade->lote_id)->pluck('aviario', 'id_aviario'), $mortalidade->id_aviario, ['id' => 'aviariosdolote', 'class' => 'form-control']) !!}
                        @error('id_aviario')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('sexo', 'Sexo das mortalidades', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('sexo', ['' => 'Selecione o sexo', '1' => 'Fêmea', '2' => 'Macho'], $mortalidade->femea > 0 ? 1 : 2, ['id' => 'sexo', 'class' => 'form-control input-total']) !!}
                        @error('sexo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('quantidade', 'Quantidade de aves', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('quantidade', $mortalidade->femea > 0 ? $mortalidade->femea : $mortalidade->macho, ['id' => 'quantidade', 'class' => 'form-control input-total']) !!}
                        <div class="info-num-aves est-aves" style="display: none;">Há <strong class="text-red"></strong> aves <span></span> disponíveis no aviário.</div>
                        @error('quantidade')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    {!! Form::label('motivo', 'Motivo', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('motivo', $motivos, $mortalidade->motivo,['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('motivo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>
                
                {!! Form::hidden('numave', $mortalidade->femea > 0 ? $mortalidade->femea : $mortalidade->macho, ['id' => 'numave', 'class' => 'form-control']) !!}
                
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
    <!-- /.card -->

</div>

<!-- Modal -->
 <div id="baixaaves" class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Reajuste os dados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">O número de aves <span class="sexoaves" style="display: none;"></span> 
                        adicionado ao campo do formulário, ultrapassou o número de aves 
                        <span class="sexoaves" style="display: none;"></span> disponíveis em estoque!</p>
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