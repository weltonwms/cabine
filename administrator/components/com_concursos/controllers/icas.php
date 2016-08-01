<?php
/**
 * Icas Controller of the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Controller
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosControllerIcas extends JControllerAdmin
{
    
    public function __construct()
    {
        parent::__construct();
        
        
    }
    
    public function getModel($name = 'Ica', $prefix = 'ConcursosModel', $config = array()) {
        return parent::getModel($name, $prefix, $config);
    }

    


}
