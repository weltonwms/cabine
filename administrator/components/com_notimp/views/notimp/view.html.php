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


class NotimpViewNotimp extends JViewLegacy {

    protected $canDo;

    function display($tpl = null) {
        $this->set_atributos();
        $this->set_toobars();

        parent::display($tpl);
    }

    function set_atributos() {
        JToolBarHelper::title(JText::_('Edit Notimp'), 'generic.png');
        NotimpHelper::addSubmenu('notimp');
        $this->canDo = NotimpHelper::getActions();
        $this->form = $this->get('Form');
       if(empty($this->form->getValue('id'))):
           $ultimoNotimp=  $this->get('UltimoNotimp');
           $this->form->setValue('nr_notimpe',null,$ultimoNotimp);
       endif;
       $this->assign('item', $this->get('Item'));
       $this->assign('artigos', $this->get('Artigos'));

       
    }

    function set_toobars() {
         if ($this->canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_notimp');
        }
               
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.create')):
            JToolBarHelper::save('notimp.save', 'JTOOLBAR_SAVE');
        endif;

       JToolBarHelper::cancel('notimp.cancel', 'JTOOLBAR_CANCEL');
        if ($this->canDo->get('core.delete') && $this->canDo->get('core.edit') && $this->item->id):
            JToolBarHelper::deleteList('Deseja Realmente Desvincular Todos Artigos?', 'notimp.apagar_artigos', 'Desvincular Artigos do Notimp');
        endif;
    }

}
