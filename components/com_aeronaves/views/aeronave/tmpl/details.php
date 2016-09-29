
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

<h2> Aeronaves</h2>

    <p align='center'><img src="<?php echo $this->item->imagem ?>" alt="Imagem" style="width: 700px"></p>
     <p><b>Tipo de Aviação: </b> <?php echo $this->item->tipo_aviacao ?></p>
     <p><b>Nome Aeronave: </b> <?php echo $this->item->aeronave ?></p>
    <p><b>País de Origem: </b><?php echo $this->item->pais_origem ?></p> 
     <p><b>Países de Operação: </b><?php echo $this->item->paises_operacao ?></p>       
    <p><b>Tripulação: </b><?php echo $this->item->tripulacao ?></p> 
    <p><b>Armamento: </b><?php echo $this->item->armamento ?></p> 
    <p><b>Envergadura: </b><?php echo $this->item->envergadura ?></p>  
    <p><b>Comprimento: </b><?php echo $this->item->comprimento ?></p>  
   
    <p><b>Altura: </b><?php echo $this->item->altura ?></p> 
    <p><b>Peso: </b><?php echo $this->item->peso ?></p>
    <p><b>Peso Máximo: </b><?php echo $this->item->peso_maximo ?></p>
    <p><b>Decolagem: </b><?php echo $this->item->decolagem ?></p>
    <p><b>Motor: </b><?php echo $this->item->motor ?></p>
    <p><b>Velocidae Máxima: </b><?php echo $this->item->velocidade_maxima ?></p>
    <p><b>Teto Serviço: </b><?php echo $this->item->teto_servico ?></p>
    <p><b>Missões: </b><?php echo $this->item->missoes ?></p>
    <p><b>Versões Brasil: </b><?php echo $this->item->versoes_brasil ?></p>
    <p><b>Link: </b><?php echo $this->item->link ?></p>
    <p><b>Unidades da FAB: </b>
        <?php 
        foreach ($this->item->unidades as $key=>$unidade):
            echo $unidade. " ";
        endforeach; 
        ?>
    </p>
    <p><b>Tags: </b>
        <?php 
             foreach ($this->item->tags as $key=>$tag):
            echo $tag. " ";
        endforeach; 
        
        ?>
    
    </p>
    <?php $link_voltar = JRoute::_("index.php?option=com_aeronaves&amp;view=aeronave&amp;layout=list");?>
    <a href="<?php echo $link_voltar ?>" 
       class="btn btn-default text-center" > Voltar</a>
               
                
                
          




