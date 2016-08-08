<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class ConcursosModelConcursos extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
                            'id',
                            'nome',
                            'sigla',
                            'ambito',
                            'status',
                            'escola',
                            'turma',
                            'data_inscricoes'
				
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__concursos_concurso'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('nome LIKE ' . $like.' or sigla LIKE '. $like);
		}

		$veiculo = $this->getState('filter.veiculo');
		if ($veiculo)
		{
                   $query->where("veiculo = '$veiculo'");
		}
                
                $ambito = $this->getState('filter.ambito');
		if ($ambito)
		{
                   $query->where("ambito = '$ambito'");
		}
                 $escola = $this->getState('filter.escola');
		if ($escola)
		{
                   $query->where("escola = '$escola'");
		}
                 $turma = $this->getState('filter.turma');
		if ($turma)
		{
                   $query->where("turma = '$turma'");
		}
                
                $status = $this->getState('filter.status');
		if ($status)
		{
                   $query->where("status = '$status'");
		}
                
                 $data_inscricoes=$this->getState('filter.data_inscricoes');
                if($data_inscricoes){
                    $query->where("`data_inicio` <= '$data_inscricoes' AND `data_termino` >='$data_inscricoes'");
                    
                }

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'nome');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}
}