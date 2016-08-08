<?php

/**
 * Concurso Model of the Concursos Component
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


class ConcursosModelConcursos extends JModelList {

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
                            'data_inscricoes'
				
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
			  ->from($db->quoteName('#__concursos_concurso'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('nome LIKE ' . $like.' or sigla LIKE '. $like);
		}

		$escola = $this->getState('filter.escola');
		if ($escola)
		{
                   $query->where("escola = '$escola'");
		}
                
               
                
                $status = $this->getState('filter.status');
		if ($status)
		{
                   $query->where("status = '$status'");
		}
                
                

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'nome');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}

   /*
    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }
    * 
    */
   

   
   

    /*
    private function _loadItems() {
        $query = "SELECT * FROM `#__concursos_concurso`";
         $pesquisar= JRequest::getVar('pesquisar');
         
        if($pesquisar){
            $sigla= JRequest::getVar('sigla');
            $escola= JRequest::getVar('escola');
            $nome= JRequest::getVar('nome');
            $status= JRequest::getVar('status');
           $query.=" WHERE `sigla` LIKE '%$sigla%'";
           if($escola){
               $query.=" AND `escola` LIKE '%$escola%'";
           }
           if($nome){
                $query.=" AND `nome` LIKE '%$nome%'";
           }
           if($status){
               
                $query.=" AND `status` = $status";
           }
         
        }
        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }
     * 
     */

}
