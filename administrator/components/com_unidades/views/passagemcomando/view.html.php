<?php

/**
 * Passagemcomando HTML View Class
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

jimport('joomla.application.component.view');

/**
 * HTML View class for the passagemcomando component
 *
 * @category View
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class unidadesViewPassagemcomando extends JViewLegacy {

    /**
     * Display the view
     *
     * @param string $tpl Template
     *
     * @return void
     * @access public
     * @since  1.0
     */
    function display($tpl = null) {

        // Set toolbar items
        JToolBarHelper::title(JText::_('Manage Passagemcomando'), 'generic.png');

        // Handle different data for different layouts
        $layout = JRequest::getVar('layout');

        if ($layout == "list") {
            UnidadesHelper::addSubmenu('passagem');
            $this->sidebar = JHtmlSidebar::render();
            JToolBarHelper::deleteList('Você tem certeza?', 'passagemcomando.remove', 'JTOOLBAR_DELETE');
            JToolBarHelper::editList('passagemcomando.edit', 'JTOOLBAR_EDIT');
            JToolBarHelper::addNew('passagemcomando.add', 'JTOOLBAR_NEW');

            $this->assign('items', $this->get('Items'));
            //$this->assign('unidades', $this->get('UnidadesAssoc'));
        } else {
            $this->assign('unidades', $this->get('Unidades'));
            $this->assign('item', $this->get('Item'));


            JToolBarHelper::save('passagemcomando.save', 'JTOOLBAR_SAVE');
            JToolBarHelper::cancel('passagemcomando.cancel', 'Cancelar');
        }
        if (JFactory::getUser()->authorise('core.admin', 'com_unidades')) {
            JToolBarHelper::preferences('com_unidades');
        }

        parent::display($tpl);
    }

}
