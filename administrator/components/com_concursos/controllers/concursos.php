<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class ConcursosControllerConcursos extends JControllerAdmin
{
	
	public function getModel($name = 'Concurso', $prefix = 'ConcursosModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}