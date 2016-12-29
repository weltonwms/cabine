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

<form action="<?php echo JRoute::_('index.php?option=com_notimp&view=notimps') ?>" class="form-horizontal" >
    <div class="formulario_anteriores"> 
        <select class=" fe" name="ano" required="required">
    <option value="">--Selecione--</option>
    <?php foreach ($this->anos as $ano) : ?>
     
            
            <option <?php if($ano==$this->anoAtivo) echo "selected='selected'"?>>
                <?php echo $ano?>
            </option>

 
    <?php endforeach; ?>
</select>
       
   
    <button class="btn"type="submit"> enviar</button>
 </div>         

 
       
       
        
        
</form>


<?php if(isset($this->notimps)):?>
<h5><?php echo 'Notimps - '; echo $this->anoAtivo?></h5>
    <?php foreach ($this->notimps as $notimpe) : ?>
    <?php $link = JRoute::_('index.php?option=com_notimp&amp;view=notimp&amp;id='.$notimpe->id); ?>
<p>
                <?php echo "<a href='$link'>".$notimpe->nr_notimpe."  ({$notimpe->data})</a>"; ?>
            
           
</p>
        </tr>
    <?php endforeach; ?>
     <?php endif; 
    
     ?>

        
        
        
