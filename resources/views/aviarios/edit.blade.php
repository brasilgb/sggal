@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fa fa-pallet"></i> Aviários</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('aviarios.index')}}">Aviários</a></li>
                    <li class="breadcrumb-item active">Adicionar aviário</li>
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
                <h3 class="card-title"><a href="{{route('aviarios.index')}}" class="btn btn-primary btn-flat"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'aviarios/search', 'method' => 'POST', 'class' => 'form-inline ml-3']) !!}
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
            <div class="col-lg-6">
                {!! Form::open(['route' => ['aviarios.update', 'aviario' => $aviario->id_aviario], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

                <div class="form-group row">
                    {!! Form::label('data_aviario', 'Data aviario', ['class' => 'col-lg-4 col-label-form']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('data_aviario', date('d/m/Y', strtotime($aviario->data_aviario)), ['id' => 'dataform', 'class' => 'form-control']) !!}
                        @error('data_aviario')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote_id', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote')->prepend('Selecione o lote', ''), $aviario->lote_id,['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('lote_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('aviario', 'Identificação do aviário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('aviario', $aviario->aviario, ['id' => 'nextaviario', 'class' => 'form-control']) !!}
                        @error('aviario')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Box 1 -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-box"></i> Box 1</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box1_femea', 'Aves fêmeas', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box1_femea', $aviario->box1_femea, ['class' => 'form-control input-femea input-total']) !!}
                        @error('box1_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box1_macho', 'Aves machos', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box1_macho', $aviario->box1_macho, ['class' => 'form-control input-macho input-total']) !!}
                        @error('box1_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-box"></i> Box 2</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box2_femea', 'Aves fêmeas', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box2_femea', $aviario->box2_femea, ['class' => 'form-control input-femea input-total']) !!}
                        @error('box2_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box2_macho', 'Aves machos', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box2_macho', $aviario->box2_macho, ['class' => 'form-control input-macho input-total']) !!}
                        @error('box2_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-box"></i> Box 3</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box3_femea', 'Aves fêmeas', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box3_femea', $aviario->box3_femea, ['class' => 'form-control input-femea input-total']) !!}
                        @error('box3_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box3_macho', 'Aves machos', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box3_macho', $aviario->box3_macho, ['class' => 'form-control input-macho input-total']) !!}
                        @error('box3_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Box 4 -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-box"></i> Box 4</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box4_femea', 'Aves fêmeas', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box4_femea', $aviario->box4_femea, ['class' => 'form-control input-femea input-total']) !!}
                        @error('box4_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('box4_macho', 'Aves machos', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('box4_macho', $aviario->box4_macho, ['class' => 'form-control input-macho input-total']) !!}
                        @error('box4_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Totais -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-boxes"></i> Totais</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('tot_femea', 'Aves fêmeas', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_femea', $aviario->tot_femea, ['id' => 'totfemea', 'class' => 'form-control']) !!}
                        @error('tot_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('tot_macho', 'Aves machos', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_macho', $aviario->tot_macho, ['id' => 'totmacho', 'class' => 'form-control']) !!}
                        @error('tot_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('totave', 'Total de aves', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_ave', $aviario->tot_ave, ['id' => 'totave', 'class' => 'form-control']) !!}
                        @error('tot_ave')
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

            </div>

        </div>
    </div>
    <!-- /.card -->

</div>

@endsection