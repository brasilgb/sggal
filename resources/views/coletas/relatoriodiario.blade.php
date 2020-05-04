<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ url('/css/pdf.css') }}">

    </head>
    <body>
        <div class="relatorio">
            <table>
                <tr><th class="text-center">Relatório diário de Granjas</th></tr>
            </table>
            <table>
                <tr>
                    @forelse($coletas as $coleta)
                    <th>Coleta</th><td>{{$coleta->coleta}}</td>
                    @endforeach
                </tr>
            </table>
        </div>
    </body>
</html>