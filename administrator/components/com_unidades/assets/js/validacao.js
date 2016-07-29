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
    
    jQuery(".uf").change(function(){
        uf_id = jQuery(this).val();
            //alert('uf_id')  ;
           
        jQuery.ajax({
            url:'index.php?option=com_unidades&task=unidades.getListaCidades',
            type: "POST",
            data: {
                'uf_id': uf_id
            }
        }).done(function(msg) {
            valor_cidade_atual = jQuery("select.cidades").val();
            //console.log(valor_cidade_atual);
            jQuery(".cidades").html(msg).trigger( "liszt:updated" );;
            jQuery("select.cidades").val(valor_cidade_atual).trigger( "liszt:updated" );;

        }); //fechamento ajasx
        
    });
    
     setTimeout(function(){
           jQuery("select.uf").trigger("change");
     },1000); 

});// fechamento do ready
 
var masks = ['(00) 00000-0000', '(00) 0000-00009'],
        maskBehavior = function (val, e, field, options) {
            return val.length > 14 ? masks[0] : masks[1];
        };


