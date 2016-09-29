<?php
/**
 * Entry Point file for the passagemcomando Component
 *
 * PHP versions 5
 *
 * @category  Entry_Point
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

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

// Create the controller
$controller_name = 'aeronavesController'.ucfirst($controller);
$controller	= new $controller_name();

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
