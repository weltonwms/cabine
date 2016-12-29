<?php

/**
 * Veiculo Model of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class NotimpModelVeiculos extends JModelList {

    /**
     * Constructor
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'nome',
                'cidade',
                'estado',
            );
        }
        parent::__construct($config);
    }

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("*");
        $query->from("#__notimpe_veiculo");

        //captura dos filtros (ficam guardados como se fosse sessao)
        $nome = $this->getState('filter.search');
        $estado = $this->getState('filter.estado');
        $cidade = $this->getState('filter.cidade');

        if (!empty($nome)) {
            $query->where("nome like '%$nome%' ");
        }
        if (!empty($estado)) {
            $query->where("estado = '$estado' ");
        }
        if (!empty($cidade)) {
            $query->where("cidade = '$cidade' ");
        }
        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'ordem');
        $orderDirn = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));



        return $query;
    }

   

    
   

}
