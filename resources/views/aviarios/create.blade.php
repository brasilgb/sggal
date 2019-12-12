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
                <form class="form-inline ml-3" action="{{url('aviarios/search')}}" method="post">
                    <div class="input-group input-group-sm">
                        @csrf
                        <input class="form-control form-control-navbar" type="text" name="poraviario" placeholder="Buscar por aviario" required="">
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

                <form class="form-horizontal" action="{{route('aviarios.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Data do aviario: </label>
                        <div class="col-lg-7">
                            <input id="dataform" class="form-control" type="text" name="data_aviario" value="<?= date("d/m/Y"); ?>">
                            @error('data_aviario')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Lote: </label>
                        <div class="col-lg-7">
                            <select style=";" class="form-control select2" name="lote">
                                <option value="">Selecione o lote</option>
                                @foreach($lotes as $lote)
                                <option value="{{$lote->id_lote}}">{{$lote->lote}}</option>
                                @endforeach
                            </select>
                            @error('lote')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Identificação do aviario: </label>
                        <div class="col-lg-7">
                            <input class="form-control" type="text" name="aviario" value="{{old('aviario')}}">
                            @error('aviario')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Box 1 -->
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <h3 class="card-title title-form">Box 1</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-femeas input-total" type="text" name="box1_femeas" value="{{old('box1_femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-machos input-total" type="text" name="box1_machos" value="{{old('box1_machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Box 2 -->
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <h3 class="card-title title-form">Box 2</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-femeas input-total" type="text" name="box2_femeas" value="{{old('box2_femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-machos input-total" type="text" name="box2_machos" value="{{old('box2_machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Box 3 -->
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <h3 class="card-title title-form">Box 3</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-femeas input-total" type="text" name="box3_femeas" value="{{old('box3_femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-machos input-total" type="text" name="box3_machos" value="{{old('box3_machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Box 4 -->
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <h3 class="card-title title-form">Box 4</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-femeas input-total" type="text" name="box4_femeas" value="{{old('box4_femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input class="form-control input-machos input-total" type="text" name="box4_machos" value="{{old('box4_machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Box 4 -->
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <h3 class="card-title title-form">Totais</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves fêmeas: </label>
                        <div class="col-lg-7">
                            <input id="totfemeas" class="form-control" type="text" name="tot_femeas" value="{{old('tot_femeas')}}">
                            @error('femeas')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Aves machos: </label>
                        <div class="col-lg-7">
                            <input id="totmachos" class="form-control" type="text" name="tot_machos" value="{{old('tot_machos')}}">
                            @error('machos')
                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Total de aves: </label>
                        <div class="col-lg-7">
                            <input id="totaves" class="form-control" type="text" name="tot_aves" value="{{old('tot_aves')}}">
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