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
                    <li class="breadcrumb-item"><a href="{{route('despesas.index')}}"> Despesas</a></li>
                    <li class="breadcrumb-item active">Editar despesa</li>
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
                <h3 class="card-title"><a href="{{route('despesas.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'financeiro/despesas/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porlote', null, ['id' => 'datasearch', 'class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por lote']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => ['despesas.update', 'despesa' => $despesa->id_despesa], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                <div class="form-group row">
                    {!! Form::label('vencimento', 'Vencimento', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('vencimento',  date("d/m/Y", strtotime($despesa->vencimento)), ['id' => 'dataform', 'class' => 'form-control']) !!}
                        @error('vencimento')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('descritivo', '', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('descritivo', $despesa->descritivo, ['id' => 'descritivo', 'class' => 'form-control']) !!}
                        @error('descritivo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('valor', 'Valor', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('valor', $despesa->valor, ['class' => 'form-control']) !!}
                        @error('valor')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-form-label"></div>
                    <div class="col-lg-8 text-right">
                        {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--</form>-->

            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection