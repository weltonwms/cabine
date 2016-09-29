<?php

/**
 * Default HTML View Class
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


class NotimpeViewPrincipal extends JViewLegacy {

   
    function display($tpl = null) {
        $layout = JRequest::getVar('layout');
        switch ($layout):
            case "edicoes_anteriores": $this->display_edicoes_anteriores();
                break;
            default : $this->display_default();
        endswitch;
        parent::display($tpl);
    }

    protected function display_edicoes_anteriores() {
        $notimpes = $this->get('Notimpes');
        $this->assign('notimpes', $notimpes);
        $ano_notimpe = JRequest::getVar('ano_notimpe');
        if (!$ano_notimpe) :
            $ano_notimpe = date('Y');
        endif;

        $this->assign('ano_notimpe', $ano_notimpe);
        $this->assign('anos', $this->get('Anos'));
    }

    protected function display_default() {
        JPluginHelper::importPlugin('content');
        $dispatcher = JEventDispatcher::getInstance();
        if (!JRequest::getVar("id")) :
            $id_ultimo_notimpe = $this->get('UltimoNotimpe');
            JRequest::setVar('id', $id_ultimo_notimpe);
        endif;

        $this->assign('dados_notimpe', $this->get('InformacoesNotimpe'));
        $this->assign('veiculos', $this->get('InformacoesVeiculo'));
        $this->assign('items', $this->get('ArtigosNotimpe'));
        $dispatcher->trigger('onContentPrepareNotimp', array(&$this->items));
    }

}
