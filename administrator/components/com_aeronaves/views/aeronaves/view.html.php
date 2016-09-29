<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class AeronavesViewAeronaves extends JViewLegacy {

    function display($tpl = null) {
        $this->set_default();
        $this->addToolBar();
        $this->items	= $this->get('Items');
        //echo "<pre>"; print_r($this->items);echo "</pre>";
        parent::display($tpl);
    }

    private function set_default() {
        //UnidadesHelper::addSubmenu('aeronaves');
        // Get application
        $app = JFactory::getApplication();
        $context = "aeronaves.list.admin.aeronaves";
        // Get data from the model

        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'greeting', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->sidebar = JHtmlSidebar::render();


        JToolBarHelper::title(JText::_('Manage Aeronaves'), 'generic.png');
    }

    protected function addToolBar() {
        if (JFactory::getUser()->authorise('core.admin', 'com_aeronaves')) {
            JToolBarHelper::preferences('com_aeronaves');
        }
        JToolBarHelper::deleteList('Você tem certeza?', 'aeronaves.delete', 'JTOOLBAR_DELETE');
        JToolBarHelper::editList('aeronave.edit', 'JTOOLBAR_EDIT');
        JToolBarHelper::addNew('aeronave.add', 'JTOOLBAR_NEW');
    }

}
