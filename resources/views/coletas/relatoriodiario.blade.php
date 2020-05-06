<!DOCTYPE html>
<html>
    <head>
        <title>Relatório diário</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ url('/css/pdf.css') }}">

    </head>
    <body>
        @if($lotecoleta->count() > 0)

        @forelse($lotecoleta as $col)
        <div class="relatorio" style="page-break-after: always;">
            <table>
                <tr><th style="border: 0;"><h3>Movimento diário de Granjas</h3></th></tr>
            </table>
            <table>
                <tr>
                    <td style="border: 0;">Logo</td><td style="border: 0;">Data: {{$datacoleta}}</td><td style="border: 0;"></td><td style="border: 0;">Lote: {{$col->lote->lote}}</td><td style="border: 0;">Granja: </td>
                </tr>
            </table>
            <table>
                {{$numcoletas = $numcoleta($col->lote_id)}}

                <tr class="bg-gray text-center"><th style="width: 20%;">Postura</th>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$ncoleta->coleta}}ª col.</td>
                    @endforeach
                    <td class="bg-gray-light text-center" style="width: 5%;">Totais</td>
                </tr>
                <tr><td>Limpos do ninho</td>
                    @forelse($numcoletas as $ncoleta){{$coletaslote($col->lote_id, $ncoleta->coleta, 'limpos_ninho')}}
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->limpos_ninho}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Sujos do ninho</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->sujos_ninho}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr class="bg-gray"><td class="text-bold">Total de incubáveis bons <small>Limpos do ninho + Sujos do ninho</small></td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->incubaveis_bons}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Ovos de cama incubáveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->cama_incubaveis}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr class="bg-gray"><td class="text-bold">Total de incubáveis <small>(Limpos do ninho + Sujos do ninho + Ovos de cama incub.)</small></td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->incubaveis}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Duas gemas</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->duas_gemas}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Pequenos</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->pequenos}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Trincados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->trincados}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Casca fina</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->casca_fina}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Deformados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->deformados}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Frios</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->frios}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>*Sujos não aproveitaveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->sujos_nao_aproveitaveis}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Esmagados/quebrados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->esmagados_quebrados}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr><td>Ovos de cama não incubáveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->cama_nao_incubaveis}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr class="bg-gray"><td>Comerciais</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->comerciais}}</td>
                    @endforeach
                    <td>00</td>
                </tr>
                <tr class="bg-gray"><td colspan="{{count($numcoletas) + 1}}" class="text-bold">Postura do dia
                        <small>(Limpos do ninho + sujos do ninho + cama incubáveis + duas gemas + pequenos + trincados + casca fina + deformados + cama não incubáveis + frios + sujos + esmagados/quebrados)</small></td>

                    <td>00</td>
                </tr>
                <tr><td colspan="{{count($numcoletas) + 2}}">*Não enviar ao icubatório. Destinar a compostagem.</td></tr>
            </table>
            <table>
                <tr>
                    <td>Aviários</td>
                    {{$aviarios = $aviarioslote($col->lote_id)}}
                    @forelse($aviarios as $aviario)
                    <td>{{$aviario->aviario}}</td>
                    @endforeach
                    <td>Totais</td>
                </tr>
                <tr>
                    <td>N° fêmeas</td>
                    @forelse($aviarios as $aviario)
                    <td>{{$aviario->femea}}</td>
                    @endforeach
                    <td>{{$aviarios->sum('femea')}}</td>
                </tr>
                <tr>
                    <td>Ovos totais</td>
                    @forelse($aviarios as $aviario)
                    {{$ovos = $dadoscoleta($aviario->id_aviario)}}
                    @forelse($ovos as $ovo)
                    <td>{{$ovo->postura_dia}}</td>
                    @endforeach
                    @endforeach
                    @for($i = 0; $i < count($aviarios) - count($listcoletas($col->lote_id)); $i++)
                    <td>0</td>
                    @endfor
                    <td>000</td>
                </tr>

            </table>
        </div>

        @endforeach
        <div class="relatorio">
            <table style="margin: 0;padding: 0;">
                <tr><th colspan="2" style="border: 0;"><h3 style="margin-bottom: 10px;">Resumo diário de granja</h3></th></tr>
                <tr>
                    <td style="margin: 0 5px 0 0;vertical-align: top; border: 0;">
                        <table>
                            <tr class="bg-gray">
                                <th>Mortalidade</th><th>Machos</th><th>Fêmeas</th><th>Totais</th>
                            </tr>
                            <tr>
                                <td>Aves anterior</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Refugos</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Prolapso</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Calor</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Arranhado</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Outras</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Inprodutivas</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Total mortas</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Aves atuais</td><td></td><td></td><td></td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin: 0 0 0 5px;vertical-align: top; border: 0;">
                        <table>
                            <tr class="bg-gray">
                                <th>Controle de estoque de ovos</th><th>Comerciais</th><th>Incubáveis</th>
                            </tr>
                            <tr>
                                <td>Saldo anterior <br> <small>Saldo atual em estoque</small></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Produzidos <br> <small>Total do movimento diário</small></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Eniado para o incubatório</td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Saldo atual</td><td></td><td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        @else
        <h1>Não tem nada</h1>
        @endif
    </body>
</html>
