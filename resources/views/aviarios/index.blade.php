@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-pallet"></i> Aviarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Aviários</li>
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
                <h3 class="card-title"><button onclick="window.location.href = '{{route('aviarios.create')}}'" class="btn btn-primary btn-flat"><i class="fas fa-plus-square"></i> Adicionar aviario</button></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'lotes/search', 'method' => 'POST', 'class' => 'form-inline ml-3']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porlote', null, ['class' => 'form-control form-control-navbar', 'placeholder' => 'Buscar por lote']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['type' => 'submite', 'class' => 'btn btn-primary']) !!}
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
                        <th>ID</th><th>Lote</th><th>Aviario</th><th>Fêmeas</th><th>Machos</th><th>Total</th><th>Cadastro</th><th style="width: 180px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($aviarios as $aviario)
                    <tr>
                        <td>{{$aviario->id_aviario}}</td><td><a class="btn-link" href="{{url('aviarios/returnaviario',['loteid'=>$aviario->lote_id])}}">{{$aviario->lote->lote}}</a></td><td>{{$aviario->aviario}}</td><td>{{$aviario->tot_femea}}</td><td>{{$aviario->tot_macho}}</td><td>{{$aviario->tot_ave}}</td><td>{{date('d/m/Y', strtotime($aviario->data_aviario))}}</td>
                        <td>
                            <button onclick="window.location.href = '{{route('aviarios.show',['aviario'=>$aviario->id_aviario])}}'" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-edit"></i>Editar</button>
                            <form style="float: right;" action="{{route('aviarios.destroy', ['aviario' => $aviario->id_aviario])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-trash"></i> Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @if($poraviario == '')
                    {{$aviarios->links()}}
                    @endif
                    @empty
                    <tr><td colspan="10"><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Não há aviarios cadastrados em sua base de dados!</div></td></tr>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection