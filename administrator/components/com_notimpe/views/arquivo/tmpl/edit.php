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
	{       if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
		{
			
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div class="col100">
        <fieldset class="adminform"><legend><?php echo JText::_(''); ?></legend>
        <table class="admintable">
            <tr>
                <td width="100" align="right" class="key"><label for="nr_notimpe"> <?php echo JText::_('Nr Notimp'); ?>:</label></td>
                <td><input class="text_area required" type="text" name="nr_notimpe" id="nr_notimpe" size="32" maxlength="250" value="<?php echo $this->item->nr_notimpe!=0?$this->item->nr_notimpe:"";?>" /></td>
            </tr>
            
            <tr>
                <td width="100" align="right" class="key"><label for="data"> <?php echo JText::_('Data'); ?>:</label></td>
                <td><?php echo JHtml::calendar($this->item->data,'data', 'data', '%Y-%m-%d', "class='input-medium hasTooltip required' readonly='readonly'");?></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key"><label for="tipo"> <?php echo JText::_('Status'); ?>:</label></td>
                <td>
                    <select name="estado" id="estado">
                        <option value="0" <?php if($this->item->estado==0) echo "selected='selected'";?> >Em Edição</option>
                        <option value="1" <?php if($this->item->estado==1) echo "selected='selected'";?> >Publicado</option>
                        <option value="2" <?php if($this->item->estado==2) echo "selected='selected'";?> >Arquivado</option>
                    </select>   
                </td>
            </tr>

            <tr></tr>
        </table>
        </fieldset>
    </div>

    <div class="clr"></div>

    <input type="hidden" name="option" value="com_notimpe" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="view" value="arquivo" />
    <input type="hidden" name="controller" value="arquivo" />
    <input type="hidden" name="task" value="save" />
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
            <?php $estado=array('-2'=>'Deletado','-1'=>'Arquivado','0'=>'Despublicado','1'=>'Publicado','2'=>'Arquivado')?>
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

<?php //echo "<pre>"; print_r($this->artigos);


