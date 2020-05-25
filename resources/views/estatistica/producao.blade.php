@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-chart-line"></i> Estatistica</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Produção</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-1">
            <h3 class="card-title"><i class="fa fa-plus-square"></i> Produção %</h3>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover">
                    <tr>
                        <th>Semana</th><th>Data inicial</th><th>Data final</th><th>Produção</th>
                    </tr>
                    @forelse($semanas as $semana)
                    <tr>
                        <td>{{$semana->semana}}</td><td>{{date("d-m-Y", strtotime($semana->data_inicial))}}</td><td>{{date("d-m-Y", strtotime($semana->data_final))}}</td>
                        <td>
                            {!! Form::text('producao',$semana->producao,['id' => 'producao', 'class' => 'form-semana', 'id-semana' => $semana->id_semana, 'placeholder' => '%']) !!}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10"><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Não há produção cadastrada em sua base de dados!</div></td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->

</div>

@endsection