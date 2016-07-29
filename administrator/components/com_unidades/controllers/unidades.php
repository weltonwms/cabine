<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class UnidadesControllerUnidades extends JControllerAdmin {
    
    //reescrita do getModel() para utilizar o model de Unidade e deletar por exemplo um item
     public function getModel($name = 'Unidade', $prefix = 'UnidadesModel', $config = array('ignore_request' => true))
      {
      $model = parent::getModel($name, $prefix, $config);

      return $model;
      }
     

    public function getListaCidades() {
        $uf_id = JRequest::getVar('uf_id');
        $model = $this->getModel('Unidades');

        $items = $model->getCidades($uf_id);

        $option = array();
        foreach ($items as $key => $item) {
            $option[] = "<option value='{$item->cidade}'>{$item->cidade}</option>";
        }

        $return = implode("", $option);
        echo $return;

        exit;
    }
    
    
   
}
