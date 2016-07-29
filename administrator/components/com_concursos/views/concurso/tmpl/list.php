<?php
/**
 * Concurso HTML List Template
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
    <input type="text" name="nome" class="" placeholder="Nome do Concurso">
    
    <?php echo JHtml::calendar('', 'data_inscricoes', 'data_inscricoes','%Y-%m-%d',"class='input-small' placeholder='Data Inscrições' readonly='readonly'")?>
    <select name="veiculo">
        <option value="">--Veículo--</option>
        <option value="1">Intraer</option>
        <option value="2">Internet/Intraer</option>
        
    </select>
     <select name="ambito">
        <option value="">--Âmbito--</option>
        <option value="interno">Interno</option>
        <option value="externo">Externo</option>
        
    </select>
     <select name="status">
        <option value="">--Status--</option>
        <option value="1">Incrições Abertas</option>
        <option value="2">Incrições Encerradas</option>
        <option value="3">Concursos Anteriores</option>
        
    </select>
     <input type="hidden" name="option" value="com_concursos" />
    <input type="hidden" name="pesquisar" value="1" />
    <input type="hidden" name="view" value="concurso" />
    <input type="hidden" name="layout" value="list" />
    <button type="submit" class="btn">Pesquisar</button>
    </form>


<div id="concurso">
    <form action="index.php" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist table table-striped table-hover">
        <thead>
            <tr>
                <th width="5"><?php echo JText::_('ID'); ?></th>
                <th width="4%"><?php echo JHtml::_('grid.checkall'); ?></th>
                  <th><?php echo JText::_('Sigla'); ?></th>
                  <th><?php echo JText::_('Nome'); ?></th>
                  <th><?php echo JText::_('Escola'); ?></th>
                  <th><?php echo JText::_('Turma'); ?></th>
                  <th><?php echo JText::_('Data Inicio'); ?></th>
                  <th><?php echo JText::_('Data Termino'); ?></th>
                  <th><?php echo JText::_('Veiculo'); ?></th>
                  <th><?php echo JText::_('Status'); ?></th>
                  <th><?php echo JText::_('Site'); ?></th>
                   <th><?php echo JText::_('Âmbito'); ?></th>
            </tr>
        </thead>
        <?php
            $k = 0;
            $i = 0;
            foreach($this->items as $row)
            {
                JFilterOutput::objectHTMLSafe($row);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_concursos&view=concurso&task=edit&cid[]='. $row->id);
        ?>
                <tr class="<?php echo "row$k"; ?>">
                  <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                    <?php
                        $veiculo=array('','intraer','internet/intraer');
                        $status=array('','Inscrições Abertas','Encerradas', "Concursos Anteriores");
                       
                    ?>
                       <td><?php echo "<a href='$link'>".$row->sigla."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->nome."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->escola."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->turma."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->data_inicio."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->data_termino."</a>"; ?></td>
                       
                       <td><?php echo "<a href='$link'>".$veiculo["{$row->veiculo}"]."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$status["{$row->status}"]."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->site."</a>"; ?></td>
                       <td><?php echo "<a href='$link'>".$row->ambito."</a>"; ?></td>
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
    <input type="hidden" name="view" value="concurso" />
    <input type="hidden" name="controller" value="concurso" />
</form>
</div>

