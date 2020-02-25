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
                <h3 class="card-title"></h3>
                
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'periodos/search', 'method' => 'POST', 'class' => 'form-inline ml-3']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('pordata', null, ['id' => 'dataform', 'class' => 'form-control form-control-navbar', 'placeholder' => 'Buscar por data']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
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
                        <th>Período</th><th>Situação</th><th>Início</th><th>Término</th><th style="width: 200px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($periodos as $periodo)
                    <tr>
                        <td>{{$periodo->id_periodo}}</td><td class="{{$periodo->ativo == "0" ? "bg-warning" : "bg-green"}}">{{$periodo->ativo == "0" ? "Inativo" : "Ativo"}}</td><td>{{date('d/m/Y', strtotime($periodo->created_at))}}</td><td>{{$periodo->desativacao == null ? "" : date('d/m/Y', strtotime($periodo->desativacao))}}</td>
                        <td>
                            
                            <button onclick="window.location.href = '{{route('periodos.atualizaperiodo',['idperiodo' => $periodo->id_periodo, 'ativo'=> $periodo->ativo == 0 ? 1 : 0])}}'" class="btn btn-{{$periodo->ativo == "0" ? "primary" : "warning"}} btn-flat btn-sm text-left" style="width:90px;"><i class="fa fa-{{$periodo->ativo == "0" ? "check-circle" : "times-circle"}}"></i> {{$periodo->ativo == "0" ? "Ativar" : "Desativar"}}</button>
                            {!! Form::open(['route' => ['periodos.destroy', 'ativo' => $periodo->id_periodo], 'method' => 'DELETE', 'class' => 'form-inline', 'style' => 'float:right']) !!}                              
                            {!! Form::button('<i class="fas fa-trash"></i> Excluir', ['type' => 'submit', 'class' => 'btn btn-danger btn-flat btn-sm']) !!}
                            {!! Form::close() !!}
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

@endsection