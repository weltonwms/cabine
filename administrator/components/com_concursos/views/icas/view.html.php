<?php
/**
 * Icas HTML View Class
 *
 * PHP versions 5
 *
 * @category  View
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosViewIcas extends JViewLegacy
{
   function display($tpl = null) {

        // Get application
        $app = JFactory::getApplication();
        $context = "concursos.list.admin.icas";
        // Get data from the model
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'sigla', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
       

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        // Set the submenu
        ConcursosHelper::addSubmenu('icas');
         $this->sidebar = JHtmlSidebar::render();

        // Set the toolbar and number of found items
        $this->addToolBar();

        // Display the template
        parent::display($tpl);
    }

    protected function addToolBar() {
        $title = JText::_('MANAGE ICAS');
        JToolBarHelper::title($title);
        JToolBarHelper::addNew('ica.add', 'JTOOLBAR_NEW');
        JToolBarHelper::editList('ica.edit', 'JTOOLBAR_EDIT');
        JToolBarHelper::deleteList('Deseja Realmente Apagar?', 'icas.delete', 'JTOOLBAR_DELETE');

        if (JFactory::getUser()->authorise('core.admin', 'com_concursos')) {
            JToolBarHelper::preferences('com_concursos');
        }
    }
}
