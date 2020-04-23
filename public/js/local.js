var address = window.location.protocol + '//' + window.location.host + "/";
var pathname = window.location.pathname.split('/');
var base_url = address + pathname[1];
// ===========================Cálculos coleta diária===========================
// Postura total de incubaveis bons
$(function () {
    $(".incubaveisbons").change(function () {
        var total = 0;
        $(".incubaveisbons").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#incubaveisbons").val(total).addClass('bg-gray-light');
    });
});

// Postura total de incubaveis
$(function () {
    $(".incubaveis").change(function () {
        var total = 0;
        $(".incubaveis").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#incubaveis").val(total).addClass('bg-gray-light');
    });
});
// Postura total de comerciais
$(function () {
    $(".comerciais").change(function () {
        var total = 0;
        $(".comerciais").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#comerciais").val(total).addClass('bg-gray-light');
    });
});
// Postura total do dia
$(function () {
    $(".posturadia").change(function () {
        var total = 0;
        $(".posturadia").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#posturadia").val(total).addClass('bg-gray-light');
    });
});
// ===============Fim cálculos coletas diárias================================
// Desabilita botões campos de busca
$(function () {
    $('.input-search').keyup(function (e) {
        e.preventDefault;
        if ($(this).val() === '') {
            $('#search-btn').prop('disabled', true);
        } else {
            $('#search-btn').prop('disabled', false);
        }
    });
//    $('.alert').not('.alert-important, .alert-info, .alert-danger').delay(3000).fadeOut(350);
});
/*================================Calculos form aviarios========================*/
// Total aves
$(function () {
    $(".input-total").keyup(function () {
        var total = 0;
        $(".input-total").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totave").val(total);
    });
});
/*=========FIM Cálculos form aviarios==========*/
/*
 * 
 * dessabilita digitacao em campos do formulario
 */
$(function () {
    $('#nextaviario, #numcoleta, #incubaveisbons, #incubaveis, #comerciais, #posturadia, #totalenvio').keypress(function (e) {
        e.preventDefault;
        return false;
    });
});

$(function () {
    $('#lote, .input-search').keyup(function (e) {
        e.preventDefault;
        $(this).val($(this).val().toUpperCase());
    });

});
/*
 * Página create aviário, mostra próximo aviário
 */

$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault;
        loteid = $(this).val();

        if (loteid !== '') {
            $.ajax({
                type: 'GET',
                url: base_url + '/returnaviario/' + loteid

            }).done(function (data) {
                if (data.success) {
                    $('#nextaviario').val(data.success);
                    $('#nextaviario').addClass('bg-gray-light');
                }
            });
        } else {
            $('#nextaviario').removeClass('bg-gray-light');
            $('#nextaviario').val('');
        }
    });
});

/*
 * Página create aviário, compara quantidade lote com soma dos aviários com femeas
 */

$(function () {
    $('#femea').keyup(function (e) {
        e.preventDefault;
        dbfemea = $('#db-femea').val();
        femeas = $('#femea').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotefemeas/' + idlote
        }).done(function (data) {
            sumfemea = parseInt(data.totfemeas) + parseInt(dbfemea);
            if (femeas > sumfemea) {
                $('#macho, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal('toggle', 'handleUpdate', {keyboard: true, focus: true});
                $('.sexoaves').html('fêmea').show();
            } else {
                $('#macho, .salvar').prop('disabled', false);
            }
        });
    });
});

/*
 * Página create aviário, compara quantidade lote com soma dos aviários com machos
 */

$(function () {
    $('#macho').keyup(function (e) {
        e.preventDefault;
        dbmacho = $('#db-macho').val();
        machos = $('#macho').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotemachos/' + idlote
        }).done(function (data) {
            summacho = parseInt(data.totmachos) + parseInt(dbmacho);
            if (machos > summacho) {
                $('#femea, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal('toggle', 'handleUpdate', {keyboard: true, focus: true});
                $('.sexoaves').html('macho').show();
            } else {
                $('#femea, .salvar').prop('disabled', false);
            }
        });
    });
});

/*
 * Número de aves fêmea permitidos em aviários
 */
$(document).ready(function () {
    idlote = $('#loteid').val();
    $.ajax({
        type: 'GET',
        url: base_url + '/totlotefemeas/' + idlote
    }).done(function (data) {
        $('.num-femeas').show('fade');
        $('.num-femeas > strong').html(data.totfemeas);
    });

});

$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault;
        idlote = $(this).val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotefemeas/' + idlote
        }).done(function (data) {
            $('.num-femeas').show('fade');
            $('.num-femeas > strong').html(data.totfemeas);
        });

    });
});

/*
 * Número de aves macho permitidos em aviários
 */
$(document).ready(function () {
    idlote = $('#loteid').val();
    $.ajax({
        type: 'GET',
        url: base_url + '/totlotemachos/' + idlote
    }).done(function (data) {
        $('.num-machos').show('fade');
        $('.num-machos > strong').html(data.totmachos);
    });

});
$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault;
        idlote = $(this).val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotemachos/' + idlote
        }).done(function (data) {
            $('.num-machos').show('fade');
            $('.num-machos > strong').html(data.totmachos);
        });

    });
});

/*
 * Libera sistema se periodo estiver ativo
 */
$(document).ready(function () {

    $.ajax({
        url: 'periodos/periodoativo/1'
    }).done(function (data) {
        if (data > 0) {
            $('.area-private').children("a").click(function () {
                return true;
            });
            $('.novoperiodo').prop("disabled", true);

        } else {
            $('.area-private').children("a").click(function () {
                return false;
            });
        }
    });
});

/*
 * Preenche dropdown com aviários do lote
 */
$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault;
        loteid = $(this).val();
        if (loteid == '') {
            $('#aviariosdolote').children().remove();
            $('#aviariosdolote').append("<option value='0'> Selecione o lote</option>");
        } else {

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/aves/aviariosdolote/' + loteid,
                success: function (response) {
                    $('#aviariosdolote').children().remove();
                    $('#aviariosdolote').append("<option value='0'> Selecione o aviário</option>");
                    len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }
                    if (len > 0) {
                        for (i = 0; i < len; i++) {
                            id = response['data'][i].id_aviario;
                            aviario = response['data'][i].aviario;
                            option = "<option value='" + id + "'>" + aviario + "</option>";
                            $('#aviariosdolote').append(option);
                        }
                    }
                }
            });
        }
    });
});


/*
 * Número de aves fêmea permitidos em aves
 */
$(document).ready(function () {
    idlote = $('#loteid').val();
    sexo = $('#sexo').val();
    idaviario = $('#aviariosdolote').val();
    quantidade = $('#quantidade').val();
    $.ajax({
        type: 'GET',
        url: base_url + '/avesestoque/' + idlote + '/' + idaviario + '/' + sexo
    }).done(function (data) {
        $('.est-aves').show('fade');
        $('.est-aves > strong').html(data.totaves);
    });
});
$(function () {
    $('#sexo').change(function (e) {
        e.preventDefault;
        idlote = $('#loteid').val();
        sexo = $('#sexo').val();
        idaviario = $('#aviariosdolote').val();
        switch (sexo) {
            case '1':
                descsexo = 'fêmea';
                break;
            case '2':
                descsexo = 'macho';
                break;
        }
        $.ajax({
            type: 'GET',
            url: base_url + '/avesestoque/' + idlote + '/' + idaviario + '/' + sexo
        }).done(function (data) {
            $('.est-aves').show('fade');
            $('.est-aves > strong').html(data.totaves);
            $('.est-aves > span').html(descsexo);
        });

    });
});

/*
 * Página aves, compara quantidade de aves com estoque
 */
$(function () {
    $('#quantidade').keyup(function (e) {
        e.preventDefault;
        quant = $(this).val();
        idlote = $('#loteid').val();
        sexo = $('#sexo').val();
        numave = $('#numave').val();
        idaviario = $('#aviariosdolote').val();
//        alert(idaviario);
        $.ajax({
            type: 'GET',
            url: base_url + '/avesestoque/' + idlote + '/' + idaviario + '/' + sexo
        }).done(function (data) {
            sumave = parseInt(data.totaves) + parseInt(numave);
            if (quant > sumave) {
                $('.salvar').prop('disabled', true);
                $("#baixaaves").modal('toggle', 'handleUpdate', {keyboard: true, focus: true});
                $('.sexoaves').html(sexo == 1 ? 'fêmea' : 'macho').show();
            } else {
                $('.salvar').prop('disabled', false);
            }
        });
    });
});

// Data portugues para ingles
function FormataStringData(data) {
    var dia = data.split("/")[0];
    var mes = data.split("/")[1];
    var ano = data.split("/")[2];

    return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
    // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
}
;

// Preenche com o número da coleta
$(function () {
    $('#aviariosdolote').change(function () {
        lote = $('#loteid').val();
        aviario = $(this).val();
        datacoleta = FormataStringData($('#dataform').val());
        $.ajax({
            url: base_url + '/numcoleta/' + datacoleta + '/' + lote + '/' + aviario,
            type: 'GET'
        }).done(function (data) {
            $('#numcoleta').val(data.coleta).addClass('bg-blue');
        });
    });
});

// Total envio de ovos
$(function () {
    $(".totalenvio").keyup(function () {
        var total = 0;
        $(".totalenvio").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totalenvio").val(total).addClass('bg-gray-light');
    });
});

// Quantidades de ovos incubaveis e comerciais campos de envios
$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault();
        idlote = $(this).val();
        $.ajax({
            url: base_url + '/estoqueovos/' + idlote,
            type: 'GET'
        }).done(function (data) {
            $('.info-incubaveis').show('fade');
            $('.info-incubaveis > strong').html(data.incubaveis);
            $('.info-comerciais').show('fade');
            $('.info-comerciais > strong').html(data.comerciais);
        });
    });
});
$(document).ready(function () {
    idlote = $('#loteid').val();
    $.ajax({
        url: base_url + '/estoqueovos/' + idlote,
        type: 'GET'
    }).done(function (data) {
        $('.info-incubaveis').show('fade');
        $('.info-incubaveis > strong').html(data.incubaveis);
        $('.info-comerciais').show('fade');
        $('.info-comerciais > strong').html(data.comerciais);
    });
});


/*
 * Página envios, compara quantidade de ovos com estoque
 */
$(function () {
    $('#envioincubaveis').keyup(function (e) {
        e.preventDefault;
        incubaveis = $(this).val();
        idlote = $('#loteid').val();
        numincubaveis = $('#numincubaveis').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/estoqueovos/' + idlote
        }).done(function (data) {
            sumincubaveis = parseInt(data.incubaveis) + parseInt(numincubaveis);
            if (incubaveis > sumincubaveis) {
                $('.salvar').prop('disabled', true);
                $("#ovosenvios").modal('toggle', 'handleUpdate', {keyboard: true, focus: true});
                $('.tipoovos').html('incubáveis').show();
            } else {
                $('.salvar').prop('disabled', false);
            }
        });
    });
});
$(function () {
    $('#enviocomerciais').keyup(function (e) {
        e.preventDefault;
        comerciais = $(this).val();
        idlote = $('#loteid').val();
        numcomerciais = $('#numcomerciais').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/estoqueovos/' + idlote
        }).done(function (data) {
            sumcomerciais = parseInt(data.comerciais) + parseInt(numcomerciais);
            if (comerciais > sumcomerciais) {
                $('.salvar').prop('disabled', true);
                $("#ovosenvios").modal('toggle', 'handleUpdate', {keyboard: true, focus: true});
                $('.tipoovos').html('comerciais').show();
            } else {
                $('.salvar').prop('disabled', false);
            }
        });
    });
});
