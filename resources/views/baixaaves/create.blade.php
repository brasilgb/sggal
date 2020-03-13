@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><i class="fas fa-fw fa-cube"></i> Aviários</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('baixaaves.index')}}">Aviários</a></li>
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
                <h3 class="card-title"><a href="{{route('baixaaves.index')}}" class="btn btn-primary btn-flat btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a></h3>
                <!-- SEARCH FORM -->
                {!! Form::open(['url' => 'lotes/search', 'method' => 'POST', 'class' => 'form-inline ml-3', 'autocomplete' => 'off']) !!}
                <div class="input-group input-group-sm">
                    {!! Form::text('porlote', null, ['class' => 'input-search form-control form-control-navbar', 'placeholder' => 'Buscar baixaaves do lote']) !!}
                    <div class="input-group-append">
                        {!! Form::button('<i class="fas fa-search"></i>', ['id' => 'search-btn', 'type' => 'submite', 'class' => 'btn btn-primary', 'disabled' => 'true']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <!--SEARCH FORM-->
            </div>
        </div>
        <div class="card-body">
            @include("flash::message")
            <div class="col-lg-6">
                {!! Form::open(['route' => 'baixaaves.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Data de baixa: </label>
                    <div class="col-lg-8">
                        <input id="dataform" class="form-control" type="text" name="data_baixaave" value="<?= date("d/m/Y"); ?>">
                        @error('data_baixaave')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('lote_id', 'Lote', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::select('lote_id', $lotes->pluck('lote', 'id_lote')->prepend('Selecione o lote', ''), old('lote_id'),['id' => 'loteid', 'class' => 'form-control']) !!}
                        @error('lote_id')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> O campo lote deve ser selecionado!</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('aviario_id', 'Aviário', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        
                        {!! Form::select('aviario_id', ['' => 'Selecione o lote'], false,['class' => 'form-control']) !!}
                        <select name="aviario_id" id="aviariosdolote" class="form-control" style="display: none;">
                            
                        </select>
                        @error('baixaave')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>

                <!--Colapse***********************-->
                <div class="accordion" id="accordionAviario">
                    <!-- Box 1 -->
                    <div class="form-group row">
                        <div class="card-header col-lg-12 bg-gray-light" id="headingOne">
                            <h3 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-box"></i> Box 1
                                </button>
                            </h3>
                        </div>
                    </div>
                    
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAviario">
                        <div class="form-group row">
                            {!! Form::label('box1_femea', 'Aves fêmea', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box1_femea', old('box1_femea'), ['class' => 'form-control input-femea input-total']) !!}
                                @error('box1_femea')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('box1_macho', 'Aves macho', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box1_macho', old('box1_macho'), ['class' => 'form-control input-macho input-total']) !!}
                                @error('box1_macho')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Box 2 -->
                    <div class="form-group row">
                        <div class="card-header col-lg-12 card-title bg-gray-light" id="headingTwo">
                            <h3 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-box"></i> Box 2
                                </button>
                            </h3>
                        </div>
                    </div>

                    <div id="collapseTwo" class="collapse collapsed" aria-labelledby="headingTwo" data-parent="#accordionAviario">
                        <div class="form-group row">
                            {!! Form::label('box2_femea', 'Aves fêmea', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box2_femea', old('box2_femea'), ['class' => 'form-control input-femea input-total']) !!}
                                @error('box2_femea')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('box2_macho', 'Aves macho', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box2_macho', old('box2_macho'), ['class' => 'form-control input-macho input-total']) !!}
                                @error('box2_macho')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Box 3 -->
                    <div class="form-group row">
                        <div class="card-header col-lg-12 card-title bg-gray-light" id="headingThree">
                            <h3 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa fa-box"></i> Box 3
                                </button>
                            </h3>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse collapsed" aria-labelledby="headingThree" data-parent="#accordionAviario">
                        <div class="form-group row">
                            {!! Form::label('box3_femea', 'Aves fêmea', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box3_femea', old('box3_femea'), ['class' => 'form-control input-femea input-total']) !!}
                                @error('box3_femea')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('box3_macho', 'Aves macho', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box3_macho', old('box3_macho'), ['class' => 'form-control input-macho input-total']) !!}
                                @error('box3_macho')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Box 4 -->
                    <div class="form-group row">
                        <div class="card-header col-lg-12 card-title bg-gray-light" id="headingFour">
                            <h3 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fa fa-box"></i> Box 4
                                </button>
                            </h3>
                        </div>
                    </div>
                    <div id="collapseFour" class="collapse collapsed" aria-labelledby="headingFour" data-parent="#accordionAviario">
                        <div class="form-group row">
                            {!! Form::label('box4_femea', 'Aves fêmea', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box4_femea', old('box4_femea'), ['class' => 'form-control input-femea input-total']) !!}
                                @error('box4_femea')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('box4_macho', 'Aves macho', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('box4_macho', old('box4_macho'), ['class' => 'form-control input-macho input-total']) !!}
                                @error('box4_macho')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      </div>  
                    <!--Div fim colapse-->
                </div>
                <!-- Totais -->
                <div class="form-group row">
                    <div class="card-header col-lg-12 card-title bg-gray-light">
                        <h3 class="card-title uppercase"><i class="fa fa-boxes"></i> Totais</h3>
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('tot_femea', 'Aves fêmea', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_femea', old('tot_femea'), ['id' => 'totfemea', 'class' => 'form-control']) !!}
                        @error('tot_femea')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('tot_macho', 'Aves macho', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_macho', old('tot_macho'), ['id' => 'totmacho', 'class' => 'form-control']) !!}
                        @error('tot_macho')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('totave', 'Total de aves', ['class' => 'col-lg-4 col-form-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('tot_ave', old('tot_ave'), ['id' => 'totave', 'class' => 'form-control']) !!}
                        @error('tot_ave')
                        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-form-label"></div>
                    <div class="col-lg-8 text-right">
                        {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary salvar']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>
    <!-- /.card -->
    <!-- Modal -->
    <div id="addAvesAviario" class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-danger">
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Reajuste os dados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">O número de aves <span class="sexoaves" style="display: none;"></span> 
                        adicionado ao campo do formulário, ultrapassou o número de aves 
                        <span class="sexoaves" style="display: none;"></span> disponíveis no lote!</p>
                </div>
                <div class="modal-footer right-content-between">
                    <button type="button" class="btn btn-success btn-flat float-right" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection