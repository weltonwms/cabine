<?php

/**
 * Unidade HTML View Class
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
defined('_JEXEC') or die;

class UnidadesViewUnidade extends JViewLegacy {

    function display($tpl = null) {
        $this->setLayout("details");
        $this->assign('item', $this->get('Item'));
        parent::display($tpl);
    }

}
