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
                    <li class="breadcrumb-item"><a href="{{route('lotes.index')}}">Lotes</a></li>
                    <li class="breadcrumb-item active">Adicionar lote</li>
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
                <h3 class="card-title"><a href="{{route('lotes.index')}}" class="btn btn-primary btn-flat"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3" action="{{url('lotes/search')}}" method="post">
                    <div class="input-group input-group-sm">
                        @csrf
                        <input class="form-control form-control-navbar" type="text" name="porlote" placeholder="Buscar por lote" required="">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">

            <div class="col-lg-6">

                <form class="form-horizontal" action="{{route('lotes.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Data do lote: </label>
                        <div class="col-lg-7">
                            <input id="dataform" class="form-control" type="text" name="data_lote" value="<?= date("d/m/Y"); ?>">
                            @error('data_lote')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Identificação do lote: </label>
                        <div class="col-lg-7">
                            <input class="form-control" type="text" name="lote" value="{{old('lote')}}">
                            @error('lote')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input class="form-control" type="text" name="femeas" value="{{old('femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input class="form-control" type="text" name="machos" value="{{old('machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-5 col-form-label"></div>
                        <div class="col-lg-7 text-right">
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