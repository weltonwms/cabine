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

jimport('joomla.application.component.model');

/**
 * Concursos Component Concurso Model
 *
 * @category Model
 * @package  Concursos
 * @author   Welton Moreira dos Santos <weltonwms@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class ConcursosModelConcurso extends JModelLegacy {

    /**
     * Constructor
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method to get data
     *
     * @return object Items data
     * @access public
     * @since  1.0
     */
    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }

    /**
     * Method to load data from a specific item
     *
     * @return object Item data
     * @access public
     * @since  1.0
     */
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
            INNER JOIN #__concursos_icas isa ON (c.ica_inspecao=isa.id)
            INNER JOIN #__concursos_icas ip ON (c.ica_psicologico=ip.id)
            INNER JOIN #__concursos_icas it ON (c.ica_tacf=it.id)
             WHERE c.id = $id";
        $this->_db->setQuery($query);
        return $this->_db->loadObject();
    }

    /**
     * Method to save an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function save() {
        $row = & $this->getTable('Concurso', 'JTable');
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->check()) {
            $this->setError($row->getError());
            return false;
        }

        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }

    /**
     * Method to load data
     *
     * @return boolean
     * @access private
     * @since  1.0
     */
    private function _loadItems() {
        $query = "SELECT * FROM `#__concursos_concurso`";
         $pesquisar= JRequest::getVar('pesquisar');
         
        if($pesquisar){
            $sigla= JRequest::getVar('sigla');
            $escola= JRequest::getVar('escola');
            $nome= JRequest::getVar('nome');
            $status= JRequest::getVar('status');
           $query.=" WHERE `sigla` LIKE '%$sigla%'";
           if($escola){
               $query.=" AND `escola` LIKE '%$escola%'";
           }
           if($nome){
                $query.=" AND `nome` LIKE '%$nome%'";
           }
           if($status){
               
                $query.=" AND `status` = $status";
           }
         
        }
        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }

}
