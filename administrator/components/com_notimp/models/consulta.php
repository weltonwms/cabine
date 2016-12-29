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

class NotimpModelConsulta extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'nome',
                'nr_notimpe',
                'id_veiculo',
                'state',
                'title',
                'created',
                'data_notimpe'
            );
        }
        parent::__construct($config);
    }

    public function getItems() {
        $items = parent::getItems();
        $nomes = array(-2 => 'Lixeira', 0 => 'Despublicado', 1 => "Publicado", 2 => "Arquivado");
        foreach ($items as $item):

            $item->nome_status = $nomes[$item->state];
        endforeach;
        return $items;
    }

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $this->getMainQuery($db);
        $this->setFiltro($query);


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'title');
        $orderDirn = $this->state->get('list.direction', 'desc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        //echo($query->__toString()); EXIT('ASD');
        return $query;
    }

    public function getTeste() {
        $db = JFactory::getDbo();
        //$query = $db->getQuery(true);
        $sql = $this->getMainQuery();
        $filtro = $this->getFiltro();
        $db->setQuery("$sql $filtro");
        echo "<pre>";
        print_r($db->loadObjectList());
    }

    private function getMainQuery($db) {

        $query = $db->getQuery(true);
        $query->select(" c.*, na.id_artigo, na.id_veiculo, na.id_notimpe, nn.nr_notimpe");
        $query->select(" nn.ano ano_notimpe, nn.data data_notimpe, nn.estado estado_notimpe ");
        $query->select("nn.oficial_servico, nn.graduado_servico, nv.nome nome_veiculo");
        $query->select("nv.imagem imagem_veiculo, nv.ordem ordem_veiculo, nv.site site_veiculo");
        $query->from("#__content c");
        $query->join("INNER", "#__notimpe_artigos na ON(na.id_artigo = c.id)");
        $query->join("INNER", "#__notimpe_notimpe nn ON(na.id_notimpe = nn.id)");
        $query->join("INNER", "#__notimpe_veiculo nv ON(na.id_veiculo = nv.id)");

        return $query;
    }

    private function setFiltro($query) {

        //captura dos filtros (ficam guardados como se fosse sessao)

        $nome = $this->getState('filter.search');
        $nr_notimpe = $this->getState('filter.nr_notimpe');
        $id_veiculo = $this->getState('filter.id_veiculo');
        $state = $this->getState('filter.state');
        $created_ini = $this->getState('filter.created_ini');
        $created_fim = $this->getState('filter.created_fim');
        

        if (!empty($nome)) {
            $query->where(" (c.introtext like '%$nome%' OR c.fulltext LIKE '%$nome%') ");
        }
        if (!empty($nr_notimpe)) {
            $query->where("nr_notimpe = '$nr_notimpe' ");
        }
        if (!empty($id_veiculo)) {
            $query->where("id_veiculo = '$id_veiculo' ");
        }

        if (is_numeric($state)) {
            $query->where('state = ' . (int) $state);
        }

        
        if ($created_ini) {
          $query->where("DATE(c.created) >= '$created_ini'");
          }
         
        if ($created_fim) {
          $query->where("DATE(c.created) <= '$created_fim'");
          }
        
    }

}
