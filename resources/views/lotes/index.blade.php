@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-pallet"></i> Lotes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Lotes</li>
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
                <h3 class="card-title"><button onclick="window.location.href = '{{route('lotes.create')}}'" class="btn btn-primary btn-flat"><i class="fas fa-plus-square"></i> Adicionar lote</button></h3>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Buscar por lote" aria-label="Buscar">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <tr>
                        <th>ID</th><th>Lote</th><th>Fêmeas</th><th>Capitalizadas</th><th>Machos</th><th>Capitalizados</th><th>Total</th><th>Aviários</th><th>Cadastro</th><th><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($lotes as $lote)
                    <tr>
                        <td>{{$lote->id}}</td><td>{{$lote->lote}}</td><td>{{$lote->femeas}}</td><td>{{$lote->femeas_capitalizadas}}</td><td>{{$lote->machos}}</td><td>{{$lote->machos_capitalizados}}</td><td>{{$lote->femeas + $lote->machos}}</td><td>0</td><td>{{$lote->data_lote}}</td>
                        <td>
                            
                            <button onclick="window.location.href = '{{route('lotes.show',['lote'=>$lote->id])}}'" class="btn btn-primary btn-flat">Editar</button>
                            <button onclick="" class="btn btn-danger btn-flat">Excluir</button>
                        </td>
                    </tr>
                    {{$lotes->links()}}
                    @empty
                    <tr><td colspan="10"><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Não há lotes cadastrados em sua base de dados!</div></td></tr>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection