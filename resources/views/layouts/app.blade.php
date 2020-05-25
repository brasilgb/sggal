@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>
@stop
@section('footer')
<strong>Copyright &copy; 2018- <?= date("Y"); ?> <a href="#">SGGA</a>.</strong>
Todos os direitos reservados.
<div class="float-right d-none d-sm-inline-block">
    <b>Versão</b> 3.0
</div>
@stop
@section('css')
<!-- jquery-ui -->
<link rel="stylesheet" href="/css/local.css">
@stop

@section('js')
<!-- daterangepicker -->

<script src="{{asset('js/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('js/local.js')}}"></script>
<script>
    $('#dataform, #datasearch').datepicker({
    dateFormat: 'dd/mm/yy',
            todayHighlight: true,
            language: 'pt-BR',
            autoclose: true,
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
    });
</script>
@stop