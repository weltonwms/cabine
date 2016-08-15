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
jimport('joomla.filter.filteroutput');
//JHtml::_('formbehavior.chosen', 'select');
?>
 <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">


<form action="index.php" method="post" name="adminForm" id="adminForm">
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
                    <th width="2%"><?php echo JText::_('ID'); ?></th>
                    <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                    <th width="20%"><?php echo JText::_('Nome'); ?></th>
                    <th width="20%"><?php echo JText::_('Logo'); ?></th>
                     <th width="10%"><?php echo JText::_('Cidade'); ?></th>
                      <th width="10%"><?php echo JText::_('Estado'); ?></th>
                    <th width="10%"><?php echo JText::_('Ordem'); ?></th>

                </tr>
            </thead>
            <?php
            $k = 0;
            $i = 0;
            foreach ($this->items as $row) {
                JFilterOutput::objectHTMLSafe($row);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_notimpe&view=veiculo&layout=edit&task=edit&cid[]=' . $row->id);
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                    <td><?php echo "<a href='$link'>" . $row->nome . "</a>"; ?></td>
                    <td>
                        <img src="<?php echo "../".$row->imagem; ?>" alt="<?php echo $row->imagem; ?>" style="height: 20px" />
                    
                    </td>
                      <td><?php echo $row->cidade; ?></td>
                      <td><?php echo $row->estado; ?></td>
                       <td><?php echo $row->ordem; ?></td>
                </tr>
    <?php
    $k = 1 - $k;
    $i = $i + 1;
}
?>
        </table>
    <?php endif; ?>
        <input type="hidden" name="option" value="com_notimpe" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="view" value="veiculo" />
        <input type="hidden" name="controller" value="veiculo" />
  
</form>
  </div>
