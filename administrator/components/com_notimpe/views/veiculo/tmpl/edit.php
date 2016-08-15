<?php
/**
 * Veiculo HTML Default Template
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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{   
            if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
		{
			
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		
	}
</script>

<form action="index.php" method="post" name="adminForm form-validate" id="adminForm">
    <input type="hidden" value="<?php echo $this->item->ordem?>" name="jform[ordem_original]">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend>Detalhes</legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php foreach ($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="clr"></div>

    <input type="hidden" name="option" value="com_notimpe" />
    <input type="hidden" name="view" value="veiculo" />
    <input type="hidden" name="controller" value="veiculo" />
    <input type="hidden" name="task" value="save" />
    <?php echo JHtml::_('form.token'); ?>
</form>
<?php //echo "<pre>"; print_r($this->form->getFieldset()); ?>



    




