<?php

defined('_JEXEC') or die;
$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="<?php echo JRoute::_('index.php?option=com_unidades&view=unidades'); ?>" method="post" name="adminForm" id="adminForm">
    
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
                        <th width="2%"><?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?></th>
                       
                        <th><?php echo JHtml::_('grid.sort', 'Nome OM', 'nome_om', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('Sigla'); ?></th>
                        <th width="15%"><?php echo JText::_('Logo OM'); ?></th>
                        
                       
                        <th><?php echo JText::_('Estado'); ?></th>
                       

                    </tr>
                </thead>
                <tbody>
                <?php
               
                foreach ($this->items as $row):
                    JFilterOutput::objectHTMLSafe($row);
                   
                    $link = JRoute::_('index.php?option=com_unidades&view=unidade&id=' . $row->id);
                    ?>
                    <tr class="">
                        <td><?php echo $row->id; ?></td>
                      
                        <td><?php echo "<a href='$link'>" . $row->nome_om . "</a>"; ?></td>
                        <td><?php echo $row->sigla; ?></td>
                        <td><img src="<?php echo JUri::base(). $row->logo_om; ?>" alt="<?php echo $row->logo_om; ?>" style="height: 50px;" > </td>
                      
                        <td><?php echo $row->cidade." - ".$row->uf; ?></td>
                          


                    </tr>
                    <?php  endforeach; ?>
                    </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
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
    
</form>



