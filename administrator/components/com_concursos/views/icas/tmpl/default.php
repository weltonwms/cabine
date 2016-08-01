<?php
/**
 * Icas HTML List Template
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
JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_concursos&view=icas" method="post" id="adminForm" name="adminForm">
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="1%">
                            <?php echo JHtml::_('grid.sort', 'Id', 'id', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%"><?php echo JHtml::_('grid.checkall'); ?></th>
                        <th><?php echo JText::_('Sigla'); ?></th>
                        <th><?php echo JText::_('Descricao'); ?></th>
                        <th><?php echo JText::_('Referencia'); ?></th>
                        <th><?php echo JText::_('Ano'); ?></th>
                        <th><?php echo JText::_('Arquivo'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $referencia = array('', 'Inspeção de Saúde', 'Exames Psicológicos', 'TACF');
                    foreach ($this->items as $row) :
                        $checked = JHTML::_('grid.id', $row->id, $row->id);
                        $link = JRoute::_('index.php?option=com_concursos&view=ica&task=ica.edit&id=' . $row->id);
                        $link_arquivo = JUri::root() . "$row->arquivo";
                        ?>
                        <tr class="">
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $checked; ?></td>
                            <td><?php echo "<a href='$link'>" . $row->sigla . "</a>"; ?></td>
                            <td><?php echo $row->descricao; ?></td>
                            <td><?php echo $referencia[$row->referencia]; ?></td>
                            <td><?php echo $row->ano; ?></td>
                            <td><?php echo "<a target='__blank'  href='$link_arquivo'>" . $row->arquivo . "</a>"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
                        
    </div>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
</div>

