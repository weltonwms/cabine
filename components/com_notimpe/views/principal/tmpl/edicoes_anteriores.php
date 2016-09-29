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
?>

<h4 class="titulo_edicoes_anteriores"><?php echo JText::_('Notimpe - Edições Anteriores'); ?></h4>

<form action="index.php?option=com_notimpe" method="post" class="form-horizontal" >
    <div class="formulario_anteriores"> 
<select class=" fe"name="ano_notimpe">
    <?php foreach ($this->anos as $ano) : ?>
     

            <option <?php if(isset($this->ano_notimpe)&& $this->ano_notimpe==$ano->ano) echo "selected='selected'"?>>
                <?php echo $ano->ano?>
            </option>

 
    <?php endforeach; ?>
</select>
       
   
    <button class="btn"type="submit"> enviar</button>
 </div>         

 <input type="hidden" name="option" value="com_notimpe" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="layout" value="edicoes_anteriores" />
        <input type="hidden" name="view" value="principal" />
        
        
</form>

<h5><?php echo JText::_('Notimpes - '); if(isset($this->ano_notimpe)) echo $this->ano_notimpe?></h5>
<?php if(isset($this->notimpes)):?>

    <?php foreach ($this->notimpes as $notimpe) : ?>
    <?php $link = JRoute::_('index.php?option=com_notimpe&amp;view=principal&amp;id='.$notimpe->id); ?>
<p>
                <?php echo "<a href='$link'>".$notimpe->nr_notimpe."  ({$notimpe->data})</a>"; ?>
            
           
</p>
        </tr>
    <?php endforeach; ?>
     <?php endif; ?>

        
        <?php 
        ?>
        
