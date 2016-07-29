<?php

/**
 * Icas Model of the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosModelIcas extends JModelList {

    public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
                            'id',
                            'sigla',
                            'referencia',
                            'descricao',
                            'ano'
                           
				
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
			  ->from($db->quoteName('#__concursos_icas'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('descricao LIKE ' . $like.' or sigla LIKE '. $like);
		}

		$ano = $this->getState('filter.ano');
		if ($ano)
		{
                   $query->where("ano = '$ano'");
		}
                
                $referencia = $this->getState('filter.referencia');
		if ($referencia)
		{
                   $query->where("referencia = '$referencia'");
		}
                
                
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'sigla');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}

}
