<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class AeronavesModelAeronaves extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'tipo_aviacao',
                'aeronave',
                'pais_origem',
                'paises_operacao',
                'link'
                
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
			  ->from($db->quoteName('#__aeronaves_aeronave'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('aeronave LIKE ' . $like.' or pais_origem LIKE '. $like.' or paises_operacao LIKE '. $like);
		}
                $tipo_aviacao = $this->getState('filter.tipo_aviacao');
		if ($tipo_aviacao)
		{
                   $query->where("tipo_aviacao = '$tipo_aviacao'");
		}

		
                 

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'aeronave');
		$orderDirn 	= $this->state->get('list.direction', 'asc'); 

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
                //echo "<pre>"; print_r($query); exit();
		return $query;
	}

   
    
    
}
