<?php

/**
 * Icas Model of the Concursos Component
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


class ConcursosModelIca extends JModelAdmin {

    public function __construct() {
        parent::__construct();
    }

    public function getTable($type = 'ICAS', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

   
   /*
    public function save() {
        $row = & $this->getTable('Icas', 'JTable');
        $data = JRequest::get('post');
        
        //script para realizar upload.
        $arquivo = JRequest::getVar('jform', array(), 'files', 'array');
        $diretorio = JPATH_SITE."/images/";

        if (is_dir($diretorio)) {
            $destino = $diretorio . "/" . $arquivo['name']["arquivo"];
            move_uploaded_file($arquivo['tmp_name']["arquivo"], $destino) ;
                
           
        }
        
        if(!$arquivo['name']["arquivo"]){
            unset($row->arquivo);
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

   
    public function delete() {
        $row = & $this->getTable('Icas', 'JTable');
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        foreach ($cids as $cid) {
            if (!$row->delete($cid)) {
                $this->setError($row->getErrorMsg());
                return false;
            }
        }
        return true;
    }
 
    
    private function _loadItems() {
        $query="SELECT * FROM `#__concursos_icas`";
        $pesquisar= JRequest::getVar('pesquisar');
         
        if($pesquisar){
            $sigla= JRequest::getVar('sigla');
            $descricao= JRequest::getVar('descricao');
            $ano= JRequest::getVar('ano');
            $referencia= JRequest::getVar('referencia');
           $query.=" WHERE `sigla` LIKE '%$sigla%'";
           if($descricao){
                $query.=" AND `descricao` LIKE '%$descricao%'";
           }
           if($ano){
                $query.=" AND `ano` = $ano";
           }
            if($referencia){
               
                $query.=" AND `referencia` = $referencia";
           }
            
        }
        //echo "<pre>"; print_r($req); exit();
        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }
*/
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_concursos.icas', 'icas', array(
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
                'com_concursos.edit.icas.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
