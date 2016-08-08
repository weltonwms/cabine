<?php
/**
 * Entry Point file for the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Entry_Point
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Concursos');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();