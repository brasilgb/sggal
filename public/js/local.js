var address = window.location.protocol + '//' + window.location.host + "/";
var pathname = window.location.pathname.split('/');
var base_url = address + pathname[1];

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
        $("#totave").val(total).addClass('bg-aqua-ativo');
    });
});
/*=========FIM Cálculos form aviarios==========*/
/*
 * 
 * dessabilita digitacao em campos do formulario
 */
$(function(){
    $('#nextaviario, #numcoleta').keypress(function (e) {
        e.preventDefault;
        return false;
    });
});

$(function(){
    $('#lote, .input-search').keyup(function(e){
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
                    $('#nextaviario').addClass('bg-info');
                }
            });
        } else {
            $('#nextaviario').removeClass('bg-info');
            $('#nextaviario').val('');
        }
    });
});

/*
 * Página create aviário, compara quantidade lote com soma de boxes do aviário com femeas
 */

$(function () {
    $('#femea').keyup(function () {
//        e.preventDefault;
        femeas = $('#femea').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotefemeas/' + idlote
        }).done(function (data) {
            if (femeas > data.totfemeas) {
                $('#macho, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal("show");
                $('.sexoaves').html('fêmea').show();
            } else {
                $('#macho, .salvar').prop('disabled', false);
            }
        });
    });
});

/*
 * Página create aviário, compara quantidade lote com soma de boxes do aviário com machos
 */

$(function () {
    $('#macho').keyup(function () {
//        e.preventDefault;
        machos = $('#macho').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotemachos/' + idlote
        }).done(function (data) {
            if (machos > data.totmachos) {
                $('#femea, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal("show");
                $('.sexoaves').html('macho').show();
            } else {
                $('#femea, .salvar').prop('disabled', false);
            }
        });
    });
});

$(document).ready(function () {
    $.ajax({
        url: 'periodos/periodoativo'
    }).done(function (data) {
//        alert(data);
        if (data > 0) {
            $('.nav-item').children("a").click(function () {
                return true;
            });
            $('.novoperiodo').prop("disabled", true);

        } else {
            $('.nav-item').children("a").click(function () {
                return false;
            });
            urlcompare = 'http://sggal/periodos';
            if (window.location != urlcompare)
                window.location.href = 'http://sggal/periodos';
        }
    });
});

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
                $("#baixaaves").modal("show");
                $('.sexoaves').html(sexo == 1 ? 'fêmea' : 'macho').show();
            }else{
                $('.salvar').prop('disabled', false);
            }
        });
    });
});
// Data portugues para ingles
function FormataStringData(data) {
  var dia  = data.split("/")[0];
  var mes  = data.split("/")[1];
  var ano  = data.split("/")[2];

  return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
  // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
};


// Preenche com o número da coleta
$(function () {
    $('#aviariosdolote').change(function () {
        lote = $('#loteid').val();
        aviario = $(this).val();
        datacoleta = FormataStringData($('#dataform').val());
        
        console.log(datacoleta);
            $.ajax({
                url: base_url + '/numcoleta/'+datacoleta+'/'+lote+'/'+aviario,
                type: 'GET'
            }).done(function (data) {
                $('#numcoleta').val(data.coleta).addClass('bg-info');
            });
    });
});