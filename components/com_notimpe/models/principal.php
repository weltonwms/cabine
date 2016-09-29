<?php

/**
 * Notimpe Model of the Notimpe Component
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
$com_path = JPATH_SITE . '/components/com_content/';

JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');
jimport('joomla.application.component.model');

/**
 * Notimpe Component Notimpe Model
 *
 * @category Model
 * @package  Notimpe
 * @author   Welton Moreira dos Santos <welton@gmail.com>
 * @license  GNU General Public License
 * @link     
 * @since    1.0
 */
class NotimpeModelPrincipal extends JModelLegacy {

    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method to get data
     *
     * @return object Items data
     * @access public
     * @since  1.0
     */
    public function getItems() {
        if (empty($this->_items)) {
            // Load the items
            $this->_loadItems();
        }
        return $this->_items;
    }

    /**
     * Method to load data from a specific item
     *
     * @return object Item data
     * @access public
     * @since  1.0
     */
    public function getItem() {
        $id = JRequest::getVar('id', "");
        $params = &JComponentHelper::getParams('com_notimpe');
        if ($id == "") {
            $id = $params->get('id');
        }
        $this->_db->setQuery("SELECT * FROM `#__notimpe_notimpe` WHERE `id` = $id");
        return $this->_db->loadObject();
    }

    /**
     * Method to save an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function save() {
        $row = & $this->getTable('Notimpe', 'JTable');
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->check()) {
            $this->setError($row->getError());
            return false;
        }

        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }

    /**
     * Method to load data
     *
     * @return boolean
     * @access private
     * @since  1.0
     */
    private function _loadItems() {
        $this->_items = $this->_getList('SELECT * FROM `#__notimpe_notimpe`');
        return is_null($this->_items) ? false : true;
    }

    public function getArtigosNotimpe() {
	
        $nr_notimpe = JRequest::getVar('id', "");
	$artigos_agrupados=array();
	if($nr_notimpe):
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_artigos'));
        $query->where("id_notimpe=$nr_notimpe");

        $db->setQuery($query);
        $results = $db->loadObjectList();
        $array_arts = array();
        foreach ($results as $result):
            $array_arts[] = $result->id_artigo;
        endforeach;

        $artigos_joomla = $this->capturarArtigosJoomla($array_arts);

        foreach ($artigos_joomla as $artigo_joomla):
            foreach ($results as $result):
                if ($result->id_artigo == $artigo_joomla->id) {
                    $artigo_joomla->id_veiculo = $result->id_veiculo;
                    $artigo_joomla->id_notimpe = $result->id_notimpe;
                    $artigo_joomla->id_artigo = $result->id_artigo;
                }
            endforeach;

        endforeach;
        $artigos_agrupados = $this->agruparArtigosPorVeiculo($artigos_joomla);
	endif;
        return $artigos_agrupados;
    }

    protected function capturarArtigosJoomla(array $artigos) {
        if ($artigos):
            $articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

            // Set application parameters in model
            $app = JFactory::getApplication();
            $appParams = $app->getParams();
            
            $articles->setState('params', $appParams);
            $articles->setState('filter.article_id', $artigos);
            $articles->setState('filter.published',1);
            
            //fiter acess
            $access     = !JComponentHelper::getParams('com_content')->get('show_noauth');
            $articles->setState('filter.access', $access);
            //fim acess
            
            return ($articles->getItems());

        endif;
        return array();
    }

    public function getInformacoesNotimpe() {
        $id_notimpe = JRequest::getVar('id', "");
	if($id_notimpe):
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("id=$id_notimpe");

        $db->setQuery($query);
        $results = $db->loadObjectList();
        
        return $results[0];
	endif;
    }
    
    protected function agruparArtigosPorVeiculo($artigos_joomla) {
        if ($artigos_joomla):
            $lista = array();
            $veiculos = array();
            $cont = 0;
            foreach ($artigos_joomla as $artigo_joomla):
                if (!in_array($artigo_joomla->id_veiculo, $veiculos)) {
                    $veiculos[$cont] = $artigo_joomla->id_veiculo;

                    $lista[$veiculos[$cont]][] = $artigo_joomla;
                    $cont++;
                } else {
                    $lista[$artigo_joomla->id_veiculo][] = $artigo_joomla;
                }
            endforeach;
            return $this->organizarArtigos($lista);
            
        endif;
        return array();
    }
    
    protected function organizarArtigos($lista){
        $dados_veiculos= $this->getInformacoesVeiculo();
        $nova_lista= array();
        //echo "<pre>"; print_r($lista); exit();
        foreach ($lista as $key=>$list):
            $veic=new stdClass();
            $veic->id_veiculo=$key;
            $veic->ordem=isset($dados_veiculos[$key])?$dados_veiculos[$key]['ordem']:'';
            $veic->nome_veiculo=isset($dados_veiculos[$key])?$dados_veiculos[$key]['nome']:'';
            $veic->imagem_veiculo=isset($dados_veiculos[$key])?$dados_veiculos[$key]['imagem']:'';
            $veic->artigos_veiculo=$list;
            $nova_lista[]= $veic;
           
        endforeach;
        return $this->ordenarLista($nova_lista);
       
    }
    
    /*
     * o método ordenarLista ordena um array com objetos stdClass representando
     * um veículo que possui seus artigos. a função usorte utiliza a função 
     * compara_veiculos que se baseia no atributo ordem do objeto stdClass.
     */
    protected function ordenarLista($lista){
         usort($lista, "compara_veiculos");
         return $lista;
    }

        public function getInformacoesVeiculo(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_veiculo'));
        $db->setQuery($query);
        $results = $db->loadAssocList('id');
        return $results;
    }


    public function teste(){
        JLoader::register('NotimpeModelConta', 'components/com_notimpe/models/conta.php');
        return new NotimpeModelConta();
    }
    
    public function getUltimoNotimpe(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("estado=1");
        $query->order('data DESC');
        
        $db->setQuery($query);
        $result= $db->loadResult();
        return $result;
    }
    
    public function getAnos() {
        $db = JFactory::getDbo();
       $query = $db->getQuery(true);
        $query->select('DISTINCT ano');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("estado=1");
        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
    }
    
    public function getNotimpes(){
       $ano = JRequest::getVar('ano_notimpe', "");
       if(!$ano){
           $ano=date('Y');
       }
      
        $db = JFactory::getDbo();
       $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("ano=$ano");
        $query->where("estado=1");
        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
   
        
        
    }
    
    
    
    

}

function compara_veiculos($grupo_veiculo1, $grupo_veiculo2) {
   
    $grupo1_prioridade=$grupo_veiculo1->ordem?$grupo_veiculo1->ordem:999;
    $grupo2_prioridade=$grupo_veiculo2->ordem?$grupo_veiculo2->ordem:999;
    if ($grupo1_prioridade == $grupo2_prioridade) {
        return 0;
    }
    return ($grupo1_prioridade < $grupo2_prioridade) ? -1 : 1;
}


