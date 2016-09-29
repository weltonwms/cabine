<?php


defined('_JEXEC') or die('Restricted access');




class NotimpeControllerNotimps extends JControllerForm
{
    
    public function __construct()
    {
           
        parent::__construct();
       //$this->registerTask('add', 'edit'); //estao vinculando o add ao edit;
        
    }

    
    public function add()
    {
       if (!$this->allowAdd()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe&layout=list', false));
            return false;
        }
        JRequest::setVar('view', 'Notimpe');
        JRequest::setVar('layout', 'edit');
        JRequest::setVar('hidemainmenu', 1);
        parent::display($cachable = false, $urlparams = array());
    }
    
     public function edit($key = NULL, $urlVar = NUL)
    {
         if (!$this->allowEdit()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe&layout=list', false));
            return false;
        }
        JRequest::setVar('view', 'Notimpe');
        JRequest::setVar('layout', 'edit');
        JRequest::setVar('hidemainmenu', 1);
        parent::display($cachable = false, $urlparams = array());
    }

    /**
     * Method to save an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function save($key = NULL, $urlVar = NUL)
    {
       $data = JRequest::get('post');
        if (!$this->allowSave($data)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe&layout=list', false));
            return false;
        }
        $this->setAno($data);
        $model = $this->getModel('Notimpe');
        if ($model->save($data)) {
            $msg = JText::_('Object saved successfully!');
            $type="message";
        } else {
            $msg = JText::_('Error: '.$model->getError());
             $type="error";
        }
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe', false), $msg,$type);
    }

    /**
     * Method to remove an object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function remove()
    {
        $model = $this->getModel('Notimpe');
        if(!$model->delete()) {
            $msg = $model->getError();
            $type="error";
        } else {
            $msg = JText::_('Successfully deleted objects!');
            $type="message";
        }
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe', false), $msg,$type);
    }

    /**
     * Method to cancel an operation
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function cancel($key=null)
    {
       // $msg = JText::_('Operation Aborted');
        $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe', false));
    }
    
    
    
    public function apagar_artigos(){
         if (!$this->allowEdit()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimpe&view=Notimpe&layout=list', false));
            return false;
        }
        $id_notimp=JRequest::getVar('id');
        //echo "<pre>"; print_r(JRequest::get()); exit();
         $model = $this->getModel('Notimpe');
        if ($model->apagar_artigos($id_notimp)) {
            $msg = JText::_('Referências Apagadas com Sucesso!');
            $type="message";
        } else {
            $msg = JText::_('Error: '.$model->getError());
             $type="error";
        }
        $this->setRedirect(JRoute::_("index.php?option=com_notimpe&view=Notimpe&layout=edit&cid[]=$id_notimp", false), $msg,$type);
    }
    
   
    
    protected function  setAno(&$dataPost){
        $data= JRequest::getVar('data');
        $array=explode("-", $data);
        $valor_ano=$array[0];
        JRequest::setVar("ano", $valor_ano);
        $dataPost['ano']=$valor_ano;
        
    }


}