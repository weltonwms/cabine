<?php
/**
 * Icas HTML View Class
 *
 * PHP versions 5
 *
 * @category  View
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosViewIca extends JViewLegacy
{
    protected $form = null;
   
   
    function display($tpl = null)
    {
        $this->set_default();
        $this->addToolBar();
        $this->assign('item', $this->get('Item'));
        parent::display($tpl);
    }
    
    private function set_default(){
        
        $this->form= $this->get('Form');
        
        
       
    }
    
    protected function addToolBar()
    {
         JToolBarHelper::title(JText::_('Edit ICA'), 'generic.png');
          JToolBarHelper::save('ica.save', 'JTOOLBAR_SAVE');
          JToolBarHelper::cancel('ica.cancel', 'Cancelar');
          if (JFactory::getUser()->authorise('core.admin', 'com_concursos')) {
            JToolBarHelper::preferences('com_concursos');
        }
        
    }
}
