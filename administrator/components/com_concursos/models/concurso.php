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
class ConcursosModelConcurso extends JModelAdmin {

    public function __construct() {
        parent::__construct();
    }

    public function getTable($type = 'Concurso', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    /*
      public function save()
      {
      $row =& $this->getTable('Concurso', 'JTable');
      $data = JRequest::get('post');

      //script para realizar upload.
      $arquivo = JRequest::getVar('jform', array(), 'files', 'array');

      $diretorio = JPATH_SITE."/images/conc";

      if(!$arquivo['name']["instrucoes_especificas"]){
      unset($row->instrucoes_especificas);
      }



      if (is_dir($diretorio)) {
      $destino = $diretorio . "/" . $arquivo['name']["instrucoes_especificas"];
      move_uploaded_file($arquivo['tmp_name']["instrucoes_especificas"], $destino) ;


      }


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

     */


    /*
      private function _loadItems()
      {
      $query="SELECT * FROM `#__concursos_concurso`";
      $pesquisar= JRequest::getVar('pesquisar');

      if($pesquisar){
      $sigla= JRequest::getVar('sigla');
      $nome= JRequest::getVar('nome');
      $data_inscricoes= JRequest::getVar('data_inscricoes');
      $veiculo= JRequest::getVar('veiculo');
      $ambito= JRequest::getVar('ambito');
      $status= JRequest::getVar('status');
      $query.=" WHERE `sigla` LIKE '%$sigla%'";
      if($nome){
      $query.=" AND `nome` LIKE '%$nome%'";
      }
      if($veiculo){
      $query.=" AND `veiculo` = $veiculo";
      }
      if($ambito){

      $query.=" AND `ambito` = '$ambito'";
      }
      if($status){

      $query.=" AND `status` = $status";
      }

      if($data_inscricoes){
      $query.=" AND `data_inicio` <= '$data_inscricoes' AND `data_termino` >='$data_inscricoes' ";
      }

      }

      $this->_items = $this->_getList($query);
      return is_null($this->_items) ? false : true;
      }
     * 
     */

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_concursos.concurso', 'concurso', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_concursos.edit.concurso.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
