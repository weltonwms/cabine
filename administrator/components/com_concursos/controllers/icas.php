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
        JRequest::setVar('view', 'Icas');
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
        $request=JRequest::get('post');
        if(isset($request['jform'])):
            foreach ($request['jform'] as $key=>$req):
                JRequest::setVar($key, $req);
               
            endforeach;
            
        endif;
        $arquivo = JRequest::getVar('jform', array(), 'files', 'array');
        if(isset($arquivo['name']['arquivo'])):
            JRequest::setVar('arquivo', $arquivo['name']['arquivo']);
        endif;
       
        $model = $this->getModel('Icas');
        $type="message";
        if ($model->save()) {
            $msg = JText::_('Object saved successfully!');
        } else {
            $msg = JText::_('Error: '.$model->getError());
            $type="error";
        }
        $this->setRedirect(JRoute::_('index.php?option=com_concursos&view=Icas&layout=list', false), $msg, $type);
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
        $type="message";
        $model = $this->getModel('Icas');
        if(!$model->delete()) {
            $msg = JText::_('Error: couldn\'t delete one or more objects');
             $type="error";
        } else {
            $msg = JText::_('Successfully deleted objects!');
        }
        $this->setRedirect(JRoute::_('index.php?option=com_concursos&view=Icas&layout=list', false), $msg,$type);
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
        //$msg = JText::_('Operation Aborted');
        $this->setRedirect(JRoute::_('index.php?option=com_concursos&view=Icas&layout=list', false));
    }


}
