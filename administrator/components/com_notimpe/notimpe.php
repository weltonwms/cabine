<?php
// 16 AGO 2016
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


$document = JFactory::getDocument();

if (!JFactory::getUser()->authorise('core.manage', 'com_notimpe'))
{
    
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
// require helper file
JLoader::register('NotimpeHelper', JPATH_COMPONENT . '/helpers/notimpe.php');


$controller = JControllerLegacy::getInstance('Notimpe');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
