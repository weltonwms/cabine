<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldGraduadosgrp extends JFormFieldUser {

    public $type = 'Graduadosgrp';

    protected function getGroups() {
         $grupo_graduados = JComponentHelper::getParams('com_notimp')->get('grupo_graduados');
         return array($grupo_graduados);
    }

}
