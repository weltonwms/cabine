
<?php
/**
 * 
 *
 * PHP versions 5
 *
 * @category  Template
 * @package   unidade
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;
?>

<h2> Unidades</h2>

<p align='center'><img src="<?php echo $this->item->logo_om ?>" alt="Logo" style="height: 100px"></p>
<h4 align='center'> <?php echo $this->item->sigla ?></h4>

<h4 align='center'> <?php echo $this->item->nome_om ?></h4>
<?php if ($this->item->endereco): ?>
    <h4 align='center'><?php echo $this->item->endereco ?></h4>  
<?php endif; ?>
<h6 align='center'>
    <?php if ($this->item->cep): 
    echo " CEP: </b> {$this->item->cep}  - " ;
    endif;
     echo $this->item->cidade . " - " . $this->item->uf ;
     if($this->item->pais):
         echo " - ".$this->item->pais ;
     endif;
    ?> 
</h6>
<h6 align='center'><?php echo $this->item->complemento ?> </h6>

<?php if ($this->item->data_aniversario): ?>
    <p><b>Data de Aniversário: </b><td><?php echo JHtml::_('date', $this->item->data_aniversario, JText::_('DATE_FORMAT_LC4')); ?></td></p>  
<?php endif; ?>
<?php if ($this->item->comandante): ?>
<p><b>Comandante: </b><?php echo $this->item->comandante ?></p> 
<?php endif;?>
<?php if ($this->item->site_internet): ?>
<p><b>Site Internet: </b><?php echo $this->item->site_internet ?></p>  
<?php endif;?>
<?php if ($this->item->site_intraer): ?>
<p><b>Site Intraer: </b><?php echo $this->item->site_intraer ?></p>  
<?php endif;?>

<p><b>Categoria: </b><?php echo $this->item->categoria ?></p> 
<?php if ($this->item->ddd): ?>
<p><b>DDD: </b><?php echo $this->item->ddd ?></p>
<?php endif;?>
<?php if ($this->item->pabx): ?>
<p><b>PABX: </b><?php echo $this->item->pabx ?></p>
<?php endif;?>
<?php if ($this->item->caixa_postal): ?>
<p><b>Caixa Postal: </b><?php echo $this->item->caixa_postal ?></p>
<?php endif;?>
<?php if ($this->item->fax): ?>
<p><b>FAX: </b><?php echo $this->item->fax ?></p>
<?php endif;?>
<p><?php echo nl2br($this->item->lista_ramais) ?></p>  
<br>
<?php
$link_voltar = JRoute::_("index.php?option=com_unidades&amp;view=unidades");
?>
<a class="btn btn-default" href="<?php echo $link_voltar ?>">Voltar</a>








