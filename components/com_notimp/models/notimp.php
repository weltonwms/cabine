<?php

/**
 * Notimpe Model of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Notimp
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

class NotimpModelNotimp extends JModelLegacy {

    public function __construct() {
        parent::__construct();
    }

    public function getItem() {
        $id = JFactory::getApplication()->input->get('id');
        if (empty($id)):
            $id = $this->getUltimoNotimp();
        endif;
        if ($id):
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__notimpe_notimpe'));
            $query->where("id=$id");

            $db->setQuery($query);

            $item = $db->loadObject();
            if ($item && $item->estado != 0):
                $item->veiculos = $this->getVeiculosComArtigos($item->id);
                return $item;
            endif;
        endif;
        return FALSE;
        //echo "<pre>"; print_r($item); exit();
    }

    private function getVeiculosComArtigos($id_notimp) {



        if ($id_notimp):
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__notimpe_artigos'));
            $query->where("id_notimpe=$id_notimp");

            $db->setQuery($query);
            $array_arts = $db->loadAssocList('id_artigo', 'id_veiculo');

            $lista = array();
            foreach ($array_arts as $key => $value):
                $lista[$value][] = $key;
            endforeach;

            $veiculos = $this->getVeiculos(array_keys($lista));


            foreach ($veiculos as $veiculo):
                $veiculo->artigos = $this->getArtigosJoomla($lista[$veiculo->id]);
            endforeach;
            return $this->ordenarVeiculos($veiculos);




        endif;
    }

    private function getArtigosJoomla(array $artigos) {
        if ($artigos):
            $articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

            // Set application parameters in model
            $app = JFactory::getApplication();
            $appParams = $app->getParams();

            $articles->setState('params', $appParams);
            $articles->setState('filter.article_id', $artigos);
            $articles->setState('filter.published', 1);

            //fiter acess
            $access = !JComponentHelper::getParams('com_content')->get('show_noauth');
            $articles->setState('filter.access', $access);
            //fim acess

            return ($articles->getItems());

        endif;
        return array();
    }

    private function getVeiculos(array $ids) {
        if ($ids):
            $idsImplodidos = implode(",", $ids);
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__notimpe_veiculo'));
            $query->where("id IN($idsImplodidos)");
            $db->setQuery($query);
            return $db->loadObjectList();
        endif;
    }

    private function ordenarVeiculos($lista) {
        usort($lista, "compara_veiculos");
        return $lista;
    }

    public function getUltimoNotimp() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("estado=1");
        $query->order('data DESC');

        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }

}

function compara_veiculos($grupo_veiculo1, $grupo_veiculo2) {

    $grupo1_prioridade = $grupo_veiculo1->ordem ? $grupo_veiculo1->ordem : 999;
    $grupo2_prioridade = $grupo_veiculo2->ordem ? $grupo_veiculo2->ordem : 999;
    if ($grupo1_prioridade == $grupo2_prioridade) {
        return 0;
    }
    return ($grupo1_prioridade < $grupo2_prioridade) ? -1 : 1;
}
