<?php
/**
 * Veiculo HTML List Template
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

//JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<div id="j-sidebar-container" class="span2">
    <?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">


    <form action="<?php echo JRoute::_('index.php?option=com_notimp&view=veiculos') ?>" method="post" name="adminForm" id="adminForm">
        <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
        ?>
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="adminlist table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="4%"><?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?></th>
                        <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                        <th width="20%"><?php echo JHtml::_('grid.sort', 'Nome', 'nome', $listDirn, $listOrder); ?></th>
                        <th width="20%"><?php echo JText::_('Logo'); ?></th>
                        <th width="10%"><?php echo JText::_('Cidade'); ?></th>
                        <th width="10%"><?php echo JText::_('Estado'); ?></th>
                        <th width="10%"><?php echo JHtml::_('grid.sort', 'Ordem', 'ordem', $listDirn, $listOrder); ?></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->items as $i => $row):

                        
                        $link = JRoute::_('index.php?option=com_notimp&task=veiculo.edit&id=' . $row->id);
                        ?>
                        <tr >
                            <td><?php echo $row->id; ?></td>
                            <td> <?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                            <td><?php echo "<a href='$link'>" . $row->nome . "</a>"; ?></td>
                            <td>
                                <img src="<?php echo "../" . $row->imagem; ?>" alt="<?php echo $row->imagem; ?>" style="height: 20px" />

                            </td>
                            <td><?php echo $row->cidade; ?></td>
                            <td><?php echo $row->estado; ?></td>
                            <td><?php echo $row->ordem; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
                <tfoot>
			<tr>
				<td colspan="7">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>


            </table>
        <?php endif; ?>

        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0"/>
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
        <?php echo JHtml::_('form.token'); ?>


    </form>
</div>
