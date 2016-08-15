<?php
/**
 * Entry Point file for the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Entry_Point
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'tables');

/**
 * Require the base controller
 */
require_once JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php';

// Require specific controller if requested
jimport('joomla.filesystem.file');
if($controller = JFile::makeSafe(JRequest::getWord('controller'))) {
    $path = JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

if (!JFactory::getUser()->authorise('core.manage', 'com_notimpe'))
{
    
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('NotimpeHelper', JPATH_COMPONENT . '/helpers/notimpe.php');
// Create the controller
$controller_name = 'NotimpeController'.ucfirst($controller);
$controller	= new $controller_name();
//echo $controller_name."<br><br>";
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));


// Redirect if set by the controller
$controller->redirect();
