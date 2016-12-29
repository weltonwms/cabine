<?php
/**
 * Entry Point file for the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Entry_Point
 * @package   Notimp
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_notimp/assets/css/notimpe.css');
$controller = JControllerLegacy::getInstance('Notimp');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

