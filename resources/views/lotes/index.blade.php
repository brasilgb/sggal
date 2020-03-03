@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-cubes"></i> Lotes</h3>
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
                <h3 class="card-title"><button onclick="window.location.href = '{{route('lotes.create')}}'" class="btn btn-primary btn-flat btn-sm"><i class="fas fa-plus-square"></i> Adicionar lote</button></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'lotes/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porlote', null, ['class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por lote']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submit', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
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
                        <th>ID</th><th>Lote</th><th>Fêmea</th><th>Capitalizada</th><th>Macho</th><th>Capitalizado</th><th>Total</th><th>Aviários</th><th>Cadastro</th><th style="width: 180px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($lotes as $lote)
                    <tr>
                        <td>{{$lote->id_lote}}</td><td>{{$lote->lote}}</td><td>{{$lote->femea}}</td><td>{{$lote->femea_capitalizadas}}</td><td>{{$lote->macho}}</td><td>{{$lote->macho_capitalizados}}</td><td>{{$lote->femea + $lote->macho}}</td><td>0</td><td>{{date("d/m/Y", strtotime(\Carbon\Carbon::now()))}}</td>
                        <td>
                            <button onclick="window.location.href = '{{route('lotes.show',['lote'=>$lote->id_lote])}}'" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-edit"></i>Editar</button>
                            <form style="float: right;" action="{{route('lotes.destroy', ['lote' => $lote->id_lote])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-trash"></i> Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @if($porlote == '')
                    {{$lotes->links()}}
                    @endif
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