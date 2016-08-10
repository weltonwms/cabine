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

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Unidades');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();