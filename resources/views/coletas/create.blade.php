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
                        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
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
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input id="datacoleta" class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data da coleta: </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="data">
                        </div>
                    </div>
                    
                    
                </form>
            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection