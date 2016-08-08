<?php

/**
 * Concurso Model of the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosModelConcurso extends JModelLegacy {

    
   
    public function getItem() {
        $id = JRequest::getVar('id', "");
        $params = &JComponentHelper::getParams('com_concursos');
        if ($id == "") {
            $id = $params->get('id');
        }
        $query = "SELECT c.id, c.sigla, c.nome, c.escola, c.turma, c.data_inicio,
            c.data_termino, c.ica_inspecao, c.ica_psicologico, c.ica_tacf, 
            c.instrucoes_especificas, c.veiculo, c.status, c.site, c.ambito, 
            isa.arquivo as arquivo_inspecao, ip.arquivo as arquivo_psicologico,
            it.arquivo as arquivo_tacf, isa.sigla as sigla_inspecao, ip.sigla as
            sigla_psicologico, it.sigla as sigla_tacf,
            isa.descricao as descricao_inspecao, ip.descricao as descricao_psicologico,
            it.descricao as descricao_tacf
            from #__concursos_concurso c
            LEFT JOIN #__concursos_icas isa ON (c.ica_inspecao=isa.id)
            LEFT JOIN #__concursos_icas ip ON (c.ica_psicologico=ip.id)
            LEFT JOIN #__concursos_icas it ON (c.ica_tacf=it.id)
             WHERE c.id = $id";
        $this->_db->setQuery($query);
        $result=$this->_db->loadObject();
        //echo "<pre>"; print_r($result); exit();
        return $result;
    }

    
   

}
