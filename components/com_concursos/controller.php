<?php
/**
 * Base Controller of the Concursos Component
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

jimport('joomla.application.component.controller');

/**
 * Concursos Component Controller
 *
 * @category Controller
 * @package  Concursos
 * @author   Welton Moreira dos Santos <weltonwms@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0.0
 */
class ConcursosController extends JControllerLegacy
{
    /**
     * Method to show administrator
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function display($cachable = false, $urlparams = array())
    {
        parent::display($cachable = false, $urlparams = array());
    }
}