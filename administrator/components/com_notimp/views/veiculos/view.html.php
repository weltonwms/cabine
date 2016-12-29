<?php

/**
 * Veiculo HTML View Class
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

class NotimpViewVeiculos extends JViewLegacy {

    protected $form = null;
    protected $canDo;

    function display($tpl = null) {
        $this->set_atributos_default();
        $this->display_defaut();

        parent::display($tpl);
    }

    protected function set_atributos_default() {
        JToolBarHelper::title(JText::_('Manager Veiculo'), 'generic.png');
        NotimpHelper::addSubmenu('veiculo');
        $this->canDo = NotimpHelper::getActions();

        if ($this->canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_notimp');
        }
    }

    protected function display_defaut() {

        if ($this->canDo->get('core.create')):
            JToolBarHelper::addNew('veiculo.add', 'JTOOLBAR_NEW');
        endif;
        if ($this->canDo->get('core.edit')):
            JToolBarHelper::editList('veiculo.edit', 'JTOOLBAR_EDIT');
        endif;
        if ($this->canDo->get('core.delete')):
            JToolBarHelper::deleteList('Vc tem Certeza?', 'veiculos.delete', 'JTOOLBAR_DELETE');
        endif;
        $this->sidebar = JHtmlSidebar::render();
        $app = JFactory::getApplication();
        $context = "notimp.list.admin.veiculo";
        // Get data from the model
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'ordem', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
    }

}
