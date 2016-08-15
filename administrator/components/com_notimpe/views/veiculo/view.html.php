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

jimport('joomla.application.component.view');

class NotimpeViewVeiculo extends JViewLegacy {

    protected $form = null;
    protected $canDo;

    function display($tpl = null) {
        $this->set_atributos_default();
        // Handle different data for different layouts
        $layout = JRequest::getVar('layout');
        switch ($layout):
            case "edit":$this->display_edit();
                break;
            default:$this->display_defaut();
        endswitch;



        parent::display($tpl);
    }

    protected function set_atributos_default() {
        JToolBarHelper::title(JText::_('Manage Veiculo'), 'generic.png');
        NotimpeHelper::addSubmenu('veiculo');
        $this->canDo = NotimpeHelper::getActions();
        //echo "<pre>"; print_r($canDo); exit();
        if ($this->canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_notimpe');
        }

        
    }

    protected function display_edit() {
        $this->form = $this->get('Form');
        $this->assign('item', $this->get('Item'));
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.create')):
            JToolBarHelper::save();
        endif;
        JToolBarHelper::cancel();
    }

    protected function display_defaut() {
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
        //echo "<pre>";print_r($this->activeFilters);echo "</pre>";
    }

}
