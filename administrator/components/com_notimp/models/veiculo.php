<?php

/**
 * Veiculo Model of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class NotimpModelVeiculo extends JModelAdmin {

    
    public function __construct() {
       
        parent::__construct();
    }

    
    public function save($data) {
       
        if (!$data['id']) {
            $data['ordem'] = $this->getUltimaOrdem();
        }
        
        $retorno= parent::save($data);
        
        if($retorno){
            $this->ordena_veiculos($data);
        }
       return $retorno;
    }
    

    private function ordena_veiculos($data) {
        if ($data["id"]) {
            if ($data['ordem'] > $data['ordem_original']) {
                $this->subir_ordem($data);
            } elseif ($data['ordem'] < $data['ordem_original']) {
                $this->descer_ordem($data);
            }
        }
    }

    private function subir_ordem($data) {
        $id = $data['id'];
        $ordem = $data['ordem'];
        $ordem_original = $data['ordem_original'];
        $query = "UPDATE `#__notimpe_veiculo` SET ordem=(ordem -1) ";
        $query.=" where (ordem > $ordem_original AND ordem < $ordem) ";
        $query.=" OR id=$id";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
    }

    private function descer_ordem($data) {
        $id = $data['id'];
        $ordem = $data['ordem'];
        $ordem_original = $data['ordem_original'];
        $query = "UPDATE `#__notimpe_veiculo` SET ordem=(ordem +1) ";
        $query.=" where ordem >= $ordem AND ordem < $ordem_original";
        $query.=" AND id<>$id";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
    }

    private function getUltimaOrdem() {
        $query = "SELECT max( ordem ) FROM `#__notimpe_veiculo` ";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $resultado = $db->loadResult();
        return $resultado + 1;
    }

 
    public function delete(&$pks) {
       
        if ($this->validaDelete($pks)) {
             return parent::delete($pks);
        }
       
        return false;
    }

    protected function canDelete($record) {
        $user = JFactory::getUser();
        return $user->authorise('core.delete', "com_notimp");
    }

    private function validaDelete($cids) {
        $cids_implodidos = implode(",", $cids);
        $query = "SELECT * FROM `#__notimpe_artigos` WHERE id_veiculo IN ($cids_implodidos) ";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
        if ($db->getAffectedRows() > 0) {
            $this->setError("Existe artigo(s) vinculados a veículo(s). Não foi possível Excluir! ");
            return FALSE;
        }
        return TRUE;
    }

    public function getTable($type = 'Veiculo', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_notimp.veiculo', 'veiculo', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

   
    protected function loadFormData() {
        $layout = JRequest::getVar('layout', NULL);
        if ($layout == "edit"):
            // Check the session for previously entered form data.
            $data = JFactory::getApplication()->getUserState(
                    'com_notimp.edit.veiculo.data', array()
            );

            if (empty($data)) {
                $data = $this->getItem();
            }

            return $data;
        endif;
        return parent::loadFormData();
    }

   

}
