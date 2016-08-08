<?php
/**
 * Default HTML View Class
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


class ConcursosViewConcursos extends JViewLegacy
{
    
    function display($tpl = null)
    {
         // Get application
        $app = JFactory::getApplication();
        $context = "concursos.list.admin.concursos";
        // Get data from the model
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'nome', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        parent::display($tpl);
    }
}
