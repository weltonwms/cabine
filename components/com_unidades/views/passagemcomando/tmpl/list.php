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
?>

<h2> Passagem de Comando</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>Organização Militar</td>
            <td>Titular</td>
            <td>Substituto</td>
            <td>Data</td>
        </tr>
    </thead>
    
    <tbody>
       
            <?php foreach ($this->passagens as $passagem):?>
         <tr>
            <td>
                <img src="<?php echo $passagem->logo_om?>" alt="DOM" style="height: 75px"> 
            
            </td>
            <td><?php echo $passagem->titular?></td>
            <td><?php echo $passagem->substituto?></td>
            <td><?php echo JHtml::_('date', $passagem->data_aniversario, JText::_('DATE_FORMAT_LC4')); ?></td>
            
            
            
            
         </tr>
           <?php endforeach; ?>
       
        
        
    </tbody>
        
</table>


