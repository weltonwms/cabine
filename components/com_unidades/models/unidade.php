<?php
/**
 * Unidade Model of the passagemcomando Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   passagemcomando
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;


class unidadesModelUnidade extends JModelLegacy
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getItem()
    {
       
        $id = JRequest::getVar('id', "");
              
        $params = &JComponentHelper::getParams('com_unidades');
        if($id == "") {
            $id = $params->get('id');
        }
        $this->_db->setQuery("SELECT * FROM `#__unidades_unidade` WHERE `id` = $id");
        return $this->_db->loadObject();
    }

    
}
