<?php

/**
 * Veiculo Controller of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Controller
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');




class NotimpControllerVeiculos extends JControllerAdmin {

    
    public function __construct() {

        parent::__construct();

    }

    
    public function getModel($name = 'Veiculo', $prefix = 'NotimpModel', $config = array()) {
        return parent::getModel($name, $prefix, $config);
    }
  

}
