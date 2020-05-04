<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ url('/css/pdf.css') }}">

    </head>
    <body>
        
            @forelse($lotecoleta as $col)
            <div class="relatorio">
            <table>
                <tr><th class="text-center">Movimento diário de Granjas</th></tr>
            </table>
            <table>
                <tr>
                    <td>Logo</td><td>Data: {{$datacoleta}}</td><td>Lote: {{$col->lote->lote}}</td><td>Granja: </td>
                </tr>
            </table>
            <table>
                {{$coletas = $coletaslote($col->lote_id)}}
                <tr><th>Hora da coleta</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->hora_coleta}}</td>
                    @endforeach
                </tr>
                <tr><th>Postura</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->coleta}}ª col.</td>
                    @endforeach
                </tr>
                <tr><th>Limpos do ninho</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->limpos_ninho}}</td>
                    @endforeach
                </tr>
                <tr><th>Sujos do ninho</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->sujos_ninho}}</td>
                    @endforeach
                </tr>
                <tr><th>Total incubáveis bons</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->incubaveis_bons}}</td>
                    @endforeach
                </tr>
                <tr><th>Ovos de cama incubáveis</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->cama_incubaveis}}</td>
                    @endforeach
                </tr>
                <tr><th>Total incubáveis</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->incubaveis}}</td>
                    @endforeach
                </tr>
                <tr><th>Duas gemas</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->duas_gemas}}</td>
                    @endforeach
                </tr>
                <tr><th>Pequenos</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->pequenos}}</td>
                    @endforeach
                </tr>
                <tr><th>Trincados</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->trincados}}</td>
                    @endforeach
                </tr>
                <tr><th>Casca fina</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->casca_fina}}</td>
                    @endforeach
                </tr>
                <tr><th>Deformados</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->deformados}}</td>
                    @endforeach
                </tr>
                <tr><th>Frios</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->frios}}</td>
                    @endforeach
                </tr>
                <tr><th>*Sujos não aproveitaveis</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->sujos_nao_aproveitaveis}}</td>
                    @endforeach
                </tr>
                <tr><th>Esmagados/quebrados</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->esmagados_quebrados}}</td>
                    @endforeach
                </tr>
                <tr><th>Ovos de cama não incubáveis</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->cama_nao_incubaveis}}</td>
                    @endforeach
                </tr>
                <tr><th>Comerciais</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->comerciais}}</td>
                    @endforeach
                </tr>
                <tr><th>Postura do dia</th>
                    @forelse($coletas as $coleta)
                    <td>{{$coleta->incubaveis_bons}}</td>
                    @endforeach
                </tr>
                <tr><td colspan="{{count($coletas)+1}}">*Não enviar ao icubatório. Destinar a compostagem.</td></tr>
            </table>
        </div>
            @endforeach 
    </body>
</html>