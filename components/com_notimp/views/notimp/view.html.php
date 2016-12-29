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



class NotimpViewNotimp extends JViewLegacy {

    function display($tpl = null) {
        $this->set_default();
        parent::display($tpl);
    }

    protected function set_default() {
        JPluginHelper::importPlugin('content');
        $dispatcher = JEventDispatcher::getInstance();
        $this->assign('item', $this->get('Item'));
        if ($this->item):
            $dispatcher->trigger('onContentPrepareNotimp', array(&$this->item));
        endif;
    }

}
