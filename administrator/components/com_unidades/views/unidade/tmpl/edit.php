<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
    Joomla.submitbutton = function (task)
    {

        if (task == 'unidade.cancel' || document.formvalidator.isValid(document.id('adminForm')))
        {

            Joomla.submitform(task, document.getElementById('adminForm'));
        }

    }
</script>




<form action="index.php" method="post" name="adminForm form-validate" id="adminForm">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('Detalhes', true)); ?>

        <div class="" style="color:red">
            No Upload da logo da unidade o Arquivo com deve ter a extensão .jpg ou .png <br>e a imagem deve ser redimensionada para o tamanho 170 x 200.
        </div>
        <?php foreach ($this->form->getFieldset('details') as $field): ?>
            <div class="control-group">
                <div class="control-label"><?php echo $field->label; ?></div>
                <div class="controls"><?php echo $field->input; ?></div>
            </div>
        <?php endforeach; ?>


        <?php echo JHtml::_('bootstrap.endTab'); ?>



        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'endereco', JText::_('Endereço', true)); ?>
        <?php foreach ($this->form->getFieldset('endereco') as $field): ?>
            <div class="control-group">
                <div class="control-label"><?php echo $field->label; ?></div>
                <div class="controls"><?php echo $field->input; ?></div>
            </div>
        <?php endforeach; ?>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'ramais', JText::_('Ramais', true)); ?>
        <?php foreach ($this->form->getFieldset('ramais') as $field): ?>
            <div class="control-group">
                <div class="control-label"><?php echo $field->label; ?></div>
                <div class="controls"><?php echo $field->input; ?></div>
            </div>
        <?php endforeach; ?>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php if (JFactory::getUser()->authorise('core.admin', 'com_unidades')) : ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('Permissões', true)); ?>
            <?php echo $this->form->getInput('asset_id'); ?>
            <?php echo $this->form->getInput('rules'); ?>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>


    </div>



    <input name="jform[title]" type="hidden" id="jform_title"> <!--usado para ajax permissions-->
    <input type="hidden" name="option" value="com_unidades" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="view" value="unidade" />
    <input type="hidden" name="controller" value="unidade" />
    <input type="hidden" name="task" value="save" />
    <?php echo JHtml::_('form.token'); ?>
</form>

