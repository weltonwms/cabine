<?php


defined('_JEXEC') or die;


class UnidadesModelUnidades extends JModelList {

    public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
                            'id',
                            'nome_om',
                            'sigla',
                            'uf',
                            'categoria'
                           
				
			);
		}

		parent::__construct($config);
	}
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

		$categoria = $this->getState('filter.categoria');
		if ($categoria)
		{
                    //var_dump($published); exit();
			$query->where("categoria = '$categoria'");
		}
                
                $uf = $this->getState('filter.uf');
		if ($uf)
		{
                   $query->where("uf = '$uf'");
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'nome_om');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
                //echo "<pre>"; print_r($query); exit();
		return $query;
	}

        

}
