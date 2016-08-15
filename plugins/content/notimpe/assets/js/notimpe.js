var $j = jQuery.noConflict();
$j(document).ready(function () {

    $j('#jform_catid').change(function () {

        if ($j(this).val() != notimp_category) {

            //foi selecionada uma categoria que não contem a palavra notimpe
            $j('#jform_notimpe_veiculo').removeAttr('required');
            $j('#jform_notimpe_nr_notimpe').removeAttr('required');

        } else {
            //foi selecionada uma categoria que contem a palavra notimpe
            $j('#jform_notimpe_veiculo').attr('required', 'true');
            $j('#jform_notimpe_nr_notimpe').attr('required', 'true');

        }
    }); // fechamento do change
    $j("#jform_catid").trigger("change");

    /*
     $j('#jform_catid').change(function() {
     
     var option = $j(this).find('option:selected').text();
     if (option.indexOf("notimp") == -1) {
     //foi selecionada uma categoria que não contem a palavra notimpe
     $j('#jform_notimpe_veiculo').removeAttr('required');
     $j('#jform_notimpe_nr_notimpe').removeAttr('required');
     
     } else {
     //foi selecionada uma categoria que contem a palavra notimpe
     $j('#jform_notimpe_veiculo').attr('required', 'true');
     $j('#jform_notimpe_nr_notimpe').attr('required', 'true');
     
     }
     }); // fechamento do change
     */


    $j(window).load(function () {
        if (notimp_id != 0) {
            setAtributosNotimp();

        }
    }); //fechamento do load. O window comporta todas as imagens e scripts




});// fechamento do ready


function setAtributosNotimp() {
    //alert(notimp_category);
    $j("a[href='#publishing']").hide();
    $j("a[href='#images']").hide();
    $j("a[href='#attrib-basic']").hide();
    $j("a[href='#editor']").hide();
    $j("a[href='#permissions']").hide();
    $j('#jform_notimpe_nr_notimpe').val(notimp_id).trigger("liszt:updated");
    $j('#jform_catid').val(notimp_category).trigger("liszt:updated");
    $j("a[href='#attrib-notimpe']").trigger("click");
    $j("#jform_catid").trigger("change").trigger("liszt:updated");
   

}


