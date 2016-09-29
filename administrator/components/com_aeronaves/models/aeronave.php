<?php

/**
 * Aeronave Model of the passagemcomando Component
 *
 * PHP versions 5
 *
 * @category  Model

 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_unidades/models', 'UnidadesModel');

class AeronavesModelAeronave extends JModelAdmin {

    public function __construct() {
        parent::__construct();
    }

    public function getTable($type = 'Aeronave', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    protected function canDelete($record) {
        if (!empty($record->id)) {
            return JFactory::getUser()->authorise("core.delete", "com_aeronaves.aeronave." . $record->id);
        }
    }

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_aeronaves.aeronave', 'aeronave', array('control' => 'jform', 'load_data' => $loadData)
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    public function save($data) {
        $input = JFactory::getApplication()->input;
        $dados = $input->post->get('jform', array(), 'array');
        if ($retorno = parent::save($data)) :
            if (!$dados['id']) {
                $dados['id'] = $this->_db->insertid();
            }
            $this->saveUnidades($dados);
            $this->saveTags($dados);
            return $retorno;
        endif;
    }

    public function delete(&$pks) {
        if (parent::delete($pks)) {
            $this->deleteUnidadesTags($pks);
            return true;
        }
    }

    protected function saveUnidades($dados) {
        $id_aeronave = $dados['id'];
        //echo $id_aeronave; exit();
        $unidadesAtribuidas = $dados['unidades'];
        if (count($unidadesAtribuidas)) :
            $query = $this->_db->getQuery(true);

            //apagar todas om da aeronave se tiver antes de atualizar os novos

            $query->clear()
                    ->delete($this->_db->quoteName('#__aeronaves_om_map'))
                    ->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $id_aeronave);
            $this->_db->setQuery($query);
            $this->_db->execute();

            // set novas ou atualizações de unidade
            $query->clear()
                    ->insert($this->_db->quoteName('#__aeronaves_om_map'))
                    ->columns(array($this->_db->quoteName('id_aeronave'), $this->_db->quoteName('id_unidade')));


            foreach ($unidadesAtribuidas as $unidade) :
                $query->clear('values')
                        ->values($id_aeronave . ', ' . $unidade);
                $this->_db->setQuery($query);
                $this->_db->execute();
            endforeach;
        endif;
    }

    protected function saveTags($dados) {
        $id_aeronave = $dados['id'];
        $tagsAtribuidas = $dados['tags'];
        if (count($tagsAtribuidas)) :
            $query = $this->_db->getQuery(true);

            //apagar todas tags da aeronave se tiver antes de atualizar os novos

            $query->clear()
                    ->delete($this->_db->quoteName('#__aeronaves_tags_map'))
                    ->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $id_aeronave);
            $this->_db->setQuery($query);
            $this->_db->execute();

            // set novas ou atualizações de unidade
            $query->clear()
                    ->insert($this->_db->quoteName('#__aeronaves_tags_map'))
                    ->columns(array($this->_db->quoteName('id_aeronave'), $this->_db->quoteName('id_tag')));


            foreach ($tagsAtribuidas as $tag) :
                $query->clear('values')
                        ->values($id_aeronave . ', ' . $tag);
                $this->_db->setQuery($query);
                $this->_db->execute();
            endforeach;
        endif;
    }

    protected function deleteUnidadesTags($pks) {
        $query = $this->_db->getQuery(true);

        //apagar todas tags da aeronave se tiver antes de atualizar os novos
        foreach ($pks as $pk):
            $query->clear()
                    ->delete($this->_db->quoteName('#__aeronaves_om_map'))
                    ->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $pk);
            $this->_db->setQuery($query);
            $this->_db->execute();

            $query->clear()
                    ->delete($this->_db->quoteName('#__aeronaves_tags_map'))
                    ->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $pk);
            $this->_db->setQuery($query);
            $this->_db->execute();
        endforeach;
    }

    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_aeronaves.edit.aeronave.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getUnidades() {
        $model = JModelLegacy::getInstance('Unidades', 'UnidadesModel');
        return $model->getItems();
    }

    public function getUnidadesAssigned($id_aeronave = null) {
        if (!$id_aeronave) {
            $id_aeronave = JRequest::getVar('id');
        }
        $query = $this->_db->getQuery(true);
        $query->select("id_unidade");
        $query->from($this->_db->quoteName('#__aeronaves_om_map'));
        $query->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $id_aeronave);
        $this->_db->setQuery($query);
        return $this->_db->loadAssocList('id_unidade', 'id_unidade');
    }

    public function getTags() {

        $query = $this->_db->getQuery(true);
        $query->select("*");
        $query->from($this->_db->quoteName('#__midia_tags'));
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    public function getTagsAssigned($id_aeronave = null) {
        if (!$id_aeronave) {
            $id_aeronave = JRequest::getVar('id');
        }
        $query = $this->_db->getQuery(true);
        $query->select("id_tag");
        $query->from($this->_db->quoteName('#__aeronaves_tags_map'));
        $query->where($this->_db->quoteName('id_aeronave') . ' = ' . (int) $id_aeronave);
        $this->_db->setQuery($query);
        return $this->_db->loadAssocList('id_tag', 'id_tag');
    }

}
