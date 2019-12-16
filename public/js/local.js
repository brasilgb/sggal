var address = window.location.protocol + '//' + window.location.host + "/";
var pathname = window.location.pathname.split('/');
var base_url = address + pathname[1];
//alert(base_url);
$(function () {
    $('.alert').not('.alert-important, .alert-info').delay(3000).fadeOut(350);
});

/*================================Calculos form aviarios========================*/
// Total aves femeas
$(function () {
    $(".input-femea").change(function () {
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
    $(".input-macho").change(function () {
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
    $(".input-total").change(function () {
        var total = 0;
        $(".input-total").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totave").val(total).addClass('bg-aqua-ativo');
    });
});

/*
 * 
 * dessabilita digitacao em campos do formulario
 */
$('#nextaviario, #totave, #totmacho, #totfemea').keypress(function (e) {
    e.preventDefault;
    return false;
});

/*
 * Página create aviário mostra próximo aviário
 */

$(function () {
    $('#loteid').change(function (e) {
        e.preventDefault;
        loteid = $(this).val();
//        alert(base_url + '/returnaviario');
        $.ajax({
            type: 'GET',
//            data: {loteid: },
            url: base_url + '/returnaviario/' + loteid

        }).done(function (data) {
//            alert(data.success);
            $('#nextaviario').val(data.success);
            $('#nextaviario').addClass('bg-info disabled');
        });
    });
});