<?php

/**
 * Notimpe Model of the Notimpe Component
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
$com_path = JPATH_ADMINISTRATOR . '/components/com_content/';

JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');

class NotimpModelNotimps extends JModelList {

   
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'nr_notimpe',
                'oficial_servico',
                'graduado_servico',
                'status',
                'data',
                'ano'
            );
        }
        parent::__construct($config);
        
    }

   
    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $wheres = array('estado' => "estado != 2");
        $where = '';

        //captura dos filtros (ficam guardados como se fosse sessao)
        $nr_notimpe = $this->getState('filter.search');
        $data = $this->getState('filter.data');
        $ano = $this->getState('filter.ano');
        $estado = $this->getState('filter.status');
        $oficial_servico = $this->getState('filter.oficial_servico');
        $graduado_servico = $this->getState('filter.graduado_servico');

        if ($estado != '') {
            $wheres['estado'] = "estado = '$estado' ";
        }
        if (!empty($oficial_servico)) {
            $wheres[] = "oficial_servico = '$oficial_servico'";
        }
        if (!empty($graduado_servico)) {
            $wheres[] = "graduado_servico = '$graduado_servico'";
        }
        if (!empty($nr_notimpe)) {
            $wheres[] = "nr_notimpe = '$nr_notimpe' ";
        }
        if (!empty($data)) {
            $wheres[] = "data = '$data' ";
        }
        if (!empty($ano)) {
            $wheres[] = "ano = '$ano' ";
        }

        //implodindo o array para string no formato sql
        if (count($wheres) > 0) {
            $where = implode(' and ', $wheres);
        }

        $query->select("n.id, n.nr_notimpe, n.ano, n.data, n.estado, n.oficial_servico,
            n.graduado_servico, u.name AS oficial_name, u.username AS oficial_username,
            ug.name AS graduado_name, ug.username AS graduado_username");
        $query->from("#__notimpe_notimpe n");
        $query->join("LEFT", "#__users u ON n.oficial_servico = u.id");
        $query->join("LEFT", "#__users ug ON n.graduado_servico = ug.id");
        $query->where($where);
        $orderCol = $this->state->get('list.ordering', 'n.data');
        $orderDirn = $this->state->get('list.direction', 'DESC');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));


        return $query;
    }

 
}
