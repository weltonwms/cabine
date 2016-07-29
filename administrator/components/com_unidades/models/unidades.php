<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class UnidadesModelUnidades extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'nome_om',
                'sigla',
                'categoria',
                'cidade',
                'uf',
                'data_inicio',
                'data_termino'
            );
        }

        parent::__construct($config);
    }
    /*
    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }

 

    private function _loadItems() {

        $query = "SELECT * FROM `#__unidades_unidade` ";
        $nome_om = JRequest::getVar('nome_om');
        $sigla = JRequest::getVar('sigla');
        $data_inicio = JRequest::getVar('data_inicio');
        $data_termino = JRequest::getVar('data_termino');
        $categoria = JRequest::getVar('categoria');
        $cidade = JRequest::getVar('cidade');
        $uf = JRequest::getVar('uf');
        $pesquisar = JRequest::getVar('pesquisar');
        if ($pesquisar == 1) {
            $query.="WHERE nome_om LIKE '%$nome_om%' ";
            if ($data_inicio) {
                $query.="and data_aniversario >= '$data_inicio' ";
            }
            if ($data_termino) {
                $query.="and data_aniversario <= '$data_termino' ";
            }
            if ($categoria) {
                $query.="and categoria = '$categoria' ";
            }
            if ($cidade) {
                $query.="and cidade LIKE '%$cidade%' ";
            }
            if ($uf) {
                $query.="and uf = '$uf'";
            }

            if ($sigla) {
                $query.="and sigla LIKE '%$sigla%' ";
            }
        }

        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }
  * 
  */
    
    protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__unidades_unidade'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('nome_om LIKE ' . $like.' or sigla LIKE '. $like);
		}

		
		$published = $this->getState('filter.categoria');
		if ($published)
		{
                    //var_dump($published); exit();
			$query->where("categoria = '$published'");
		}
                
                $cidade = $this->getState('filter.cidade');
		if ($cidade)
		{
                   $query->where("cidade = '$cidade'");
		}
                
                 $uf = $this->getState('filter.uf');
		if ($uf)
		{
                   $query->where("uf = '$uf'");
		}
                
                $data_inicio=$this->getState('filter.data_inicio');
                if($data_inicio){
                    $query->where("data_aniversario >= '$data_inicio'");
                    
                }
                $data_termino=$this->getState('filter.data_termino');
                if($data_termino){
                    $query->where("data_aniversario <= '$data_termino'");
                    
                }
               // var_dump($this->getState('filter.data_inicio'));
                //var_dump($this->getState('filter.data_termino')); exit('saida');
		
                 

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'nome_om');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}

    public function getCidades($uf = null) {

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__unidades_ufs'));
        if ($uf):
            $query->where("uf='$uf'");
        endif;
        $query->order('cidade ASC');

        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
    }
    
    
}
