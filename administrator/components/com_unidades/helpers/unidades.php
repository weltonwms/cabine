<?php

class UnidadesHelper extends JHelperContent
{
   public static function addSubmenu($submenu) 
	{
       
		JHtmlSidebar::addEntry(
			JText::_('Unidade'),
			'index.php?option=com_unidades',
			$submenu == 'unidades'
		);

		JHtmlSidebar::addEntry(
			JText::_('Passagem Comando'),
			'index.php?option=com_unidades&view=passagemcomando&layout=list',
			$submenu == 'passagem'
		);
                
               

		
	}
}