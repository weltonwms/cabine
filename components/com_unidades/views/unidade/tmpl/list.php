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
<form class="form-inline" action="index.php?option=com_unidades&layout=list" method="post" >
    <input type="text" name='nome_om' class="input-small" placeholder="Nome OM">
    <input type="hidden" name="pesquisar" value="1" />
    <select name="categoria">
        <option value=''>Selecione</option>
                    <option>Academia</option>
                    <option>Aditância</option>
                    <option>Assessoria</option>
                    <option>Base</option>
                    <option>Batalhão</option>
                    <option>Caixa</option>
                    <option>Campo</option>
                    <option>Casa</option>
                    <option>Centro</option>
                    <option>Colegio</option>
                    <option>Comando</option>
                    <option>Comissão</option>
                    <option>Consultoria</option>
                    <option>Departamento</option>
                    <option>Depósito</option>
                    <option>Destacamento</option>
                    <option>Diretoria</option>
                    <option>Escola</option>
                    <option>Escritório</option>
                    <option>Esquadrão</option>
                    <option>Estado-Maior</option>
                    <option>FAE</option>
                    <option>Fazenda</option>
                    <option>Gabinete</option>
                    <option>Batalhão</option>
                    <option>Grupamento</option>
                    <option>Grupo</option>
                    <option>Hospital</option>
                    <option>Instituto</option>
                    <option>Junta</option>
                    <option>Laboratório</option>
                    <option>Ministério</option>
                    <option>Missão</option>
                    <option>Museu</option>
                    <option>Núcleo</option>
                    <option>Odontoclínica</option>
                    <option>Organização</option>
                    <option>Pagadoria</option>
                    <option>Parque</option>
                    <option>Policlínica</option>
                    <option>Prefeitura</option>
                    <option>Presidência</option>
                    <option>Representação</option>
                    <option>Secretaria</option>
                    <option>Serviço</option>
                    <option>Sociedade</option>
                    <option>STM</option>
                    <option>Subdiretoria</option>
                    <option>Universidade</option>
                    <option>Vice-Presidência</option>
              
    </select>
    <input type="text" name='cidade' class="input-small" placeholder="Cidade">
    <input type="text" name='uf' class="input-small" placeholder="UF">
    <button type="submit" class="btn">Pesquisar</button>
    <input type="hidden" name="view" value="unidade" />
    <input type="hidden" name="controller" value="unidade" />
</form>


<table class="table table-bordered">
    <thead>
        <tr>
            <td>Logo</td>
            <td>Nome</td>
            <td>Estado</td>
        </tr>
          
    </thead>
    <tbody>
        <?php foreach ($this->items as $item):
            $link = JRoute::_('index.php?option=com_unidades&amp;view=unidade&amp;layout=details&amp;id='.$item->id);
            ?>
            <tr>
                <td> <a href="<?php echo $link?>"><img src="<?php echo $item->logo_om ?>" alt="Logo" style="height: 50px"> </a></td>
                <td><a href="<?php echo $link?>"><?php echo $item->nome_om ?></a></td>
                <td><?php echo $item->cidade." - ".$item->uf ?></td>
            </tr>
        <?php endforeach;?>
        
        
    </tbody>
        
</table>




