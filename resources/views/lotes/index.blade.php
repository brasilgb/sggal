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
                <table class="table table-striped table-condensed table-hover">
                    <tr>
                        <th>ID</th><th>Lote</th><th>Fêmea</th><th>Capitalizada</th><th>Macho</th><th>Capitalizado</th><th>Total</th><th>Aviários</th><th>Cadastro</th><th style="width: 180px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($lotes as $lote)
                    <tr>
                        <td>{{$lote->id_lote}}</td><td>{{$lote->lote}}</td><td>{{$lote->femea}}</td><td>{{$lote->femea_capitalizadas}}</td><td>{{$lote->macho}}</td><td>{{$lote->macho_capitalizados}}</td><td>{{$lote->femea + $lote->macho}}</td><td>{{$numaviarios($lote->id_lote)}}</td><td>{{date("d/m/Y", strtotime(\Carbon\Carbon::now()))}}</td>
                        <td>
                            <button onclick="window.location.href = '{{route('lotes.show',['lote'=>$lote->id_lote])}}'" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-edit"></i> Editar</button>
                            <button data-toggle="modal" onclick="deleteData({{$lote->id_lote}})" data-target="#DeleteModal" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i> Excluir</button>
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

<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirmar exclusão</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <p class="text-center">Tem certeza de que deseja excluir este lote?<br>
                        <strong class="text-red">ATENÇÂO</strong><br> Será ecluido o lote e junto todos os aviários pertencentes ao mensmo.
                    </p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success btn-flat" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="formSubmit()">Sim, excluir</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function deleteData(id)
     {
         var id = id;
         var url = '{{ route("lotes.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endsection