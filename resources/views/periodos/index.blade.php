@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-clock"></i> Períodos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Períodos</li>
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
                <h3 class="card-title">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#periodoModal"><i class="far fa-clock"></i> Novo período</button>
                </h3>
                
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'periodos/search', 'method' => 'POST', 'class' => 'form-inline ml-3']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('pordata', null, ['id' => 'dataform', 'class' => 'date-search form-control form-control-navbar', 'placeholder' => 'Buscar por data']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'date-btn', 'type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="table-responsive">
                <table class="table table-striped table-condensed table-hoveryy">
                    <tr>
                        <th>Período</th><th>Situação</th><th>Início</th><th>Término</th><th style="width: 100px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($periodos as $periodo)
                    <tr>
                        <td>{{$periodo->id_periodo}}</td><td><span style="padding: 8px 10px;width: 100px;" class="{{$periodo->ativo == "0" ? "badge badge-danger" : "badge badge-success"}}">{{$periodo->ativo == "0" ? "Inativo" : "Ativo"}}</span></td><td>{{date('d/m/Y', strtotime($periodo->created_at))}}</td><td>{{$periodo->desativacao == null ? "" : date('d/m/Y', strtotime($periodo->desativacao))}}</td>
                        <td>
                            <button onclick="window.location.href = '{{route('periodos.atualizaperiodo',['idperiodo' => $periodo->id_periodo, 'ativo'=> $periodo->ativo == 0 ? 1 : 0])}}'" class="btn btn-{{$periodo->ativo == "0" ? "primary" : "warning"}} btn-sm text-left" style="width:90px;" id="btn-at-des"><i class="fa fa-{{$periodo->ativo == "0" ? "check-circle" : "times-circle"}}"></i> {{$periodo->ativo == "0" ? "Ativar" : "Desativar"}}</button>
                        </td>
                    </tr>
                    @if($pordata == '')
                    {{$periodos->links()}}
                    @endif
                    @empty
                    <tr><td colspan="10"><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Não há periodos cadastrados em sua base de dados!</div></td></tr>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
    <!-- /.card -->
</div>
<!-- Modal -->
<div class="modal fade" id="periodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => 'periodos.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-clock"></i> Iniciar período</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="form-group row">
                    {!! Form::label('semana_inicial', 'Semana inicial', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('semana_inicial', old('semana_inicial'), ['id' => 'inicial', 'class' => 'form-control']) !!}
                    @error('semana_inicial')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    {!! Form::label('semana_final', 'Semana final', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('semana_final', old('final'), ['id' => 'final', 'class' => 'form-control']) !!}
                        @error('semana_final')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('data_inicial', 'Data do início', ['class' => 'col-lg-4 col-form-label', 'autofocus' => true]) !!}
                    <div class="col-lg-8">
                        {!! Form::text('data_inicial', date("d/m/Y", strtotime(\Carbon\Carbon::now())), ['id' => 'dataform', 'class' => 'form-control']) !!}
                        @error('data_inicial')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                {!! Form::button('<i class="fa fa-sign-out-alt"></i> Sair', ['type' => 'submit', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection