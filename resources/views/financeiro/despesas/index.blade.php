@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-coins"></i> Financeiro</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"> Despesas</li>
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
                <h3 class="card-title"><button onclick="window.location.href = '{{route('despesas.create')}}'" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> Adicionar despesa</button></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'financeiro/despesas/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('pordata', null, ['id' => 'datasearch', 'class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por data']) !!}
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
                <table class="table table-striped table-condensed table-hover">
                    <tr>
                        <th>ID</th><th>Descritivo</th><th>Valor</th><th>Vencimento</th><th style="width: 180px;"><i class="fa fa-level-down-alt"></i></th>
                    </tr>
                    @forelse($despesas as $despesa)
                    <tr>
                        <td>{{$despesa->id_despesa}}</td><td>{{$despesa->descritivo}}</td><td>{{$despesa->valor}}</td><td>{{date("d/m/Y", strtotime($despesa->data_vencimento))}}</td>
                        <td>
                            <button onclick="window.location.href = '{{route('despesas.show',['despesa'=>$despesa->id_despesa])}}'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</button>
                            <button data-toggle="modal" onclick="deleteData({{$despesa->id_despesa}})" data-target="#DeleteModal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Excluir</button>
                            </td>
                    </tr>
                    @if($pordata == '')
                    {{$despesas->links()}}
                    @endif
                    @empty
                    <tr><td colspan="10"><div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Não há despesas cadastradas em sua base de dados!</div></td></tr>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
    <!-- /.card -->
</div>

<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
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
                    <p class="text-center">Tem certeza de que deseja excluir esta despesa?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Sim, excluir</button>
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
         var url = '{{ route("despesas.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endsection