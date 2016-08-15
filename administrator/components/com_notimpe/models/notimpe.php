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
$com_path = JPATH_ADMINISTRATOR . '/components/com_content/';

JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');
jimport('joomla.application.component.model');

class NotimpeModelNotimpe extends JModelList {

    private $config;

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'oficial_servico',
                'graduado_servico',
                'status',
                'data',
                'ano'
            );
        }
        parent::__construct($config);
        $this->setConfig();
    }

    public function getTable($type = 'Notimpe', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItem() {
        $cid = JRequest::getVar('cid');
        $id = (int) $cid[0];
        $row = & $this->getTable('Notimpe', 'JTable');
        $row->load($id);
        return $row;
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
            return false;
        }
        return true;
    }

    public function save($data) {
        //exit(JPATH_ROOT);
        $row = & $this->getTable('Notimpe', 'JTable');
        
      
        if (!$this->valida_notimpe($data)) {
            $this->setError("Nº de Notimpe Inválido");
            return false;
        }

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
        NotimpeHelper::criar_diretorio_imagem($data);
        return true;
    }

    public function delete() {
        $row = & $this->getTable('Notimpe', 'JTable');
        $cids = JRequest::getVar('cid', array(0), 'post', 'array');
        if (!$this->canDelete($row)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'));
            return false;
        }

        if (!$this->validaDelete($cids)) {
            return false;
        }
        foreach ($cids as $cid) {
            if (!$row->delete($cid)) {
                $this->setError($row->getErrorMsg());
                return false;
            }
        }
        return true;
    }

    protected function canDelete($record) {
        $user = JFactory::getUser();
        return $user->authorise('core.delete', "com_notimpe");
    }

    private function validaDelete($cids) {
        $cids_implodidos = implode(",", $cids);
        $query = "SELECT * FROM `#__notimpe_artigos` WHERE id_notimpe IN ($cids_implodidos) ";
        $db = &JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
        if ($db->getAffectedRows() > 0) {
            $this->setError("Existe artigo(s) vinculados. Não foi possível Excluir! ");
            return FALSE;
        }
        return TRUE;
    }

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $wheres = array('estado' => "estado != 2");
        $where = '';
        
        //captura dos filtros (ficam guardados como se fosse sessao)
        $nr_notimpe = $this->getState('filter.search');
        $data = $this->getState('filter.data');
        $ano = $this->getState('filter.ano');
        $estado = $this->getState('filter.status');
        $oficial_servico = $this->getState('filter.oficial_servico');
        $graduado_servico = $this->getState('filter.graduado_servico');

        if ($estado != '') {
            $wheres['estado'] = "estado = '$estado' ";
        }
        if (!empty($oficial_servico)) {
            $wheres[] = "oficial_servico = '$oficial_servico'";
        }
        if (!empty($graduado_servico)) {
            $wheres[] = "graduado_servico = '$graduado_servico'";
        }
        if (!empty($nr_notimpe)) {
            $wheres[] = "nr_notimpe = '$nr_notimpe' ";
        }
        if (!empty($data)) {
            $wheres[] = "data = '$data' ";
        }
        if (!empty($ano)) {
            $wheres[] = "ano = '$ano' ";
        }

        //implodindo o array para string no formato sql
        if (count($wheres) > 0) {
            $x = implode(' and ', $wheres);
            $where = " where " . $x;
        }

        $sql = "SELECT n.id, n.nr_notimpe, n.ano, n.data, n.estado, n.oficial_servico,
            n.graduado_servico, u.name AS oficial_name, u.username AS oficial_username,
            ug.name AS graduado_name, ug.username AS graduado_username
            FROM #__notimpe_notimpe n
            LEFT JOIN #__users u ON n.oficial_servico = u.id
            LEFT JOIN #__users ug ON n.graduado_servico = ug.id $where
            ORDER BY n.data DESC    ";

        return $query->setQuery($sql);
    }

   

    public function getArtigos() {
        $cid = JRequest::getVar('cid');
        $id_notimpe = $cid[0];
        $artigos_joomla = array();
        if ($id_notimpe):
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__notimpe_artigos'));

            $query->where("id_notimpe=$id_notimpe");

            $db->setQuery($query);
            $results = $db->loadObjectList();
            $array_arts = array();
            foreach ($results as $result):
                $array_arts[] = $result->id_artigo;
            endforeach;

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

    public function getUltimoNotimpe() {
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

    public function getGrupoOficiais() {
        $grupo = $this->config->get('grupo_oficiais');
        return $this->getUsuariosgrupo($grupo);
    }

    public function getGrupoGraduados() {
        $grupo = $this->config->get('grupo_graduados');
        return $this->getUsuariosgrupo($grupo);
    }

    public function getUsuariosgrupo($id_grupo) {
        $id_users = JAccess::getUsersByGroup($id_grupo);
        $users = array();
        foreach ($id_users as $id_user) {
            $users[] = JFactory::getUser($id_user);
        }

        return $users;
    }

    public function getUsers() {
        $db = & JFactory::getDBO();
        $query = "SELECT * FROM #__users";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    public function getGrupos() {
        $db = & JFactory::getDBO();
        $query = "SELECT * FROM #__usergroups";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    public function getItemConfig() {

        return $this->config;
    }

    private function setConfig() {
        $this->config = JComponentHelper::getParams('com_notimpe');
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

    public function getFilterForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_notimpe.notimpe', 'filter_notimpe', array('control' => '', 'load_data' => $loadData)
        );
        return $form;
    }

}
