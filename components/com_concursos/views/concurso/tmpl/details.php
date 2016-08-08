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
<?php $inscricoes = array('', 'Abertas', 'Em Andamento', 'Encerradas') ?>
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
    $link_arquivo0 = JUri::base() . $this->item->instrucoes_especificas;
    echo "<a target='__blank'  href='$link_arquivo0'>" . "Edital do Exame" . "</a>";
    ?>
   
    <?php
    if ($this->item->arquivo_inspecao):
        echo ' <br>';
        $link_arquivo = JUri::base() . $this->item->arquivo_inspecao;
        echo "<a target='__blank'  href='$link_arquivo'>" . $this->item->descricao_inspecao . "</a>";
    endif;
    ?>
   
    <?php
    if ($this->item->arquivo_psicologico):
        echo ' <br>';
        $link_arquivo2 = JUri::base() . $this->item->arquivo_psicologico;
        echo "<a target='__blank'  href='$link_arquivo2'>" . $this->item->descricao_psicologico . "</a>";
    endif;
    ?>
    
    <?php
    if ($this->item->arquivo_tacf):
        echo ' <br>';
        $link_arquivo3 = JUri::base() . $this->item->arquivo_tacf;
        echo "<a target='__blank'  href='$link_arquivo3'>" . $this->item->descricao_tacf . "</a>";
    endif;
    ?>
</p>
<br>
<br>
<?php
$link_voltar = JRoute::_("index.php?option=com_concursos&amp;view=concursos");
?>
<a class="btn btn-default" href="<?php echo $link_voltar ?>">Voltar</a>







