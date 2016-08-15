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

class NotimpeViewNotimpe extends JViewLegacy {

    protected $canDo;

    function display($tpl = null) {
        $this->set_atributos_comuns();
        // Handle different data for different layouts
        $layout = JRequest::getVar('layout');
        switch ($layout):
            case "edit": $this->display_edit();
                break;
            default : $this->display_default();
        endswitch;
        parent::display($tpl);
    }

    function set_atributos_comuns() {
        JToolBarHelper::title(JText::_('Manage Notimp'), 'generic.png');
        NotimpeHelper::addSubmenu('notimp');
        $this->canDo = NotimpeHelper::getActions();

        if ($this->canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_notimpe');
        }
    }

    function display_edit() {
        $this->assign('nr_auto', $this->get('UltimoNotimpe'));
        $this->assign('data_atual', date('Y-m-d'));
        $this->assign('grupo_oficiais', $this->get('GrupoOficiais'));
        $this->assign('grupo_graduados', $this->get('GrupoGraduados'));
        $this->assign('item', $this->get('Item'));
        $this->assign('artigos', $this->get('Artigos'));
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.create')):
            JToolBarHelper::save();
        endif;

        JToolBarHelper::cancel();
        if ($this->canDo->get('core.delete') && $this->canDo->get('core.edit') && $this->item->id):
            JToolBarHelper::deleteList('Deseja Realmente Desvincular Todos Artigos?', 'apagar_artigos', 'Desvincular Artigos do Notimp');
        endif;
    }

    function display_default() {
        $this->assign('items', $this->get('Items'));
        if ($this->canDo->get('core.create')):
            JToolBarHelper::addNew();
        endif;
        if ($this->canDo->get('core.edit')):
            JToolBarHelper::editList();
        endif;
        if ($this->canDo->get('core.delete')):
            JToolBarHelper::deleteList();
        endif;
        $this->sidebar = JHtmlSidebar::render();
        $this->state = $this->get('State');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->filterForm = $this->get('FilterForm');
       
    }

}
