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




class NotimpeControllerVeiculo extends JControllerLegacy {

    /**
     * Constructor
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct() {

        parent::__construct();

        //$this->registerTask('add', 'edit');
    }

    /**
     * Method to edit an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function add() {
        if (!$this->allowAdd()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Veiculo&layout=list', false));
            return false;
        }
        JRequest::setVar('view', 'Veiculo');
        JRequest::setVar('layout', 'edit');
        JRequest::setVar('hidemainmenu', 1);
        parent::display($cachable = false, $urlparams = array());
    }

    public function edit() {
        if (!$this->allowEdit()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Veiculo&layout=list', false));
            return false;
        }
        JRequest::setVar('view', 'Veiculo');
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
    public function save() {
        $data = $this->input->post->get('jform', array(), 'array');
        if (!$this->allowSave($data)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Veiculo&layout=list', false));
            return false;
        }
        
        $model = $this->getModel('Veiculo');
        if ($model->save($data)) {
            $msg = JText::_('Object saved successfully!');
            $type = "message";
            $layout = "default";
        } else {
            $msg = JText::_('Error: ' . $model->getError());
            $type = "error";
            $layout = "edit";
            if (isset($data['id'])):
                $layout.="&task=edit&cid[]={$data['id']}";
            endif;
        }
        $this->setRedirect(JRoute::_("index.php?option=com_notimpe&view=Veiculo&layout=$layout", false), $msg, $type);
    }

    /**
     * Method to remove an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function remove() {
        $model = $this->getModel('Veiculo');
        if (!$model->delete()) {
            $msg = $model->getError();
            $type = "error";
        } else {
            $msg = JText::_('Successfully deleted objects!');
            $type = "message";
        }
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Veiculo&layout=list', false), $msg, $type);
    }

    /**
     * Method to cancel an operation
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function cancel() {

        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Veiculo&layout=list', false));
    }

  

}
