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
class unidadesViewPassagemcomando extends JViewLegacy
{
    /**
     * Display the view
     *
     * @param string $tpl Template
     *
     * @return void
     * @access public
     * @since  1.0
     */
    function display($tpl = null)
    {
        // Handle different data for different layouts
        $layout = JRequest::getVar('layout');
        $passagens= $this->get('Passagens');
        if($layout == "list") {
            $this->assign('items', $this->get('Items'));
            $this->assign('passagens',$passagens);
        } else {
            $this->assign('item', $this->get('Item'));
        }

        parent::display($tpl);
    }
}
