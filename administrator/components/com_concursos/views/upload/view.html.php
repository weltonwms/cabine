<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosViewUpload extends JViewLegacy
{
    protected $form = null;
   
   
    function display($tpl = null)
    {
       JToolBarHelper::title(JText::_('Manage Upload'), 'generic.png');
        if(!JFactory::getUser()->authorise("core.create","com_media")):
            JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_'.strtoupper("create").'_NOT_PERMITTED'));
            return false;
        endif;
       
        parent::display($tpl);
    }
    
   
    
   
}
