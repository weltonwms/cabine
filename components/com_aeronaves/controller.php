<?php
/**
 * Base Controller of the passagemcomando Component
 *
 * PHP versions 5
 *
 * @category  Controller
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * passagemcomando Component Controller
 *
 * @category Controller
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0.0
 */
class aeronavesController extends JControllerLegacy
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
