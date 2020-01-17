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

            <div class="col-lg-6">
                {!! Form::open(['route' => 'lotes.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                <div class="form-group row">
                    {!! Form::label('data_lote', 'Data do Lote', ['class' => 'col-lg-5 col-form-label']) !!}
                    <div class="col-lg-7">
                        {!! Form::text('data_lote',  date("d/m/Y", strtotime(\Carbon\Carbon::now())), ['id' => 'dataform', 'class' => 'form-control']) !!}
                        @error('data_lote')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote', 'Identificação do lote', ['class' => 'col-lg-5 col-form-label']) !!}
                    <div class="col-lg-7">
                        {!! Form::text('lote', old('lote'), ['class' => 'form-control']) !!}
                        @error('lote')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('femeas', 'Aves fêmeas', ['class' => 'col-lg-5 col-form-label']) !!}
                    <div class="col-lg-7">
                        {!! Form::text('femeas', old('femeas'), ['class' => 'form-control']) !!}
                        @error('femeas')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('machos', 'Aves machos', ['class' => 'col-lg-5 col-form-label']) !!}
                    <div class="col-lg-7">
                        {!! Form::text('machos', old('machos'), ['class' => 'form-control']) !!}
                        @error('machos')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-5 col-form-label"></div>
                    <div class="col-lg-7 text-right">
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