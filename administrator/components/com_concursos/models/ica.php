<?php

/**
 * Icas Model of the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosModelIca extends JModelAdmin {

    public function __construct() {
        parent::__construct();
    }

    public function getTable($type = 'Icas', $prefix = 'JTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

   
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_concursos.icas', 'icas', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }
        // echo "<pre>"; print_r($form); exit();
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
                'com_concursos.edit.icas.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }
       
        return $data;
    }

}
