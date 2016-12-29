<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldOficiaisgrp extends JFormFieldUser {

    public $type = 'Oficiaisgrp';

    protected function getGroups() {
         $grupo_oficiais = JComponentHelper::getParams('com_notimp')->get('grupo_oficiais');
         return array($grupo_oficiais);
    }

}
