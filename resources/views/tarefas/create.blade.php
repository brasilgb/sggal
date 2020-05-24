@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-check-square"></i> Tarefas</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('tarefas.index')}}"> Tarefas</a></li>
                    <li class="breadcrumb-item active">Adicionar tarefa</li>
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
                <h3 class="card-title"><a href="{{route('tarefas.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'tarefas/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
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

            <div class="col-lg-6">
                {!! Form::open(['route' => 'tarefas.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                <div class="form-group row">
                    {!! Form::label('inicio', 'Início', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-4">
                        {!! Form::text('data_inicio',  date("d/m/Y", strtotime(\Carbon\Carbon::now())), ['id' => 'dataform', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!! Form::text('hora_inicio',  date("H:i", strtotime(\Carbon\Carbon::now())), ['id' => 'horaform', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        @error('data_inicio')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                        @error('hora_inicio')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('previsao', 'Previsão', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-4">
                        {!! Form::text('data_previsao',  date("d/m/Y", strtotime(\Carbon\Carbon::now())), ['id' => 'dataform', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!! Form::text('hora_previsao',  date("H:i", strtotime(\Carbon\Carbon::now())), ['id' => 'horaform', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        @error('data_previsao')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                        @error('hora_previsao')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('descritivo', '', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('descritivo', old('descritivo'), ['id' => 'descritivo', 'class' => 'form-control']) !!}
                        @error('descritivo')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('descricao', 'Descrição', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('descricao', old('descricao'), ['class' => 'form-control', 'rows' => 3]) !!}
                        @error('descricao')
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