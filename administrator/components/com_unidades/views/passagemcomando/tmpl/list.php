<?php
/**
 * Passagemcomando HTML List Template
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
jimport('joomla.filter.filteroutput');
?>
<div id="j-sidebar-container" class="span2">
    <?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
<form class="form-inline" action="index.php?option=com_unidades&layout=list" method="post">
    <input type="text" name='nome_om' class="input-small" placeholder="Nome OM">
    <label for="data_inicio"><?php echo JText::_('Data Inicio'); ?> </label> 
    <?php echo JHtml::calendar('', 'data_inicio', 'data_inicio', '%Y-%m-%d',  "readonly='readonly'"); ?>                  

    <label for="data_termino"><?php echo JText::_('Data Termino'); ?> </label> 
    <?php echo JHtml::calendar('', 'data_termino', 'data_termino', '%Y-%m-%d', "readonly='readonly'"); ?>  

    <input type="hidden" name="pesquisar" value="1" />
    <select name="status">
        <option value="2">Todos</option>
        <option value="1">Publicado</option>
        <option value="0">Despublicado</option>        
    </select>
    <button type="submit" class="btn">Pesquisar</button>
    <input type="hidden" name="view" value="passagemcomando" />
    <input type="hidden" name="controller" value="passagemcomando" />
</form>

<div id="passagemcomando">
    <form action="index.php" method="post" name="adminForm" id="adminForm">
        <div id="editcell">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5"><?php echo JText::_('ID'); ?></th>
                        <th width="20"><?php echo JHtml::_('grid.checkall')?></th>
                        <th><?php echo JText::_('Nome OM'); ?></th>
                        <th><?php echo JText::_('Titular'); ?></th>
                        <th><?php echo JText::_('Substituto'); ?></th>
                        <th><?php echo JText::_('Data'); ?></th>
                        <th><?php echo JText::_('Status'); ?></th>

                    </tr>
                </thead>
                <?php
                $k = 0;
                $i = 0;
                foreach ($this->items as $row) {
                    JFilterOutput::objectHTMLSafe($row);
                    $checked = JHTML::_('grid.id', $i, $row->id);
                    $link = JRoute::_('index.php?option=com_unidades&view=passagemcomando&task=edit&cid[]=' . $row->id);
                    ?>
                    <tr class="<?php echo "row$k"; ?>">
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $checked; ?></td>
                        <td><?php echo "<a href='$link'>" . $row->nome_om . "</a>"; ?></td>
                        <td><?php echo $row->titular; ?></td>
                        <td><?php echo $row->substituto; ?></td>
                       <td><?php echo JHtml::_('date', $row->data_aniversario, JText::_('DATE_FORMAT_LC4')); ?></td>
                        <td><?php
                            if ($row->status) {
                                echo 'Publicado';
                            } else {
                                echo'Despublicada';
                            }
                            ?></td>

                    </tr>
                    <?php
                    $k = 1 - $k;
                    $i = $i + 1;
                }
                ?>
            </table>
        </div>
        <input type="hidden" name="option" value="com_unidades" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="view" value="passagemcomando" />
        <input type="hidden" name="controller" value="passagemcomando" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
</div>



