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
?>


<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
        <table class="adminlist table table-striped table-hover">
            <thead>
                <tr>
                    <th width="2%"><?php echo JText::_('ID'); ?></th>
                    <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                    <th width="8%"><?php echo JText::_('Nr Notimp'); ?></th>
                    <th width="8%"><?php echo JText::_('Ano'); ?></th>
                    <th width="10%"><?php echo JText::_('Data'); ?></th>
                    <th width="8"><?php echo JText::_('Status'); ?></th>

                </tr>
            </thead>
            <?php
            $k = 0;
            $i = 0;
            foreach ($this->items as $row) {
                JFilterOutput::objectHTMLSafe($row);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_notimpe&view=arquivo&layout=edit&task=edit&cid[]=' . $row->id);
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                    <td><?php echo "<a href='$link'>" . $row->nr_notimpe . "</a>"; ?></td>
                    <td><?php echo $row->ano; ?></td>
                    <td>
                        <?php 
                        $date = date_create($row->data);
                        echo date_format($date, 'd/m/Y');; 
                        ?>
                    </td>
                    <?php $estado=array('Em Edição', 'Publicado','Arquivado')?>
                    <td><?php if($row->estado!=NULL) echo $estado[$row->estado]; ?></td>

                </tr>
    <?php
    $k = 1 - $k;
    $i = $i + 1;
}
?>
        </table>

        <input type="hidden" name="option" value="com_notimpe" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="view" value="arquivo" />
        <input type="hidden" name="controller" value="arquivo" />
    </div>
</form>


