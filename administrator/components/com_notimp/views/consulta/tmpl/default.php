<?php
/**
 * Notimpe HTML List Template
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
$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);

?>
<form action="<?php echo JRoute::_('index.php?option=com_notimp&view=consulta'); ?>" method="post" name="adminForm" id="adminForm">
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
        <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this,'options'=>array('filtersHidden' =>0)));
        ?>   
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>



            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo JHtml::_('grid.sort', 'ID Art.', 'id', $listDirn, $listOrder); ?></th>
                       
                        <th><?php echo JHtml::_('grid.sort', 'Titulo', 'title', $listDirn, $listOrder); ?></th>
                         <th><?php echo JHtml::_('grid.sort', 'Data', 'created', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('Status'); ?></th>
                        <th><?php echo JText::_('Nº Notimp'); ?></th>
                         <th><?php echo JHtml::_('grid.sort', 'Data Notimp', 'data_notimpe', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('Nome Veículo'); ?></th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->items as $i=>$row): ?>
                        <tr>
                            <td><?php echo $row->id_artigo ?></td>
                           
                            <td><?php echo $row->title ?></td>
                            <td><?php echo JHtml::_('date', $row->created, JText::_('DATE_FORMAT_LC4')); ?></td>
                            <td><?php echo $row->nome_status ?></td>
                            <td><?php echo $row->nr_notimpe ?></td>
                            <td><?php echo JHtml::_('date', $row->data_notimpe, JText::_('DATE_FORMAT_LC4')); ?></td>
                            <td><?php echo $row->nome_veiculo ?></td>

                        </tr>
                    <?php endforeach ?>

                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="9">
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
    </div>
</form>




