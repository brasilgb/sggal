@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h5 class="m-0 text-dark">SGGA - SISTEMA DE GERENCIAMENTO DE GRANJAS AVÍCOLAS</h5>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><i class="fa fa-home"></i></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Info boxes -->
@if($ativo > 0)
@include("flash::message")
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cubes"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Lotes</span>
                <span class="info-box-number">
                    {{$lotes->count()}}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cube"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Aviários</span>
                <span class="info-box-number">{{$aviarios->count()}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-kiwi-bird"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Aves</span>
                <span class="info-box-number">{{$aves->sum->tot_ave}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cart-plus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Postura do dia</span>
                <span class="info-box-number">{{$posturadia->sum->postura_dia}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><span style="padding: 6px!important;" class="badge badge-pill badge-info">Semana atual: {{$semanaatual}}</span> <span style="padding: 6px!important;" class="badge badge-pill badge-danger">Intervalo: {{date("d/m/Y", strtotime($datainicial))}} à {{date("d/m/Y", strtotime("-1 day",strtotime($datafinal)))}}</span>  <span style="padding: 6px!important;" class="badge badge-pill badge-success">Meta semanal: {{$metasemanal}}%</span>  <span style="padding: 6px!important;" class="badge badge-pill badge-warning">Média semanal: {{$mediasemanal}}%</span> </h3>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400" height="150"></canvas>
                <script src="{{asset('/vendor/plugins/chart.js/Chart.bundle.min.js')}}" type="text/javascript"></script>
                <script>
        Chart.pluginService.register({
            beforeRender: function (chart) {
                if (chart.config.options.showAllTooltips) {
                    // create an array of tooltips
                    // we can't use the chart tooltip because there is only one tooltip per chart
                    chart.pluginTooltips = [];
                    chart.config.data.datasets.forEach(function (dataset, i) {
                        chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                            chart.pluginTooltips.push(new Chart.Tooltip({
                                _chart: chart.chart,
                                _chartInstance: chart,
                                _data: chart.data,
                                _options: chart.options.tooltips,
                                _active: [sector]
                            }, chart));
                        });
                    });
                    // turn off normal tooltips
                    chart.options.tooltips.enabled = false;
                }
            },
            afterDraw: function (chart, easing) {
                if (chart.config.options.showAllTooltips) {
                    // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                    if (!chart.allTooltipsOnce) {
                        if (easing !== 1)
                            return;
                        chart.allTooltipsOnce = true;
                    }

                    // turn on tooltips
                    chart.options.tooltips.enabled = true;
                    Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                        // This line checks if the item is visible to display the tooltip
                        if (!tooltip._active[0].hidden) {
                            tooltip.initialize();
                            tooltip.update();
                            // we don't actually need this since we are not animating tooltips
                            tooltip.pivot();
                            tooltip.transition(easing).draw();
                        }
                    });
                    chart.options.tooltips.enabled = false;
                }
            }
        });
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $listdatas; ?>,
                datasets: [{
                        label: 'Produção semanal',
                        data: <?php echo $producaosemana; ?>,
                        backgroundColor: [
                            'rgb(23, 162, 184, 0.0)'
                        ],
                        borderColor: [
                            'rgba(60, 141, 188, 1)'
                        ],
                        borderWidth: 2
                    }]
            },
            options: {
                showAllTooltips: true,
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
            }
        });
                </script>
            </div>
        </div>
    </div>
</div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fa fa-lightbulb"></i> Não há período ativo para esta data! Você deve inicia-lo para acionar as funções do sistema. 
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#periodoModal"><i class="far fa-clock"></i> Iniciar período</button>
                    <!--<button class="ativarperiodo btn btn-default" href="#" onclick="window.location.href = '{{route('periodos.ativaperiodo',['ativo'=> 1])}}'" ><i class="far fa-clock"></i> Abrir período</button>-->
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="periodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {!! Form::open(['route' => 'periodos.store', 'method' => 'POST', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-clock"></i> Iniciar período</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row">
                            {!! Form::label('semana_inicial', 'Semana inicial', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('semana_inicial', old('semana_inicial'), ['id' => 'inicial', 'class' => 'form-control']) !!}
                                @error('semana_inicial')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('semana_final', 'Semana final', ['class' => 'col-lg-4 col-form-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('semana_final', old('final'), ['id' => 'final', 'class' => 'form-control']) !!}
                                @error('semana_final')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('data_inicial', 'Data do início', ['class' => 'col-lg-4 col-form-label', 'autofocus' => true]) !!}
                            <div class="col-lg-8">
                                {!! Form::text('data_inicial', date("d/m/Y", strtotime(\Carbon\Carbon::now())), ['id' => 'dataform', 'class' => 'form-control']) !!}
                                @error('data_inicial')
                                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                        {!! Form::button('<i class="fa fa-sign-out-alt"></i> Sair', ['type' => 'submit', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                        {!! Form::button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        @endif
        <!-- /.row -->
        @endsection