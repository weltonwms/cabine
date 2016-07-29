<?php
/**
 * Icas HTML List Template
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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filter.filteroutput');
?>
    <form method="post" class="form-inline">
    <input type="text" name="sigla" class="input-small" placeholder="Sigla">
    <input type="text" name="descricao" class="input-small" placeholder="Descrição">
    <input type="text" name="ano" class="input-small" placeholder="Ano">
    <select name="referencia">
        <option value="">--Referência--</option>
        <option value="1">Inspeção de Sáude</option>
        <option value="2">Exames Psicológicos</option>
        <option value="3">TACF</option>
    </select>
     <input type="hidden" name="option" value="com_concursos" />
    <input type="hidden" name="pesquisar" value="1" />
    <input type="hidden" name="view" value="icas" />
    <input type="hidden" name="layout" value="list" />
    <button type="submit" class="btn">Pesquisar</button>
    </form>

<div id="icas">
    <form action="index.php" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist table table-striped table-hover">
        <thead>
            <tr>
                <th width="5"><?php echo JText::_('ID'); ?></th>
                 <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                  <th><?php echo JText::_('Sigla'); ?></th>
                  <th><?php echo JText::_('Descricao'); ?></th>
                  <th><?php echo JText::_('Referencia'); ?></th>
                  <th><?php echo JText::_('Ano'); ?></th>
                  <th><?php echo JText::_('Arquivo'); ?></th>
            </tr>
        </thead>
        <?php
            $k = 0;
            $i = 0;
            foreach($this->items as $row)
            {
                $referencia=array('','Inspeção de Saúde', 'Exames Psicológicos','TACF');
                JFilterOutput::objectHTMLSafe($row);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_concursos&view=icas&task=edit&cid[]='. $row->id);
                $link_arquivo = JUri::root()."images/$row->arquivo";
               ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                       <td><?php echo "<a href='$link'>".$row->sigla."</a>"; ?></td>
                       <td><?php echo $row->descricao; ?></td>
                       <td><?php echo $referencia[$row->referencia]; ?></td>
                       <td><?php echo $row->ano; ?></td>
                      <td><?php echo "<a target='__blank'  href='$link_arquivo'>".$row->arquivo."</a>"; ?></td>
                </tr>
        <?php
                $k = 1 - $k;
                $i = $i + 1;
            }
        ?>
        </table>
    </div>
    <input type="hidden" name="option" value="com_concursos" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="view" value="icas" />
    <input type="hidden" name="controller" value="icas" />
</form>
</div>

