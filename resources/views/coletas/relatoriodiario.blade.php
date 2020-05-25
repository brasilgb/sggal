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

                <tr class="bg-gray-light text-center"><th style="width: 20%;">Postura</th>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$ncoleta->coleta}}ª col.</td>
                    @endforeach
                    <td class="bg-gray text-center" style="width: 5%;">Totais</td>
                </tr>
                <tr><td>Limpos do ninho</td>
                    @forelse($numcoletas as $ncoleta){{$coletaslote($col->lote_id, $ncoleta->coleta, 'limpos_ninho')}}
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->limpos_ninho}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->limpos_ninho}}</td>
                </tr>
                <tr><td>Sujos do ninho</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->sujos_ninho}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->sujos_ninho}}</td>
                </tr>
                <tr class="bg-gray"><td class="text-bold">Total de incubáveis bons <small>Limpos do ninho + Sujos do ninho</small></td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->incubaveis_bons}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->incubaveis_bons}}</td>
                </tr>
                <tr><td>Ovos de cama incubáveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->cama_incubaveis}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->cama_incubaveis}}</td>
                </tr>
                <tr class="bg-gray"><td class="text-bold">Total de incubáveis <small>(Limpos do ninho + Sujos do ninho + Ovos de cama incub.)</small></td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->incubaveis}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->incubaveis}}</td>
                </tr>
                <tr><td>Duas gemas</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->duas_gemas}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->duas_gemas}}</td>
                </tr>
                <tr><td>Pequenos</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->pequenos}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->pequenos}}</td>
                </tr>
                <tr><td>Trincados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->trincados}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->trincados}}</td>
                </tr>
                <tr><td>Casca fina</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->casca_fina}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->casca_fina}}</td>
                </tr>
                <tr><td>Deformados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->deformados}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->deformados}}</td>
                </tr>
                <tr><td>Frios</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->frios}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->frios}}</td>
                </tr>
                <tr><td>*Sujos não aproveitaveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->sujos_nao_aproveitaveis}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->sujos_nao_aproveitaveis}}</td>
                </tr>
                <tr><td>Esmagados/quebrados</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->esmagados_quebrados}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->esmagados_quebrados}}</td>
                </tr>
                <tr><td>Ovos de cama não incubáveis</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->cama_nao_incubaveis}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->cama_nao_incubaveis}}</td>
                </tr>
                <tr class="bg-gray"><td>Comerciais</td>
                    @forelse($numcoletas as $ncoleta)
                    <td>{{$coletaslote($col->lote_id, $ncoleta->coleta)->sum->comerciais}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->comerciais}}</td>
                </tr>
                <tr class="bg-gray-light"><td colspan="{{count($numcoletas) + 1}}" class="text-bold">Postura do dia
                        <small>(Limpos do ninho + sujos do ninho + cama incubáveis + duas gemas + pequenos + trincados + casca fina + deformados + cama não incubáveis + frios + sujos + esmagados/quebrados)</small></td>
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->postura_dia}}</td>
                </tr>
                <tr>
                    <td  class="bg-gray-light" colspan="{{count($numcoletas) + 2}}">*Não enviar ao icubatório. Destinar a compostagem.</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Aviários</td>
                    {{$aviarios = $aviarioslote($col->lote_id)}}
                    @forelse($aviarios as $aviario)
                    <td>{{$aviario->aviario}}</td>
                    @endforeach
                    <td class="bg-gray">Totais</td>
                </tr>
                <tr>
                    <td>N° fêmeas</td>
                    @forelse($aviarios as $aviario)
                    <td>{{$aviario->femea}}</td>
                    @endforeach
                    <td class="bg-gray">{{$aviarios->sum->femea}}</td>
                </tr>
                <tr>
                    <td>Ovos totais</td>
                    @forelse($aviarios as $aviario)
                    {{$ovos = $dadoscoleta($aviario->id_aviario)}}
                    <td>{{$ovos->sum->postura_dia}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->postura_dia}}</td>
                </tr>
                <tr class="bg-gray-light">
                    <td>Produção por aviário(%)</td>
                    @forelse($aviarios as $aviario)
                    {{$ovos = $dadoscoleta($aviario->id_aviario)}}
                    {{$producao = ($ovos->sum->postura_dia * 100) / $aviario->femea = 0 ? 0.1 : $aviario->femea}}
                    @if($producao > 0)
                    <td>{{number_format($producao, 2, ',', '.')}}</td>
                    @else
                    <td>{{$producao}}</td>
                    @endif
                    @endforeach
                    {{$totproducao = ($totcoletalote($col->lote_id)->sum->postura_dia * 100) / $aviarios->sum->femea = 0 ? 0.1 : $aviarios->sum->femea}}
                    <td class="bg-gray">{{number_format($totproducao, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Ovos incubáveis</td>  
                    @forelse($aviarios as $aviario)
                    {{$ovos = $dadoscoleta($aviario->id_aviario)}}
                    <td>{{$ovos->sum->incubaveis}}</td>
                    @endforeach
                    <td class="bg-gray">{{$totcoletalote($col->lote_id)->sum->incubaveis}}</td>
                </tr>
                <tr class="bg-gray-light">
                    <td>Produção de incubáveis(%)</td>  
                    @forelse($aviarios as $aviario)
                    {{$ovos = $dadoscoleta($aviario->id_aviario)}}
                    {{$producao = ($ovos->sum->incubaveis * 100) / $aviario->femea = 0 ? 0.1 : $aviario->femea}}
                    @if($producao > 0)
                    <td>{{number_format($producao, 2, ',', '.')}}</td>
                    @else
                    <td>{{$producao}}</td>
                    @endif
                    @endforeach
                    {{$totproducao = ($totcoletalote($col->lote_id)->sum->incubaveis * 100) / $aviarios->sum->femea = 0 ? 0.1 : $aviarios->sum->femea}}
                    <td class="bg-gray">{{number_format($totproducao, 2, ',', '.')}}</td>
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
                                <th>Mortalidades</th><th>Machos</th><th>Fêmeas</th><th>Totais</th>
                            </tr>
                            <tr class="bg-gray-light">
                                <td>Aves anteriores</td><td>{{$avesemestoque->sum->macho + $totalmortas->sum->macho}}</td><td>{{$avesemestoque->sum->femea + $totalmortas->sum->femea}}</td><td>{{$avesemestoque->sum->tot_ave + $totalmortas->sum->tot_ave}}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="4"><strong><i>Mortalidade galpão</i></strong></td>
                            </tr>
                            <tr>
                                <td>Arranhado</td><td>{{$mortalidades('1')->sum->macho}}</td><td>{{$mortalidades('1')->sum->femea}}</td><td>{{$mortalidades('1')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Artrite</td><td>{{$mortalidades('2')->sum->macho}}</td><td>{{$mortalidades('2')->sum->femea}}</td><td>{{$mortalidades('2')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Descarte eliminada</td><td>{{$mortalidades('3')->sum->macho}}</td><td>{{$mortalidades('3')->sum->femea}}</td><td>{{$mortalidades('3')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Machucado</td><td>{{$mortalidades('4')->sum->macho}}</td><td>{{$mortalidades('4')->sum->femea}}</td><td>{{$mortalidades('4')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Prolapso</td><td>{{$mortalidades('5')->sum->macho}}</td><td>{{$mortalidades('5')->sum->femea}}</td><td>{{$mortalidades('5')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Refugo</td><td>{{$mortalidades('6')->sum->macho}}</td><td>{{$mortalidades('6')->sum->femea}}</td><td>{{$mortalidades('6')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Outras</td><td>{{$mortalidades('7')->sum->macho}}</td><td>{{$mortalidades('7')->sum->femea}}</td><td>{{$mortalidades('7')->sum->tot_ave}}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="4"><strong><i>Descarte galpão</i></strong></td>
                            </tr>
                            <tr>
                                <td>Descarte abate</td><td>{{$mortalidades('8')->sum->macho}}</td><td>{{$mortalidades('8')->sum->femea}}</td><td>{{$mortalidades('8')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Descarte laboratório</td><td>{{$mortalidades('9')->sum->macho}}</td><td>{{$mortalidades('9')->sum->femea}}</td><td>{{$mortalidades('9')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Erros de sexo</td><td>{{$mortalidades('10')->sum->macho}}</td><td>{{$mortalidades('10')->sum->femea}}</td><td>{{$mortalidades('10')->sum->tot_ave}}</td>
                            </tr>
                            <tr>
                                <td>Papudas</td><td>{{$mortalidades('11')->sum->macho}}</td><td>{{$mortalidades('11')->sum->femea}}</td><td>{{$mortalidades('11')->sum->tot_ave}}</td>
                            </tr>
                            
                            <tr class="bg-gray">
                                <td>Total mortas</td><td>{{$totalmortas->sum->macho}}</td><td>{{$totalmortas->sum->femea}}</td><td>{{$totalmortas->sum->tot_ave}}</td>
                            </tr>
                            <tr class="bg-gray-light">
                                <td>Aves atuais</td><td>{{$avesemestoque->sum->macho}}</td><td>{{$avesemestoque->sum->femea}}</td><td>{{$avesemestoque->sum->tot_ave}}</td>
                            </tr>
                        </table>
                    </td>
                    <!--        
                    'Mortalidade galpão'
                                '1' => 'Arranhado',
                                '2' => 'Artrite',
                                '3' => 'Descarte eliminada',
                                '4' => 'Machucado',
                                '5' => 'Prolapso',
                                '6' => 'Refugo',
                                '7' => 'Outros'
                    'Descarte galpão' => [
                                '8' => 'Descarte abate',
                                '9' => 'Descarte laboratório',
                                '10' => 'Erros sexo',
                                '11' => 'Papudas'
                    -->
                    <td style="margin: 0 0 0 5px;vertical-align: top; border: 0;">
                        <table>
                            <tr class="bg-gray">
                                <th>Controle de estoque de ovos</th><th>Comerciais</th><th>Incubáveis</th>
                            </tr>
                            <tr>
                                <td>Saldo anterior <br> <small>Saldo atual em estoque</small></td><td>{{$ovosemestoque->sum->comerciais + $ovosenviados->sum->comerciais}}</td><td>{{$ovosemestoque->sum->incubaveis + $ovosenviados->sum->incubaveis}}</td>
                            </tr>
                            <tr>
                                <td>Produzidos <br> <small>Total do movimento diário</small></td><td>{{$ovosdiarios->sum->comerciais}}</td><td>{{$ovosdiarios->sum->incubaveis}}</td>
                            </tr>
                            <tr>
                                <td>Eniado para o incubatório</td><td>{{$ovosenviados->sum->comerciais}}</td><td>{{$ovosenviados->sum->incubaveis}}</td>
                            </tr>
                            <tr>
                                <td>Saldo atual</td><td>{{$ovosemestoque->sum->comerciais}}</td><td>{{$ovosemestoque->sum->incubaveis}}</td>
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
