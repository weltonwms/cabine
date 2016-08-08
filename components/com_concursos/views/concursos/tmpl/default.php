<?php
/**
 * HTML Default Template
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
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

//JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="<?php echo JRoute::_('index.php?option=com_concursos' ) ?>" method="post" id="adminForm" name="adminForm">
   
        <?php
        // Search tools bar
        echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this,'options'=>array('filtersHidden' =>0)));
        ?>
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                       <th width="10%">
                            <?php echo JHtml::_('grid.sort', 'Nome', 'nome', $listDirn, $listOrder); ?>
                        </th>
                         <th width="5%">
                            <?php echo JHtml::_('grid.sort', 'Sigla', 'sigla', $listDirn, $listOrder); ?>
                        </th>
                        <th width="20%">
                            <?php echo JHtml::_('grid.sort', 'Escola', 'escola', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Turma', 'turma', $listDirn, $listOrder); ?>
                        </th>
                       

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="12">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $veiculo = array('', 'intraer', 'internet/intraer');
                    $status = array('', 'Inscrições Abertas', 'Encerradas', "Concursos Anteriores");
                    ?>

                    <?php if (!empty($this->items)) : ?>
                        <?php
                        foreach ($this->items as $i => $row) :
                            $link = JRoute::_('index.php?option=com_concursos&view=concurso&id=' . $row->id);
                            ?>
                            <tr>
                                
                                <td>
                                    <a href="<?php echo $link; ?>" title="<?php echo JText::_('EDIT CONCURSOS'); ?>">
                                        <?php echo $row->nome; ?>
                                    </a>
                                </td>
                                <td><?php echo $row->sigla; ?></td>
                                <td><?php echo $row->escola; ?></td>
                                <td><?php echo $row->turma; ?></td>
                               
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0"/>
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
        <?php echo JHtml::_('form.token'); ?>
   
</form>

