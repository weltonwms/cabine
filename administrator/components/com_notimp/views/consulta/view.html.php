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


class NotimpViewConsulta extends JViewLegacy {

    protected $canDo;

    function display($tpl = null) {

        
        $this->set_atributos_comuns();
       
        
        parent::display($tpl);
    }

    function set_atributos_comuns() {
        $app = JFactory::getApplication();
        $context = "notimpe.list_consulta.admin.notimpe";
        $this->items=  $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'title', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'desc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
       
        JToolBarHelper::title(JText::_('Consulta Matéria'), 'generic.png');
        NotimpHelper::addSubmenu('consulta');
       
         $this->sidebar = JHtmlSidebar::render();
        $this->canDo = NotimpHelper::getActions();
        if ($this->canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_notimp');
        }
    }

   

    

}
