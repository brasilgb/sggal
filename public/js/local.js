var address = window.location.protocol + '//' + window.location.host + "/";
var pathname = window.location.pathname.split('/');
var base_url = address + pathname[1];
//alert(base_url);
//$(function () {
//    $('.alert').not('.alert-important, .alert-info, .alert-danger').delay(3000).fadeOut(350);
//});

/*================================Calculos form aviarios========================*/
// Total aves femeas
$(function () {
    $(".input-femea").keyup(function () {
        var total = 0;
        $(".input-femea").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totfemea").val(total).addClass('bg-aqua-ativo');
    });
});

// Total aves machos
$(function () {
    $(".input-macho").keyup(function () {
        var total = 0;
        $(".input-macho").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totmacho").val(total).addClass('bg-aqua-ativo');
    });
});

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
$('#nextaviario, #totave, #totmacho, #totfemea').keypress(function (e) {
    e.preventDefault;
    return false;
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
//            data: {loteid: },
                url: base_url + '/returnaviario/' + loteid

            }).done(function (data) {
                if (data.success) {
                    $('#nextaviario').val(data.success);
                    $('#nextaviario').addClass('bg-info disabled');
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
    $('#box1_femea, #box2_femea, #box3_femea, #box4_femea').keyup(function () {
//        e.preventDefault;
        femeas = $('#totfemea').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotefemeas/' + idlote
        }).done(function (data) {
            if (femeas > data.totfemeas) {
                $('#box1_macho, #box2_macho, #box3_macho, #box4_macho, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal("show");
                $('.sexoaves').html('fêmea').show();
            }else{
                $('#box1_macho, #box2_macho, #box3_macho, #box4_macho, .salvar').prop('disabled', false);
            }
        });
    });
});

/*
 * Página create aviário, compara quantidade lote com soma de boxes do aviário com machos
 */

$(function () {
    $('#box1_macho, #box2_macho, #box3_macho, #box4_macho').keyup(function () {
//        e.preventDefault;
        machos = $('#totmacho').val();
        idlote = $('#loteid').val();
        $.ajax({
            type: 'GET',
            url: base_url + '/totlotemachos/' + idlote
        }).done(function (data) {
            if (machos > data.totmachos) {
                $('#box1_femea, #box2_femea, #box3_femea, #box4_femea, .salvar').prop('disabled', true);
                $("#addAvesAviario").modal("show");
                $('.sexoaves').html('macho').show();
            }else{
                $('#box1_femea, #box2_femea, #box3_femea, #box4_femea, .salvar').prop('disabled', false);
            }
        });
    });
});
