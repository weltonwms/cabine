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


class NotimpViewVeiculo extends JViewLegacy {

    protected $form = null;
    protected $canDo;

    function display($tpl = null) {
        $this->set_atributos_default();
        $this->display_edit();
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

    protected function display_edit() {
        $this->form = $this->get('Form');
        $this->assign('item', $this->get('Item'));
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.create')):
            JToolBarHelper::save('veiculo.save', 'JTOOLBAR_SAVE');
        endif;
        JToolBarHelper::cancel('veiculo.cancel', 'JTOOLBAR_CANCEL');
    }

    

}
