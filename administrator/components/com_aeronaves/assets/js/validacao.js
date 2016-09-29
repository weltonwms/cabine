jQuery(document).ready(function () {

    $(".cep").mask('99.999-999');
    $('.telefone').mask(maskBehavior, {onKeyPress:
                function (val, e, field, options) {
                    field.mask(maskBehavior(val, e, field, options), options);
                }
    });

    jQuery("#adminForm").submit(function (e) {
        var task = jQuery("input[name='task']").val();
        if (task == 'remove') {
            if (confirm("Deseja realmente apagar este registro?") != true) {
                e.preventDefault();
            }
        }
    });

});// fechamento do ready

var masks = ['(00) 00000-0000', '(00) 0000-00009'],
        maskBehavior = function (val, e, field, options) {
            return val.length > 14 ? masks[0] : masks[1];
        };


