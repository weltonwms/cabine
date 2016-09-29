<?php
/**
 * Aeronave HTML List Template
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
<form action="<?php echo JRoute::_('index.php?option=com_aeronaves&view=aeronaves'); ?>" 
      method="post" name="adminForm" id="adminForm">
    
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
                        <th><?php echo JHtml::_('grid.sort', 'Aeronave', 'aeronave', $listDirn, $listOrder); ?></th>
                       <th><?php echo JHtml::_('grid.sort', 'Tipo Aviação', 'tipo_aviacao', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('imagem'); ?></th>
                        <th><?php echo JHtml::_('grid.sort', 'País de Origem', 'pais_origem', $listDirn, $listOrder); ?></th>
                        <th><?php echo JText::_('Países de Operação'); ?></th>


                    </tr>
                </thead>
                <?php
                foreach ($this->items as $row) :
                    JFilterOutput::objectHTMLSafe($row);
                    $checked = JHTML::_('grid.id', $row->id, $row->id);
                    $link = JRoute::_('index.php?option=com_aeronaves&view=aeronave&layout=edit&id=' . $row->id);
                    ?>
                    <tr class="">
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $checked; ?></td>
                        <td><?php echo "<a href='$link'>" . $row->aeronave . "</a>"; ?></td>
                        <td><?php echo $row->tipo_aviacao; ?></td>
                        <td><img src="<?php echo "../" . $row->imagem; ?>" alt="<?php echo $row->imagem; ?>" style="height: 50px" > </td>
                        <td><?php echo $row->pais_origem; ?></td>
                        <td><?php echo $row->paises_operacao; ?></td>

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
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
        <?php echo JHtml::_('form.token'); ?>
   
</form>
