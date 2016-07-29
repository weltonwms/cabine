
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

<h2> Unidades</h2>

    <p align='center'><img src="<?php echo $this->item->logo_om ?>" alt="Logo" style="height: 100px"></p>
    <h4 align='center'> <?php echo $this->item->sigla ?></h4>
    <h4 align='center'> <?php echo $this->item->nome_om ?></h4>
    <h4 align='center'><?php echo $this->item->endereco ?></h4>        
    <h6 align='center'>CEP: </b><?php echo $this->item->cep ." - ". $this->item->cidade." - ".$this->item->uf." - ".$this->item->pais ?> </h6>
     <h6 align='center'><?php echo $this->item->complemento ?> </h6>
    <?php $data= new DateTime($this->item->data_aniversario);?>
    <p><b>Data de Aniversário: </b><?php echo $data->format("d/m/Y") ?></p>  
    <p><b>Comandante: </b><?php echo $this->item->comandante ?></p> 
    <p><b>Seção: </b><?php echo $this->item->secao ?></p> 
    <p><b>Site Internet: </b><?php echo $this->item->site_internet ?></p>  
    <p><b>Site Intraer: </b><?php echo $this->item->site_intraer ?></p>  
   
    <p><b>Categoria: </b><?php echo $this->item->categoria ?></p> 
    <p><b>DDD: </b><?php echo $this->item->ddd ?></p>
    <p><b>PABX: </b><?php echo $this->item->pabx ?></p>
    <p><b>Caixa Postal: </b><?php echo $this->item->caixa_postal ?></p>
    <p><b>FAX: </b><?php echo $this->item->fax ?></p>
    <p><?php echo nl2br($this->item->lista_ramais) ?></p>            
               
                
                
          




