<?php

/**
 * Veiculo Model of the Notimpe Component
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

jimport('joomla.application.component.model');

class NotimpeModelVeiculo extends JModelList {

    /**
     * Constructor
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'nome',
                'cidade',
                'estado',
            );
        }
        parent::__construct($config);
    }

    /**
     * Method to load data from a specific item
     *
     * @return object Item data
     * @access public
     * @since  1.0
     */
    public function getItem() {
        $cid = JRequest::getVar('cid');
        $id = (int) $cid[0];
        $row = & $this->getTable('Veiculo', 'JTable');
        $row->load($id);
        return $row;
    }

    /**
     * Method to save an object
     *
     * @return bool
     * @access public
     * @since  1.0
     */
    public function save($data) {
        $row = & $this->getTable('Veiculo', 'JTable');
        if (!$data['id']) {
            $data['ordem'] = $this->getUltimaOrdem();
        }

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->check()) {
            $this->setError($row->getError());
            return false;
        }
        //echo "<pre>"; print_r($data); exit();
        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        } else {
            $this->ordena_veiculos($data);
        }

        return true;
    }

    private function ordena_veiculos($data) {
        if ($data["id"]) {
            if ($data['ordem'] > $data['ordem_original']) {
                $this->subir_ordem($data);
            } elseif ($data['ordem'] < $data['ordem_original']) {
                $this->descer_ordem($data);
            }
        }
    }

    private function subir_ordem($data) {
        $id = $data['id'];
        $ordem = $data['ordem'];
        $ordem_original = $data['ordem_original'];
        $query = "UPDATE `#__notimpe_veiculo` SET ordem=(ordem -1) ";
        $query.=" where (ordem > $ordem_original AND ordem < $ordem) ";
        $query.=" OR id=$id";
        $db = &JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
    }

    private function descer_ordem($data) {
        $id = $data['id'];
        $ordem = $data['ordem'];
        $ordem_original = $data['ordem_original'];
        $query = "UPDATE `#__notimpe_veiculo` SET ordem=(ordem +1) ";
        $query.=" where ordem >= $ordem AND ordem < $ordem_original";
        $query.=" AND id<>$id";
        $db = &JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
    }

    private function getUltimaOrdem() {
        $query = "SELECT max( ordem ) FROM `#__notimpe_veiculo` ";
        $db = &JFactory::getDBO();
        $db->setQuery($query);
        $resultado = $db->loadResult();
        return $resultado + 1;
    }

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $wheres = array();
        $where = '';

        //captura dos filtros (ficam guardados como se fosse sessao)
        $nome = $this->getState('filter.search');
        $estado = $this->getState('filter.estado');
        $cidade = $this->getState('filter.cidade');

        if (!empty($nome)) {
            $wheres[] = "nome like '%$nome%' ";
        }
        if (!empty($estado)) {
            $wheres[] = "estado = '$estado' ";
        }
        if (!empty($cidade)) {
            $wheres[] = "cidade = '$cidade' ";
        }
        //implodindo o array para string no formato sql
        if (count($wheres) > 0) {
            $x = implode(' and ', $wheres);
            $where = " where " . $x;
        }

        $sql = "SELECT * FROM `#__notimpe_veiculo` $where order by ordem";

        return $query->setQuery($sql);
    }

    public function delete() {
        $row = & $this->getTable('Veiculo', 'JTable');
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
        $query = "SELECT * FROM `#__notimpe_artigos` WHERE id_veiculo IN ($cids_implodidos) ";
        $db = &JFactory::getDBO();
        $db->setQuery($query);
        $db->execute();
        if ($db->getAffectedRows() > 0) {
            $this->setError("Existe artigo(s) vinculados a veículo(s). Não foi possível Excluir! ");
            return FALSE;
        }
        return TRUE;
    }

    public function getTable($type = 'Veiculo', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_notimpe.veiculo', 'veiculo', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     * a verificação do layout foi feita pois existem 2 forms utilizados: um
     * para pesquisa default e outra para edição
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData() {
        $layout = JRequest::getVar('layout', NULL);
        if ($layout == "edit"):
            // Check the session for previously entered form data.
            $data = JFactory::getApplication()->getUserState(
                    'com_notimpe.edit.notimpe.data', array()
            );

            if (empty($data)) {
                $data = $this->getItem();
            }

            return $data;
        endif;
        return parent::loadFormData();
    }

    public function getFilterForm($data = array(), $loadData = true) {
        // Get the form.
        $form1 = $this->loadForm(
                'com_notimpe.veiculo.filter', 'filter_veiculo', array('control' => '', 'load_data' => $loadData)
        );
        //echo "<pre>"; print_r($form1); exit();
        return $form1;
    }

}
