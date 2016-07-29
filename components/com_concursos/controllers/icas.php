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

jimport('joomla.application.component.controller');

/**
 * Concursos Component Icas Controller
 *
 * @category Controller
 * @package  Concursos
 * @author   Welton Moreira dos Santos <weltonwms@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class ConcursosControllerIcas extends ConcursosController
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
     * Method to save an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function save()
    {
        JRequest::checkToken() or jexit('Invalid Token');
        $model = $this->getModel('Icas');
        if ($model->save()) {
            $msg = JText::_('Object created successfully!');
            $url = 'index.php?option=com_concursos&view=Icas&layout=list';
        } else {
            $msg = JText::_('Error while created object: '.$model->getError());
            $url = 'index.php?option=com_concursos&view=Icas&layout=new';
        }
        $this->setRedirect(JRoute::_($url), $msg);
    }
}
