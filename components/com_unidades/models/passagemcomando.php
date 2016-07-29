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

/**
 * passagemcomando Component Passagemcomando Model
 *
 * @category Model
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class unidadesModelPassagemcomando extends JModelLegacy
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
        $params = &JComponentHelper::getParams('com_unidades');
        if($id == "") {
            $id = $params->get('id');
        }
        $this->_db->setQuery("SELECT * FROM `#__unidades_passagemcomando` WHERE `id` = $id");
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
        $row =& $this->getTable('Passagemcomando', 'JTable');
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
        $this->_items = $this->_getList('SELECT * FROM `#__unidades_passagemcomando`');
        return is_null($this->_items) ? false : true;
    }
    
    
    public function getPassagens() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('p.id_unidade, p.titular, p.substituto, p.data, u.logo_om');
        $query->from('#__unidades_passagemcomando p');
        $query->where('p.status=1');
        $query->join('INNER', " #__unidades_unidade u ON(p.id_unidade=u.id)");
        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
        
    }
}
