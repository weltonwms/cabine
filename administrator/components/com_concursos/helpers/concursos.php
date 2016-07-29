<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

abstract class ConcursosHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('ICAS'),
			'index.php?option=com_concursos&view=icas',
			$vName == 'icas'
		);

		JHtmlSidebar::addEntry(
			JText::_('Concursos'),
			'index.php?option=com_concursos&view=concursos',
			$vName == 'concursos'
		);

		
	}

	
}