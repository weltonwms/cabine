<?php
/**
 * Passagemcomando Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');

/**
 * Passagemcomando Table Class
 *
 * @category  Table_Class
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 */
class JTablePassagemcomando extends JTable
{
    /**
     * @var int Primary key
     */
    var $id = null;
    
    /**
     * @var int Id Unidade
     */
    var $id_unidade = 0;

    /**
     * @var string Titular
     */
    var $titular = '';

    /**
     * @var string Substituto
     */
    var $substituto = '';

    /**
     * @var date Data
     */
    var $data = null;
    
    var $status='0';

    /**
     * Constructor
     *
     * @param object &$db A database connector object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct(&$db)
    {
        parent::__construct('#__unidades_passagemcomando', 'id', $db);
    }

    /**
     * Overloaded check function
     *
     * @return boolean
     * @access public
     * @since  1.0
     * @see    JTable::check
     */
    public function check()
    {
        // check required fields
        $required_fields = array('id_unidade' => 'Id Unidade', 'titular' => 'Titular', 'substituto' => 'Substituto');
        foreach($required_fields as $field => $description) {
            if(!$this->get($field)) {
                $this->setError(JText::_($description.' is required.'));
                return false;
            }
        }

        return true;
    }
}

