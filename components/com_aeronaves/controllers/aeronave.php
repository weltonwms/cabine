<?php
/**
 * Aeronave Controller of the passagemcomando Component
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
 * passagemcomando Component Aeronave Controller
 *
 * @category Controller
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class aeronavesControllerAeronave extends aeronavesController
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
        $model = $this->getModel('Aeronave');
        if ($model->save()) {
            $msg = JText::_('Object created successfully!');
            $url = 'index.php?option=com_aeronaves&view=Aeronave&layout=list';
        } else {
            $msg = JText::_('Error while created object: '.$model->getError());
            $url = 'index.php?option=com_aeronaves&view=Aeronave&layout=new';
        }
        $this->setRedirect(JRoute::_($url), $msg);
    }
}
