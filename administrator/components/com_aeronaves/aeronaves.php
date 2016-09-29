<?php


defined('_JEXEC') or die;


if (!JFactory::getUser()->authorise('core.manage', 'com_aeronaves'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Execute the task.
$controller = JControllerLegacy::getInstance('Aeronaves');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

