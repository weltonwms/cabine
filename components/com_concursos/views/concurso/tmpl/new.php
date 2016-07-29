<?php
/**
 * Concurso HTML Default Template
 *
 * PHP versions 5
 *
 * @category  Template
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.keepalive');


?>

<h1><?php echo JText::_('Add Concurso'); ?></h1>
<form id="new_concurso" name="new_concurso" method="post" onsubmit="return document.formvalidator.isValid(this)">
<table border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td width="100" align="right" class="key"><label for="sigla"> <?php echo JText::_('Sigla'); ?>:</label></td>
                <td><input class="text_area" type="text" name="sigla" id="sigla" size="32" maxlength="250" value="<?php echo $this->item->sigla;?>" /></td>
            </tr>
            <tr>
                <td width="100" align="right" class="key"><label for="nome"> <?php echo JText::_('Nome'); ?>:</label></td>
                <td><input class="text_area" type="text" name="nome" id="nome" size="32" maxlength="250" value="<?php echo $this->item->nome;?>" /></td>
            </tr>

</table>
    <?php echo JHTML::_('form.token'); ?>
    <input type="submit" value="<?php echo JText::_('Submit'); ?>" />
    <input type="hidden" name="option" value="com_concursos" />
    <input type="hidden" name="task" value="save" />
    <input type="hidden" name="view" value="concurso" />
    <input type="hidden" name="controller" value="concurso" />
</form>