<?php

/**
 * Base Controller of the Notimpe Component
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

jimport('joomla.application.component.controller');

/**
 * Notimpe Component Controller
 *
 * @category Controller
 * @package  Notimpe
 * @author   Welton Moreira dos Santos <welton@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0.0
 */
class NotimpeController extends JControllerLegacy {

    function __construct($config = array()) {
        parent::__construct($config);
        
        
    }

    public function display($cachable = false, $urlparams = array()) {
        
        $document = JFactory::getDocument();
        $document->addStyleSheet('components/com_notimpe/assets/css/notimpe.css');
        parent::display($cachable = false, $urlparams = array());
    }

}
