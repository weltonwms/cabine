<?php
/**
 * Icas Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');

/**
 * Icas Table Class
 *
 * @category  Table_Class
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 */
class JTableIcas extends JTable
{
   
    var $id = null;
    
   
    var $sigla = '';
    
    var $arquivo = '';

    
    var $descricao = '';

   
    var $referencia = '';

    
    var $ano = null;

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
        parent::__construct('#__concursos_icas', 'id', $db);
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
        $required_fields = array('sigla' => 'Sigla', 'descricao' => 'Descricao', 'referencia' => 'Referencia', 'ano' => 'Ano');
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
