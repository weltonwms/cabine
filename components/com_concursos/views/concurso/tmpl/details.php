<?php
/**
 * Concurso HTML Details Template
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

<p><b><?php echo JText::_('Nome do Concurso'); ?> :</b>
     <?php echo $this->item->nome; ?>
</p>


<p><b><?php echo JText::_('Sigla'); ?> :</b> 
    <?php echo $this->item->sigla; ?>
</p>
<?php $inscricoes=array('','Abertas','Em Andamento','Encerradas')?>
<p><b><?php echo JText::_('Inscrições'); ?> :</b> 
    <?php echo $inscricoes[$this->item->status]; ?>
</p>

<p><b><?php echo JText::_('Turma') ?> :</b> 
    <?php echo $this->item->turma; ?>
</p>

<p><b><?php echo JText::_('Escola'); ?> :</b> 
    <?php echo $this->item->escola; ?>
</p>

<p><b><?php echo JText::_('Site'); ?> :</b> 
    <a target="__blank" href="http://<?php echo $this->item->site; ?>"><?php echo $this->item->site; ?></a>
</p>

<p><b><?php echo JText::_('Instruções Específicas'); ?> :</b> <br>
     <?php 
   $link_arquivo0 = JUri::root()."images/conc/{$this->item->instrucoes_especificas}";
   echo "<a target='__blank'  href='$link_arquivo0'>"."Instruções Específicas"."</a>"; 
   ?>
    <br>
   <?php 
   $link_arquivo = JUri::root()."images/{$this->item->arquivo_inspecao}";
   echo "<a target='__blank'  href='$link_arquivo'>".$this->item->sigla_inspecao."</a>"; 
   ?>
    <br>
     <?php 
   $link_arquivo2 = JUri::root()."images/{$this->item->arquivo_psicologico}";
   echo "<a target='__blank'  href='$link_arquivo2'>".$this->item->sigla_psicologico."</a>"; 
   ?>
     <br>
     <?php 
   $link_arquivo3 = JUri::root()."images/{$this->item->arquivo_tacf}";
   echo "<a target='__blank'  href='$link_arquivo3'>".$this->item->sigla_tacf."</a>"; 
   ?>
</p>
    <?php
     //echo "<pre>"; print_r($this->item);
    ?>

    


   


