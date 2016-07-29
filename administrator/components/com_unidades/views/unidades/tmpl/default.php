<?php
/**
 * Unidade HTML List Template
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
$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="<?php echo JRoute::_('index.php?option=com_unidades&view=unidades'); ?>" method="post" name="adminForm" id="adminForm">
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
        <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
        ?>   
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?></th>
                        <th width="20"><?php echo JHtml::_('grid.checkall') ?></th>
                        <th><?php echo JHtml::_('grid.sort', 'Nome OM', 'nome_om', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('Sigla'); ?></th>
                        <th><?php echo JText::_('Logo OM'); ?></th>
                        <th><?php echo JText::_('Data Aniversário'); ?></th>
                        <th><?php echo JText::_('Categoria'); ?></th>
                        <th><?php echo JText::_('Cidade'); ?></th>
                        <th><?php echo JText::_('UF'); ?></th>

                    </tr>
                </thead>
                <tbody>
                <?php
               
                foreach ($this->items as $row):
                    JFilterOutput::objectHTMLSafe($row);
                    $checked = JHTML::_('grid.id', $row->id, $row->id);
                    $link = JRoute::_('index.php?option=com_unidades&task=unidade.edit&id=' . $row->id);
                    ?>
                    <tr class="">
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $checked; ?></td>
                        <td><?php echo "<a href='$link'>" . $row->nome_om . "</a>"; ?></td>
                        <td><?php echo $row->sigla; ?></td>
                        <td><img src="<?php echo "../" . $row->logo_om; ?>" alt="<?php echo $row->logo_om; ?>" style="height: 50px" > </td>
                            <?php $data_aniversario = new DateTime($row->data_aniversario); ?>
                        <td><?php echo $data_aniversario->format("d/m/Y"); ?></td>
                        <td><?php echo $row->categoria; ?></td>
                        <td><?php echo $row->cidade; ?></td>
                        <td><?php echo $row->uf; ?></td>   


                    </tr>
                    <?php  endforeach; ?>
                    </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>



