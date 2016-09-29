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
        if (task == 'aeronave.cancel' || document.formvalidator.isValid(document.id('adminForm')))
        {

            Joomla.submitform(task, document.getElementById('adminForm'));
        }

    }
</script>

<form action="index.php" method="post" name="adminForm form-validate" id="adminForm">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend>Detalhes</legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php foreach ($this->form->getFieldset('details1') as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <div class="control-label">
                            <label>Unidades da FAB</label>
                        </div>
                        <div class="controls">
                            <select name="jform[unidades][]" multiple="multiple">
                                <?php
                                foreach ($this->unidades as $unidade):
                                    $selected = in_array($unidade->id, $this->unidadesAtribuidas) ? " selected='selected' " : "";
                                    ?>
                                    <option value="<?php echo $unidade->id ?>"
                                    <?php echo $selected ?>
                                            > <?php echo $unidade->sigla ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="control-label">
                            <label>Tags</label>
                        </div>
                        <div class="controls">
                            <select name="jform[tags][]" multiple="multiple">
                                <?php
                                foreach ($this->tags as $tag):
                                    $selected = in_array($tag->id, $this->tagsAtribuidas) ? " selected='selected' " : "";
                                    ?>
                                    <option value="<?php echo $tag->id ?>"
                                    <?php echo $selected ?>
                                            > <?php echo $tag->tag ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    

                    <?php foreach ($this->form->getFieldset('details2') as $field): ?>
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

    <input type="hidden" name="option" value="com_aeronaves" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="view" value="aeronave" />
    <input type="hidden" name="task" value="save" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<?php
//echo "<pre>";print_r($this->tags);

