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




class NotimpViewNotimps extends JViewLegacy {

   
    function display($tpl = null) {
       $this->display_edicoes_anteriores();
        parent::display($tpl);
    }

    protected function display_edicoes_anteriores() {
         $this->assign('anoAtivo', $this->get('AnoAtivo'));
        $this->assign('notimps', $this->get('Notimps'));
        $this->assign('anos', $this->get('Anos'));
      
       
    }

   

}
