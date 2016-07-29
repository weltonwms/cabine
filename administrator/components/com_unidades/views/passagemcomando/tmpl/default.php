<?php
/**
 * Passagemcomando HTML Default Template
 *
 * PHP versions 5
 *
 * @category  Template
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.calendar');


?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div class="col100">
        <fieldset class="adminform"><legend><?php echo JText::_(''); ?></legend>
        <table class="admintable">
            <tr>
                <td width="100" align="right" class="key">
                    <label for="id_unidade"> <?php echo JText::_('Id Unidade'); ?>:</label>
                </td>
                <td>
                    <select name='id_unidade'>
                         <option value="">--Selecione--</option>
                        <?php foreach ($this->unidades as $unidade) : ?>
                       
                        <option value="<?php echo $unidade->id?>"
                               <?php if($this->item->id_unidade ==$unidade->id) echo "selected='selected'"?> >
                            
                        
                        <?php echo $unidade->nome_om ?>
                                             
                        </option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key"><label for="titular"> <?php echo JText::_('Titular'); ?>:</label></td>
                <td><input class="text_area" type="text" name="titular" id="titular" size="32" maxlength="250" value="<?php echo $this->item->titular;?>" /></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key"><label for="substituto"> <?php echo JText::_('Substituto'); ?>:</label></td>
                <td><input class="text_area" type="text" name="substituto" id="substituto" size="32" maxlength="250" value="<?php echo $this->item->substituto;?>" /></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key"><label for="data"> <?php echo JText::_('Data'); ?>:</label></td>
                <td><?php echo JHtml::calendar($this->item->data,'data', 'data', '%Y-%m-%d', "readonly='readonly'");?></td>
            </tr>
             <tr>
                <td width="100" align="right" class="key"><label for="status"> <?php echo JText::_('Status'); ?>:</label></td>
                <td>
                   <select name='status'>
                         <option value="">--Selecione--</option>
                         <option <?php if ($this->item->status ==1) echo "selected='selected' "; ?>value="1"> Publicado</option>
                         <option <?php if ($this->item->status ==0) echo "selected='selected' "; ?>value="0"> Despublicado</option>
                       
                      
                                             
                       
                       
                    </select>
                </td>
            </tr>

            <tr></tr>
            
        </table>
        </fieldset>
    </div>

    <div class="clr"></div>

    <input type="hidden" name="option" value="com_unidades" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="view" value="passagemcomando" />
    <input type="hidden" name="controller" value="passagemcomando" />
    <input type="hidden" name="task" value="save" />
    <?php echo JHtml::_('form.token'); ?>
</form>

