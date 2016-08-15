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
class NotimpeController extends JControllerLegacy
{
    protected $default_view = 'notimpe';
    public $option="com_notimpe";
            
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
    
     protected function allowAdd() {
        $user = JFactory::getUser();
        return ($user->authorise('core.create', $this->option) || count($user->getAuthorisedCategories($this->option, 'core.create')));
    }

    protected function allowEdit() {
        $user = JFactory::getUser();
        return $user->authorise('core.edit', $this->option);
    }
    
    protected function allowSave($data, $key = 'id')
	{
		$recordId = isset($data[$key]) ? $data[$key] : '0';
		if ($recordId)
		{
			return $this->allowEdit($data, $key);
		}
		else
		{
			return $this->allowAdd($data);
		}
	}
    
    
}