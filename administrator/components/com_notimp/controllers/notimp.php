<?php

/**
 * Notimpe Controller of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Controller
 * @package   Notimpe
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class NotimpControllerNotimp extends JControllerForm {

    public function __construct() {

        parent::__construct();
       
    }

   
    public function apagar_artigos() {
        if (!$this->allowEdit()) {
            // Set the internal error and also the redirect error.
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_notimp&view=Notimpe&layout=list', false));
            return false;
        }
        $id_notimp = JRequest::getVar('id');
        $model = $this->getModel('Notimp');
        if ($model->apagar_artigos($id_notimp)) {
            $msg = JText::_('Referências Apagadas com Sucesso!');
            $type = "message";
        } else {
            $msg = JText::_('Error: ' . $model->getError());
            $type = "error";
        }
        $this->setRedirect(JRoute::_("index.php?option=com_notimp&view=Notimp&layout=edit&id=$id_notimp", false), $msg, $type);
    }

   

}
