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
<form class="form-inline" action="index.php?option=com_aeronaves&layout=list" method="post" >
    <input type="text" name='aeronave' class="input-small" placeholder="Aeronave">
    <input type="hidden" name="pesquisar" value="1" />
    <select name="tipo_aviacao">
        <option value=''>Selecione</option>
                    <option>Caça</option>
                    <option>Transporte</option>
                    <option>Treinamento</option>
                    <option>Transporte de Carga</option>
                    <option>Asas Rotativas</option>
                    <option>Ataque</option>
                    <option>Patrulha</option>
                    <option>Reconhecimento</option>
                    <option>Transporte de Autoridades</option>
                    <option>Transporte de Pessoal</option>
                    
              
    </select>
    <input type="text" name='pais_origem' class="input-small" placeholder="País Origem">
    <input type="text" name='paises_operacao' class="input-small" placeholder="Países Operação">
    <button type="submit" class="btn">Pesquisar</button>
    <input type="hidden" name="view" value="aeronave" />
    <input type="hidden" name="controller" value="aeronave" />
</form>


<table class="table table-bordered">
    <thead>
        <tr>
            <td>Imagem</td>
            <td>Aeronave</td>
            <td>Tripulacao</td>
	    <td>Tipo de Aviação</td>
        </tr>
          
    </thead>
    <tbody>
        <?php foreach ($this->items as $item):
            $link = JRoute::_("index.php?option=com_aeronaves&amp;view=aeronave&amp;&amp;id=$item->id&amp;layout=details");
            ?>
            <tr>
                <td> <a href="<?php echo $link?>"><img src="<?php echo $item->imagem ?>" alt="Imagem" style="width: 100px"> </a></td>
                <td><a href="<?php echo $link?>"><?php echo $item->aeronave ?></a></td>
                <td><?php echo $item->tripulacao ?></td>
		<td><?php echo $item->tipo_aviacao ?></td>
            </tr>
        <?php endforeach;?>
        
        
    </tbody>
        
</table>




