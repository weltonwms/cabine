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

jimport('joomla.application.component.model');

/**
 * Concursos Component Icas Model
 *
 * @category Model
 * @package  Concursos
 * @author   Welton Moreira dos Santos <weltonwms@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class ConcursosModelIcas extends JModelLegacy
{
    /**
     * Constructor
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to get data
     *
     * @return object Items data
     * @access public
     * @since  1.0
     */
    public function getItems()
    {
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
    public function getItem()
    {
        $id = JRequest::getVar('id', "");
        $params = &JComponentHelper::getParams('com_concursos');
        if($id == "") {
            $id = $params->get('id');
        }
        $this->_db->setQuery("SELECT * FROM `#__concursos_icas` WHERE `id` = $id");
        return $this->_db->loadObject();
    }

    /**
     * Method to save an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function save()
    {
        $row =& $this->getTable('Icas', 'JTable');
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
    private function _loadItems()
    {
        $this->_items = $this->_getList('SELECT * FROM `#__concursos_icas`');
        return is_null($this->_items) ? false : true;
    }
}
