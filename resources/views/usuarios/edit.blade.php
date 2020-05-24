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
                    <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Lotes</a></li>
                    <li class="breadcrumb-item active">Adicionar usuario</li>
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
                <h3 class="card-title"><a href="{{route('usuarios.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'usuarios/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porusuario', null, ['class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar por usuario']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submit', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">

            <div class="col-lg-6">
                {!! Form::open(['route' => ['usuarios.update', $usuario->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                
                <div class="form-group row">
                    {!! Form::label('name', 'Nome', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('name', $usuario->name, ['id' => 'name', 'class' => 'form-control', $usuario->username == 'administrador' ? 'readonly' : '']) !!}
                        @error('name')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('username', 'Usuário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('username', $usuario->username, ['class' => 'form-control', $usuario->username == 'administrador' ? 'readonly' : '']) !!}
                        @error('username')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('funcao', 'Função', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('funcao', $usuario->username == 'administrador' ? ['0' => 'Administrador'] : ['0' => 'Administrador', '1' => 'Operador'], $usuario->funcao, ['class' => 'form-control', $usuario->username == 'administrador' ? 'readonly' : '']) !!}
                        @error('funcao')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('password', 'Senha', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::password('password', ['class' => 'form-control', Auth::user()->username == 'administrador' ? '' : 'readonly="readonly"']) !!}
                        @error('password')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('password_confirmation', 'Confirme a senha', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::password('password_confirmation', ['class' => 'form-control', Auth::user()->username == 'administrador' ? '' : 'readonly="readonly"']) !!}
                        @error('password_confirmation')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-form-label"></div>
                    <div class="col-lg-8 text-right">
                        {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary', Auth::user()->username == 'administrador' ? '' : 'disabled="disabled"']) !!}
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