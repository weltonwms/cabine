<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class ConcursosControllerUpload extends JControllerLegacy {

    protected $pasta_destino;

    public function upload() {

        // Get some data from the request
        $files = $this->input->files->get('Filedata', '', 'array');
        $this->pasta_destino = $this->input->get('pasta_destino', 'images', 'path');
        $return = JFactory::getSession()->get('com_concursos.return_url');
        if(empty($this->pasta_destino)):
            $this->pasta_destino="images";
        endif;
        //echo "<pre>"; print_r($return); exit();
        $this->setRedirect($return);
        
        // Authorize the user
        if (!$this->authoriseUser('create')) {
            return false;
        }

        $erro1 = false;

        // Check for erros.
        if ($erro1) {
            JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_WARNUPLOADTOOLARGE'));
            return false;
        }

        // Perform basic checks on file info before attempting anything
        foreach ($files as &$file) {
            $file['name'] = JFile::makeSafe($file['name']);
            $file['name'] = str_replace(' ', '-', $file['name']);
            $file['filepath'] = JPath::clean(implode(DIRECTORY_SEPARATOR, array(JPATH_ROOT, $this->pasta_destino, $file['name'])));

            if (($file['error'] == 1)) {
                // File size exceed either 'upload_max_filesize' or 'upload_maxsize'.
                JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE'));
                return false;
            }

            if (JFile::exists($file['filepath'])) {
                // A file with this name already exists
                JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_FILE_EXISTS'));
                return false;
            }

            if (!isset($file['name'])) {
                // No filename (after the name was cleaned by JFile::makeSafe)
                $this->setRedirect('index.php', JText::_('COM_MEDIA_INVALID_REQUEST'), 'error');
                return false;
            }
        }


        foreach ($files as &$file) {
            $object_file = new JObject($file);
            if (!JFile::upload($object_file->tmp_name, $object_file->filepath)) {
                // Error in upload
                JError::raiseWarning(100, JText::_('COM_MEDIA_ERROR_UNABLE_TO_UPLOAD_FILE'));
                return false;
            }
            $this->setMessage(JText::sprintf('COM_MEDIA_UPLOAD_COMPLETE', substr($object_file->filepath, strlen($this->pasta_destino))));
        }

        //caso ocorra tudo bem passar parametros para redirecionamento
        $pasta_destino = $this->pasta_destino;
        $url_arquivo = JPath::clean(implode(DIRECTORY_SEPARATOR, array($this->pasta_destino, $files[0]['name'])));
        $this->setRedirect($return . "&url_arquivo=$url_arquivo&pasta_destino=$pasta_destino");
        return true;
    }

    protected function authoriseUser($action) {
        if (!JFactory::getUser()->authorise('core.' . strtolower($action), 'com_media')) {
            // User is not authorised
            JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_' . strtoupper($action) . '_NOT_PERMITTED'));

            return false;
        }

        return true;
    }

}