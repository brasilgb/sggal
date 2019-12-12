$(function(){
    $('.alert').not('.alert-important, .alert-info').delay(3000).fadeOut(350);
});

/*================================Calculos form aviarios========================*/
// Total aves femeas
$(function () {
    $(".input-femeas").change(function () {
        var total = 0;
        $(".input-femeas").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totfemeas").val(total).addClass('bg-aqua-ativo');
    });
});

// Total aves machos
$(function () {
    $(".input-machos").change(function () {
        var total = 0;
        $(".input-machos").each(function (index, element) {
            if ($(element).val()) {
                total += parseInt($(element).val());
            }
        });
        $("#totmachos").val(total).addClass('bg-aqua-ativo');
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
        $("#totaves").val(total).addClass('bg-aqua-ativo');
    });
});

