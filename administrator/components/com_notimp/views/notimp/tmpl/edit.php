<?php
/**
 * Notimpe HTML Default Template
 *
 * PHP versions 5
 *
 * @category  Template
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.calendar');
JHtml::_('behavior.formvalidation');


?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{       if (task == 'notimp.cancel' || document.formvalidator.isValid(document.id('adminForm')))
		{
			
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_notimp&layout=edit'); ?>" 
      method="post" name="adminForm" id="adminForm">
   
       
     
    
    <div class="form-horizontal">
		<?php foreach ($this->form->getFieldsets() as $name => $fieldset): ?>
			<fieldset class="adminform">
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<div class="row-fluid">
					<div class="span6">
						<?php foreach ($this->form->getFieldset($name) as $field): ?>
							<div class="control-group">
								<div class="control-label"><?php echo $field->label; ?></div>
								<div class="controls"><?php echo $field->input; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</fieldset>
		<?php endforeach; ?>
	</div>

   


    <div class="clr"></div>

  
    <input type="hidden" name="boxchecked" value="1"/>
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
   <input type="hidden" name="task" value="notimp.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>

<table class="table table-bordered table-striped">
    <thead>
    <tr class="text-info">
        <th>id</th>
        <th>titulo</th>
        <th>autor</th>
        <th>Acesso</th>
        <th>Estado</th>
        <th>Editar <i class="icon-edit"></i></th>
    </tr>
    </thead>
    <tbody>
       
        <?php foreach ($this->artigos as $artigo):?>
         <tr>
            <td><?php echo $artigo->id?></td>
            <td><?php echo $artigo->title?></td>
             <td><?php echo $artigo->author_name?></td>
            <td><?php echo $artigo->access_level?></td>
            <?php $estado=array('-2'=>'Lixeira','-1'=>'Arquivado','0'=>'Despublicado','1'=>'Publicado','2'=>'Arquivado')?>
            <td><?php echo $estado[$artigo->state]?></td>
            <td>
                <?php $link= JRoute::_('index.php?option=com_content&task=article.edit&id='.(int) $artigo->id)?>
                <a href="#" onclick="window.open('<?php echo $link?>', '_blank', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">
                    <i class="icon-edit"></i>
                </a>
            </td>
         </tr>
        <?php endforeach;?>
        
    </tbody>
        
</table>

<?php //echo "<pre>"; print_r($this->form->getFieldsets());


