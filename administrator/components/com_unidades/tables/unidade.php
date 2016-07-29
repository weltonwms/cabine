<?php
/**
 * Unidade Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');


class JTableUnidade extends JTable
{
    
    
  
   
    public function __construct(&$db)
    {
        parent::__construct('#__unidades_unidade', 'id', $db);
    }
    
    public function bind($array, $ignore = '')
	{
            // Bind the rules.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}

		return parent::bind($array, $ignore);
	}
        
        protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_unidades.unidade.'.(int) $this->$k;
	}
        
	
        
	protected function _getAssetTitle()
	{
		return $this->sigla;
	}
        
        protected function _getAssetParentId($table = null, $id = null)
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_unidades');
		return $asset->id;
	}
        
        public function store($updateNulls = false) {
            $user=  JFactory::getUser();
            
                if(empty($this->created_by)){
                    $this->created_by=$user->get('id');
                }
            
            return parent::store($updateNulls);
        }
        
	/**
	 * Method to get the asset-parent-id of the item
	 *
	 * @return	int
	 */
        /*
	protected function _getAssetParentId(JTable $table = NULL, $id = NULL)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = JTable::getInstance('Asset');
		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// Find the parent-asset
		if (($this->catid)&& !empty($this->catid))
		{
			// The item has a category as asset-parent
			$assetParent->loadByName('com_unidades.category.' . (int) $this->catid);
		}
		else
		{
			// The item has the component as asset-parent
			$assetParent->loadByName('com_unidades');
		}

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId=$assetParent->id;
		}
		return $assetParentId;
	}
         * 
         */
    

   
}
