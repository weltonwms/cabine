<?php
/**
 * Passagemcomando Controller of the passagemcomando Component
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
 * passagemcomando Component Passagemcomando Controller
 *
 * @category Controller
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class UnidadesControllerPassagemcomando extends JControllerLegacy
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
        $this->registerTask('add', 'edit');
        
    }

    /**
     * Method to edit an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function edit()
    {
        JRequest::setVar('view', 'Passagemcomando');
        JRequest::setVar('hidemainmenu', 1);
        parent::display($cachable = false, $urlparams = array());
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
        $model = $this->getModel('Passagemcomando');
        if ($model->save()) {
            $msg = JText::_('Object saved successfully!');
        } else {
            $msg = JText::_('Error: '.$model->getError());
        }
        $this->setRedirect(JRoute::_('index.php?option=com_unidades&view=Passagemcomando&layout=list', false), $msg);
    }

    /**
     * Method to remove an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function remove()
    {
        $model = $this->getModel('Passagemcomando');
        if(!$model->delete()) {
            $msg = JText::_('Error: couldn\'t delete one or more objects');
        } else {
            $msg = JText::_('Successfully deleted objects!');
        }
        $this->setRedirect(JRoute::_('index.php?option=com_unidades&view=Passagemcomando&layout=list', false), $msg);
    }

    /**
     * Method to cancel an operation
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function cancel()
    {
        $msg = JText::_('Operation Aborted');
        $this->setRedirect(JRoute::_('index.php?option=com_unidades&view=Passagemcomando&layout=list', false), $msg);
    }


}
