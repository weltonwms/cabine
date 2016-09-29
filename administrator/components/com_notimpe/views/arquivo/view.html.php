<?php
/**
 * Notimpe HTML View Class
 *
 * PHP versions 5
 *
 * @category  View
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * HTML View class for the Notimpe component
 *
 * @category View
 * @package  Notimpe
 * @author   Welton Moreira dos Santos <welton@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class NotimpeViewArquivo extends JViewLegacy
{
    /**
     * Display the view
     *
     * @param string $tpl Template
     *
     * @return void
     * @access public
     * @since  1.0
     */
    function display($tpl = null)
    {
        JHtmlSidebar::addEntry('Veículo','index.php?option=com_notimpe&view=veiculo',0);
        JHtmlSidebar::addEntry('Notimp','index.php?option=com_notimpe&view=notimpe',0);
	JHtmlSidebar::addEntry('Arquivo','index.php?option=com_notimpe&view=arquivo',1);
        $this->sidebar = JHtmlSidebar::render();
        
        // Set toolbar items
        JToolBarHelper::title(JText::_('Manage Notimp'), 'generic.png');

        // Handle different data for different layouts
        $layout = JRequest::getVar('layout');
        if($layout == "edit") {
             $this->assign('item', $this->get('Item'));
             $this->assign('artigos', $this->get('Artigos'));
            JToolBarHelper::save();
            JToolBarHelper::cancel();
        } else {
           JToolBarHelper::deleteList();
            JToolBarHelper::editList();
            //JToolBarHelper::addNew();
            $this->assign('items', $this->get('Items'));
        }
	if (JFactory::getUser()->authorise('core.admin', 'com_notimpe')) {
            JToolBarHelper::preferences('com_notimpe');
        }

        parent::display($tpl);
    }
}
