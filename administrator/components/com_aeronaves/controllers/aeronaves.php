<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class AeronavesControllerAeronaves extends JControllerAdmin {
    
    //reescrita do getModel() para utilizar o model de Aeronave e deletar por exemplo um item
     public function getModel($name = 'Aeronave', $prefix = 'AeronavesModel', $config = array('ignore_request' => true))
      {
      $model = parent::getModel($name, $prefix, $config);

      return $model;
      }
     

    
    
   
}
