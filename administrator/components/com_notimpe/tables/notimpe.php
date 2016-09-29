<?php
/**
 * Notimpe Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');

/**
 * Notimpe Table Class
 *
 * @category  Table_Class
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 */
class JTableNotimpe extends JTable
{
    /**
     * @var int Primary key
     */
    var $id = null;
    
    /**
     * @var int Nr Notimpe
     */
    var $nr_notimpe = 0;

    /**
     * @var int Ano
     */
    var $ano = 0;

    /**
     * @var date Data
     */
    var $data = null;

    
    var $estado = null;

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
        parent::__construct('#__notimpe_notimpe', 'id', $db);
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
        $required_fields = array('nr_notimpe' => 'Nr Notimpe', 'ano' => 'Ano', 'data' => 'Data');
        foreach($required_fields as $field => $description) {
            if(!$this->get($field)) {
                $this->setError(JText::_($description.' is required.'));
                return false;
            }
        }

        return true;
    }
    
    
   
}
?>
