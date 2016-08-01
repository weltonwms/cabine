<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


$input  = JFactory::getApplication()->input;
$value_pasta_destino=$input->get('pasta_destino','images','path');
$url_arquivo=$input->get('url_arquivo','','path');
$fieldid=$input->get('fieldid');
?>


<h2>Upload de Arquivos</h2>
<div class="pull-right">
    <button class="btn btn-success button-save-selected" type="button" onclick="window.parent.jInsertFieldValue(document.getElementById('url_arquivo').value, '<?php echo $fieldid?>');window.parent.jModalClose();window.parent.jQuery('.modal.in').modal('hide');" data-dismiss="modal">Inserir Arquivo</button>
    <button class="btn button-cancel" type="button" onclick="window.parent.jModalClose();window.parent.jQuery('.modal.in').modal('hide');" data-dismiss="modal">Cancelar</button>
</div>
<form method="post" enctype="multipart/form-data" 
      action="index.php?option=com_concursos&view=upload">
    
   
    
    <label>Url Arquivo</label>
    <input type="text"  name="url_arquivo"
          value="<?php echo $url_arquivo?>"
           id="url_arquivo" readonly="readonly"/>
    <br>
    <br>
    <br>
    <br>
    <div class="well">
         <label>Pasta Destino</label>
        <input type="text" 
           value="<?php echo $value_pasta_destino?>"
           id="" name="pasta_destino"/>
    <br>
    <input type='file' name="Filedata[]" />
    <button class='btn btn-primary'>Iniciar Upload</button>
    </div>
   
    <input type="hidden" name="task" value="upload.upload" />
<?php echo JHtml::_('form.token'); ?>  
    <?php JFactory::getSession()->set("com_concursos.return_url", "index.php?option=com_concursos&view=upload&tmpl=component&fieldid=$fieldid"); ?>
</form>









