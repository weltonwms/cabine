<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class UnidadesViewUnidades extends JViewLegacy {

    function display($tpl = null) {
        $this->set_default();
        $this->addToolBar();
        $this->items	= $this->get('Items');
        parent::display($tpl);
    }

    private function set_default() {
        UnidadesHelper::addSubmenu('unidades');
        // Get application
        $app = JFactory::getApplication();
        $context = "unidades.list.admin.unidades";
        // Get data from the model

        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'greeting', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->sidebar = JHtmlSidebar::render();


        JToolBarHelper::title(JText::_('Manage Unidades'), 'generic.png');
    }

    protected function addToolBar() {
        if (JFactory::getUser()->authorise('core.admin', 'com_unidades')) {
            JToolBarHelper::preferences('com_unidades');
        }
        JToolBarHelper::deleteList('Você tem certeza?', 'unidades.delete', 'JTOOLBAR_DELETE');
        JToolBarHelper::editList('unidade.edit', 'JTOOLBAR_EDIT');
        JToolBarHelper::addNew('unidade.add', 'JTOOLBAR_NEW');
    }

}
