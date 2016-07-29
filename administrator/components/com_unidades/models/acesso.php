<?php

/**
 * Passagemcomando Model of the passagemcomando Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class unidadesModelAcesso extends JModelLegacy {

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

    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }

    public function getItem() {
        $cid = JRequest::getVar('cid');
        $id = (int) $cid[0];
        $row = & $this->getTable('Passagemcomando', 'JTable');
        $row->load($id);
        return $row;
    }

    public function save() {
        $row = & $this->getTable('Passagemcomando', 'JTable');
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

    public function delete() {
        $row = & $this->getTable('Passagemcomando', 'JTable');
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
        //print_r(JRequest::get());
        //exit();
        $query = "SELECT p.id, p.id_unidade, p.titular, p.substituto, p.data, p.status, u.nome_om
            FROM #__unidades_passagemcomando p
            LEFT JOIN #__unidades_unidade u ON p.id_unidade = u.id ";
        $pesquisar = JRequest::getVar('pesquisar');
        if ($pesquisar == 1) {
            $status = JRequest::getVar('status');
            $data_inicio = JRequest::getVar('data_inicio');
            $data_termino = JRequest::getVar('data_termino');
            $nome_om = JRequest::getVar('nome_om');
            if ($status != 2) {
                $query .="where p.status=$status";
                //echo $pesquisar;exit($query);
            } else {
                $query .="where (p.status=1 or p.status=0)";
            }

            if ($data_inicio) {
                $query .=" and p.data>='$data_inicio'";
            }

            if ($data_termino) {
                $query .=" and p.data<='$data_termino'";
            }
            if ($nome_om) {
                $query .=" and u.nome_om LIKE '%$nome_om%'";
            }
        }


        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }

    public function getUnidades() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__unidades_unidade');
        $db->setQuery($query);
        $results = $db->loadObjectList();

        return $results;
    }

    public function getUnidadesAssoc() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__unidades_unidade');
        $db->setQuery($query);
        $results = $db->loadAssocList("id");

        return $results;
    }

    public function getUsers() {
        $db = & JFactory::getDBO();
        $query = "SELECT * FROM #__users";
        $db->setQuery($query);

        $rows = $db->loadObjectList();
       //echo "<pre>"; print_r($rows); exit();
        return $rows;
    }

}
