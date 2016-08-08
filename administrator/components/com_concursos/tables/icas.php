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
   
    
    public function __construct(&$db)
    {
        parent::__construct('#__concursos_icas', 'id', $db);
    }
    public function store($updateNulls = false) {
        $this->ano=JHtml::_('date',  $this->data,'Y');
        $this->data=JHtml::_('date',  $this->data,'Y-m-d');
       
        return parent::store($updateNulls);
        }
    

    
}

