<?php

/**
 * Notimpe Model of the Notimpe Component
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
$com_path = JPATH_ADMINISTRATOR . '/components/com_content/';

JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');
jimport('joomla.application.component.model');

/**
 * Notimpe Component Notimpe Model
 *
 * @category Model
 * @package  Notimpe
 * @author   Welton Moreira dos Santos <welton@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class NotimpeModelArquivo extends JModelLegacy {

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
        $cid = JRequest::getVar('cid');
        $id = (int) $cid[0];
        $row = & $this->getTable('Notimpe', 'JTable');
        $row->load($id);
        return $row;
    }

    /**
     * Method to save an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function save() {
        $row = & $this->getTable('Notimpe', 'JTable');
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
     * Method to delete an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function delete() {
        $row = & $this->getTable('Notimpe', 'JTable');
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        foreach ($cids as $cid) {
            if (!$row->delete($cid)) {
                $this->setError($row->getErrorMsg());
                return false;
            }
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
        $this->_items = $this->_getList("SELECT * FROM `#__notimpe_notimpe` where estado='2'");
        return is_null($this->_items) ? false : true;
    }

    public function getArtigos() {
        $cid = JRequest::getVar('cid');
        $id_notimpe = $cid[0];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_artigos'));
        $query->where("id_notimpe=$id_notimpe");

        $db->setQuery($query);
        $results = $db->loadObjectList();
        $array_arts = array();
        foreach ($results as $result):
            $array_arts[] = $result->id_artigo;
        endforeach;

        $artigos_joomla = $this->capturarArtigosJoomla($array_arts);
        return $artigos_joomla;
    }

    protected function capturarArtigosJoomla(array $artigos) {
        if ($artigos):
            $articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

            // Set application parameters in model
           
            $articles->setState('params', new JRegistry());



            $items = $articles->getItems();
            $lista=array();
            foreach ($items as $item):
                 if(in_array($item->id,$artigos)):
                     $lista[]=$item;
                 endif;
            endforeach;
           return $lista;
        endif;
        return array();
    }

}
