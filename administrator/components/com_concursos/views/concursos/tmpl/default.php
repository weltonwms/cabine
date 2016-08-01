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

JHtml::_('formbehavior.chosen', 'select');

$listOrder = $this->escape($this->filter_order);
$listDirn = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_concursos&view=concursos" method="post" id="adminForm" name="adminForm">
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
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Id', 'id', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="5%">
                            <?php echo JHtml::_('grid.sort', 'Sigla', 'sigla', $listDirn, $listOrder); ?>
                        </th>
                        <th width="10%">
                            <?php echo JHtml::_('grid.sort', 'Nome', 'nome', $listDirn, $listOrder); ?>
                        </th>
                        <th width="20%">
                            <?php echo JHtml::_('grid.sort', 'Escola', 'escola', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Turma', 'turma', $listDirn, $listOrder); ?>
                        </th>
                        <th width="8%">
                            <?php echo JHtml::_('grid.sort', 'Data Início', 'data_inicio', $listDirn, $listOrder); ?>
                        </th>
                        <th width="8%">
                            <?php echo JHtml::_('grid.sort', 'Data Término', 'data_termino', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Veículo', 'veiculo', $listDirn, $listOrder); ?>
                        </th>
                        <th width="5%">
                            <?php echo JHtml::_('grid.sort', 'Status', 'status', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Site', 'site', $listDirn, $listOrder); ?>
                        </th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.sort', 'Âmbito', 'ambito', $listDirn, $listOrder); ?>
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
                            $link = JRoute::_('index.php?option=com_concursos&task=concurso.edit&id=' . $row->id);
                            ?>
                            <tr>
                                <td><?php echo $row->id; ?></td>
                                <td>
                                    <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                                </td>
                                <td>
                                    <a href="<?php echo $link; ?>" title="<?php echo JText::_('EDIT CONCURSOS'); ?>">
                                        <?php echo $row->sigla; ?>
                                    </a>
                                </td>
                                <td><?php echo $row->nome; ?></td>
                                <td><?php echo $row->escola; ?></td>
                                <td><?php echo $row->turma; ?></td>
                                <td><?php echo JHtml::_('date', $row->data_inicio, JText::_('DATE_FORMAT_LC4')); ?></td>
                                <td><?php echo JHtml::_('date', $row->data_termino, JText::_('DATE_FORMAT_LC4')); ?></td>

                                <td><?php echo $veiculo["{$row->veiculo}"]; ?></td>
                                <td><?php echo $status["{$row->status}"]; ?></td>
                                <td><?php echo $row->site; ?></td>
                                <td><?php echo $row->ambito; ?></td>
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
    </div>
</form>

