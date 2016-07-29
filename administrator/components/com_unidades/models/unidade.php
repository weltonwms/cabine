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
defined('_JEXEC') or die('Restricted access');



class UnidadesModelUnidade extends JModelAdmin {

    public function __construct() {
        parent::__construct();
    }

    public function getTable($type = 'Unidade', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    

    protected function canDelete($record) {
        if (!empty($record->id)) {
            return JFactory::getUser()->authorise("core.delete", "com_unidades.unidade." . $record->id);
        }
    }
    

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_unidades.unidade', 'unidade', array(
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
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_unidades.edit.unidade.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
