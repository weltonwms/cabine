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
jimport('joomla.filter.filteroutput');
JHtml::_('formbehavior.chosen', 'select');
$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<div id="j-sidebar-container" class="span2">
    <?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">


    <form action="index.php?option=com_notimp&view=notimps" method="post" name="adminForm" id="adminForm">

        <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
        ?>
        <?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th width="4%"><?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?></th>
                    <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                    <th width="2%"><?php echo JText::_('Matéria'); ?></th>
                    <th width="8%"><?php echo JHtml::_('grid.sort', 'Nr Notimp', 'nr_notimpe', $listDirn, $listOrder); ?></th>
                    <th width="8%"><?php echo JHtml::_('grid.sort', 'Ano', 'ano', $listDirn, $listOrder); ?></th>
                    <th width="10%"><?php echo JHtml::_('grid.sort', 'Data', 'data', $listDirn, $listOrder); ?></th>
                    <th width="8"><?php echo JText::_('Status'); ?></th>
                    <th width="8"><?php echo JText::_('Oficial de Serviço'); ?></th>
                    <th width="8"><?php echo JText::_('Graduado de Serviço'); ?></th>

                </tr>
            </thead>
            <tbody>
            <?php
            
            foreach ($this->items as $i=>$row) :
                JFilterOutput::objectHTMLSafe($row);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_notimp&task=notimp.edit&id=' . $row->id);
                $link_addArt = JRoute::_('index.php?option=com_content&view=article&layout=edit&notimpeId='.$row->id);
                $validacao1=$row->estado==0;
                ?>
                <tr >
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                    <td>
                        <?php if($validacao1):?>
                        <a href="#" onclick="window.open('<?php echo $link_addArt?>', '_blank', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">
                            <i class="icon-new"></i></a>
                        <?php endif;?>
                    </td>
                    <td><?php echo "<a href='$link'>" . $row->nr_notimpe . "</a>"; ?></td>
                    <td><?php echo $row->ano; ?></td>
                    <td><?php echo JHtml::_('date', $row->data, JText::_('DATE_FORMAT_LC4')); ?></td>
    <?php $estado = array('Em Edição', 'Publicado', 'Arquivado') ?>
                    <td><?php if ($row->estado != NULL) echo $estado[$row->estado]; ?></td>
                    <td><?php echo $row->oficial_name; ?></td>
                    <td><?php echo $row->graduado_name; ?></td>

                </tr>
                <?php endforeach; ?>
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
        

    </form>
</div>



