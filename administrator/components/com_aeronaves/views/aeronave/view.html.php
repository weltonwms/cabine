<?php

/**
 * Aeronave HTML View Class
 *
 * PHP versions 5
 *
 * @category  View
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class AeronavesViewAeronave extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        $this->set_default();
        $this->addToolBar();
        parent::display($tpl);
    }

    private function set_default() {
        //JHtml::script(JURI::base() . 'components/com_unidades/assets/js/jquery.js');
        //JHtml::script(JURI::base() . 'components/com_unidades/assets/js/jquery.mask.js');
        //JHtml::script(JURI::base() . 'components/com_unidades/assets/js/validacao.js');
        $this->assign('item', $this->get('Item'));
        $this->unidades=$this->get('Unidades');
        $this->unidadesAtribuidas= $this->get("UnidadesAssigned");
        $this->tags=$this->get('Tags');
        $this->tagsAtribuidas= $this->get("TagsAssigned");
        $this->form = $this->get('Form');
    }

    protected function addToolBar() {
        JToolBarHelper::title(JText::_('Edit Aeronave'), 'generic.png');
        JToolBarHelper::save('aeronave.save', 'JTOOLBAR_SAVE');
        JToolBarHelper::cancel('aeronave.cancel', 'Cancelar');
        if (JFactory::getUser()->authorise('core.admin', 'com_aeronaves')) {
            JToolBarHelper::preferences('com_aeronaves');
        }
    }

}
