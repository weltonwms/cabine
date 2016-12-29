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
$com_path = JPATH_ADMINISTRATOR . '/components/com_content/';

JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');


class NotimpModelNotimp extends JModelAdmin {

   

    public function __construct() {

        parent::__construct();
        
    }

    public function getTable($type = 'Notimpe', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    

    private function getNotimpesMesmoAno($nr_notimpe, $ano) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("nr_notimpe=$nr_notimpe");
        $query->where("ano=$ano");

        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
    }

    private function getNotimpe($id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("id=" . $id);
        $db->setQuery($query);
        $results = $db->loadObjectList();

        return $results[0];
    }

    private function valida_notimpe($data) {
        $nr_notimpe = $data['nr_notimpe'];
        $ano = $data['ano'];
        $id = $data['id'];
        $notimpes = array();
        //o if $id é para verificar se é cadastro ou alteração.
        if ($id) {
            $objeto = $this->getNotimpe($id);
            if ($objeto->nr_notimpe != $nr_notimpe || $objeto->ano != $ano) {
                $notimpes = $this->getNotimpesMesmoAno($nr_notimpe, $ano);
            }
        } else {
            $notimpes = $this->getNotimpesMesmoAno($nr_notimpe, $ano);
        }
        if (count($notimpes) > 0) {
            $this->setError("Nº de Notimpe Inválido");
            return false;
        }
        return true;
    }

    public function save($data) {
        $data['ano'] = JHtml::_('date', $data['data'], 'Y');

        if ($this->valida_notimpe($data)) {
            $retorno = parent::save($data);
            if ($retorno) {
                NotimpHelper::criar_diretorio_imagem($data);
                return $retorno;
            }
        }


        return false;
    }

    public function delete(&$pks) {
        
        if($this->validaDelete($pks)):
            return parent::delete($pks);
        endif;
        return FALSE;
       
    }

    protected function canDelete($record) {
        $user = JFactory::getUser();
        return $user->authorise('core.delete', "com_notimp");
    }

    private function validaDelete($cids) {
        $cids_implodidos = implode(",", $cids);
        $query = "SELECT * FROM `#__notimpe_artigos` WHERE id_notimpe IN ($cids_implodidos) ";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
        if ($db->getAffectedRows() > 0) {
            $this->setError("Existe artigo(s) vinculados. Não foi possível Excluir! ");
            return FALSE;
        }
        return TRUE;
    }

    public function getArtigos() {
        $input = JFactory::getApplication()->input;
        $id_notimpe = $input->get('id');
        $artigos_joomla = array();
        if ($id_notimpe):
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__notimpe_artigos'));

            $query->where("id_notimpe=$id_notimpe");

            $db->setQuery($query);
            $array_arts = $db->loadAssocList('id_artigo', 'id_artigo');
            $artigos_joomla = $this->capturarArtigosJoomla($array_arts);
        endif;
        return $artigos_joomla;
    }

    protected function capturarArtigosJoomla(array $artigos) {
        if ($artigos):
            $articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

            // Set application parameters in model

            $articles->setState('params', new JRegistry());
            $items = $articles->getItems();
            $lista = array();
            foreach ($items as $item):
                if (in_array($item->id, $artigos)):
                    $lista[] = $item;
                endif;
            endforeach;
            return $lista;
        endif;
        return array();
    }

    public function getUltimoNotimp() {
        $ano_corrente = date('Y');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(' MAX(nr_notimpe)');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("ano=$ano_corrente");
        $db->setQuery($query);
        $resultado = $db->loadResult();
        return $resultado + 1;
    }

  
    

   

    public function apagar_artigos($id_notimp) {
        if (!$this->canDelete(null)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'));
            return false;
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $condition = array(
            $db->quoteName('id_notimpe') . " = $id_notimp"
        );
        $query->delete($db->quoteName('#__notimpe_artigos'));
        $query->where($condition);
        $db->setQuery($query);
        $result = $db->execute();
        if (!$result) {
            $this->setError("Não foi possível Apagar Referências!!");
            return false;
        }
        return true;
    }

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_notimp.notimp', 'notimp', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }
        //echo "<pre>"; print_r($form); exit();
        return $form;
    }

    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_notimp.edit.notimp.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
