<?php
/**
 * Notimpe Controller of the Notimpe Component
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
 * Notimpe Component Notimpe Controller
 *
 * @category Controller
 * @package  Notimpe
 * @author   Welton Moreira dos Santos <welton@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class NotimpeControllerArquivo extends NotimpeController
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
       $this->registerTask('add', 'edit'); //estao vinculando o add ao edit;
        
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
        //exit('edit');
        JRequest::setVar('view', 'Arquivo');
        JRequest::setVar('layout', 'edit');
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
        
        $this->setAno();
        $model = $this->getModel('Notimpe');
        if ($model->save()) {
            $msg = JText::_('Object saved successfully!');
            $type="message";
        } else {
            $msg = JText::_('Error: '.$model->getError());
             $type="error";
        }
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=arquivo', false), $msg,$type);
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
        $model = $this->getModel('Notimpe');
        if(!$model->delete()) {
            $msg = JText::_('Error: couldn\'t delete one or more objects');
        } else {
            $msg = JText::_('Successfully deleted objects!');
        }
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=arquivo', false), $msg);
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
       // $msg = JText::_('Operation Aborted');
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=arquivo', false));
    }
    
    public function add(){
        exit('add');
    }
    
    protected function  setAno(){
        $data= JRequest::getVar('data');
        
        $array=explode("-", $data);
        
        JRequest::setVar("ano", $array[0]);
        
        
    }
    
   
            


}
