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
?>

<h1><?php echo JText::_('Concurso'); ?></h1>
<form method="post" class="form-inline">
    <input type="text" name="sigla" class="input-small" placeholder="Sigla">
    <input type="text" name="escola" class="input-small" placeholder="Escola">
    <input type="text" name="nome" class="" placeholder="Nome do Concurso">
    
   
    <select name="status">
        <option value="">--Status--</option>
        <option value="1">Inscrições Abertas</option>
        <option value="2">Em Andamento</option>
        <option value="3">Concluído</option>
    </select>
     
     <input type="hidden" name="option" value="com_concursos" />
    <input type="hidden" name="pesquisar" value="1" />
    <input type="hidden" name="view" value="concurso" />
    <input type="hidden" name="layout" value="list" />
    <button type="submit" class="btn">Pesquisar</button>
    </form>
<div id="concurso_list">
    
    <table class="table table-striped" >
    <thead>
        <tr>
             <th><?php echo JText::_('Nome Concurso'); ?></th>
            <th><?php echo JText::_('Sigla'); ?></th>
            <th><?php echo JText::_('Escola'); ?></th>
             <th><?php echo JText::_('Turma'); ?></th>
        </tr>
    </thead>

    <?php foreach ($this->items as $item) : ?>
    <?php $link = JRoute::_('index.php?option=com_concursos&amp;view=concurso&amp;layout=details&amp;id='.$item->id); ?>
        <tr>
            <td><?php echo "<a href='$link'>".$item->nome."</a>"; ?></td>
            <td><?php echo "<a href='$link'>".$item->sigla."</a>"; ?></td>
            <td><?php echo "<a href='$link'>".$item->escola."</a>"; ?></td>
            <td><?php echo "<a href='$link'>".$item->turma."</a>"; ?></td>
            
        </tr>
    <?php endforeach; ?>
    </table>

</div>