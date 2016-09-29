<?php

/**
 * Aeronave Model of the passagemcomando Component
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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * passagemcomando Component Aeronave Model
 *
 * @category Model
 * @package  passagemcomando
 * @author   Caroline <carolinesantossin@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class aeronavesModelAeronave extends JModelLegacy {

    public function __construct() {
        parent::__construct();
    }

    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }

   
    public function getItem() {

        $id = JRequest::getVar('id', "");

        $params = JComponentHelper::getParams('com_aeronaves');
        if ($id == "") {
            $id = $params->get('id');
        }
        $query = "SELECT * from #__aeronaves_aeronave where id=$id";
        $this->_db->setQuery($query);
        $obj = $this->_db->loadObject();

        $query2 = "SELECT * from #__aeronaves_om_map o "
                . "INNER JOIN #__unidades_unidade u "
                . "ON (o.id_unidade=u.id) where o.id_aeronave=$id";
        $this->_db->setQuery($query2);
        $om = $this->_db->loadAssocList("id_unidade", 'sigla');

        $query3 = "SELECT * from #__aeronaves_tags_map t "
                . "INNER JOIN #__midia_tags m "
                . "ON (t.id_tag= m.id) where t.id_aeronave=$id";
        $this->_db->setQuery($query3);
        $tags = $this->_db->loadAssocList("id_tag", 'tag');

        $obj->unidades = $om;
        $obj->tags = $tags;
        return $obj;
    }

  
    private function _loadItems() {

        $query = "SELECT * FROM `#__aeronaves_aeronave` ";
        $aeronave = JRequest::getVar('aeronave');
        $tipo_aviacao = JRequest::getVar('tipo_aviacao');
        $pais_origem = JRequest::getVar('pais_origem');
        $paises_operacao = JRequest::getVar('paises_operacao');
        $pesquisar = JRequest::getVar('pesquisar');
        if ($pesquisar == 1) {
            $query.="WHERE aeronave LIKE '%$aeronave%' ";

            if ($tipo_aviacao) {
                $query.="and tipo_aviacao = '$tipo_aviacao' ";
            }
            if ($pais_origem) {
                $query.="and pais_origem LIKE '%$pais_origem%' ";
            }
            if ($paises_operacao) {
                $query.="and paises_operacao LIKE '%$paises_operacao%' ";
            }
        }

        $this->_items = $this->_getList($query);
        return is_null($this->_items) ? false : true;
    }

}
