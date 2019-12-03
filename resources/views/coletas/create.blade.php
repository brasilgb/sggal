@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-cart-plus"></i> Coletas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('coletas.index')}}">Coletas</a></li>
                    <li class="breadcrumb-item active">Adicionar coleta</li>
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
                <h3 class="card-title"><button disabled="" class="btn btn-primary btn-flat btn-disabled"><i class="fas fa-plus-square"></i> Adicionar coleta</button></h3>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input id="datasearch" class="form-control form-control-navbar" type="search" placeholder="Buscar por data" aria-label="Buscar">
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
            
            <div class="col-lg-6">
                <form class="form-horizontal" action="{{route('coletas.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input id="dataform" class="form-control" type="text" name="datacoleta" value="<?=date("d/m/Y");?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Hora da coleta: </label>
                        <div class="col-lg-9">
                            <input id="horacoleta" class="form-control" type="text" name="horacoleta" value="<?=date("H:i");?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lote: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Aviário: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Num. da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Limpos do ninho: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sujos do ninho: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">De cama incubáveis: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Duas gemas: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pequenos: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Trincados: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Casca fina: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deformados: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Frios: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sujos não aproveitáveis: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Esmagados e quebrados: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">De cama não incubáveis: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total de incubáveis: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total de incubáveis bons: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total de incubáveis bons: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total comerciais: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Postura do dia: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label"></div>
                        <div class="col-lg-9 text-right">
                            <button class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </div>
                    
                </form>
            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection