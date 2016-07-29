<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class UnidadesViewUnidade extends JViewLegacy
{
    
    protected $form =null;
   
    
    
    function display($tpl = null)
    {
        $this->set_default();
        $this->addToolBar();
        $this->assign('item', $this->get('Item'));
        parent::display($tpl);
    }
    
    private function set_default(){
        JHtml::script(JURI::base(). 'components/com_unidades/assets/js/jquery.js');
	JHtml::script(JURI::base(). 'components/com_unidades/assets/js/jquery.mask.js');
        JHtml::script(JURI::base(). 'components/com_unidades/assets/js/validacao.js');
        $this->form= $this->get('Form');
        
        
       
    }
    
    protected function addToolBar()
    {
         JToolBarHelper::title(JText::_('Edit Unidade'), 'generic.png');
          JToolBarHelper::save('unidade.save', 'JTOOLBAR_SAVE');
          JToolBarHelper::cancel('unidade.cancel', 'Cancelar');
          if (JFactory::getUser()->authorise('core.admin', 'com_unidades')) {
            JToolBarHelper::preferences('com_unidades');
        }
        
    }
}
