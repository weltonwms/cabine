<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldUploadfile extends JFormField {

    protected $type = 'Uploadfile';

    // getLabel() left out

    public function getInput() {
        $this->addScript();

        return "<div class='input-prepend input-append'>" .
                "<input type='text' id='{$this->id}' name='{$this->name}' class='{$this->class}' value='{$this->value}'>" .
                "<a class='modal btn btn-primary'" .
                " href='index.php?option=com_concursos&amp;view=upload&amp;tmpl=component&amp;fieldid={$this->id}'" .
                'rel={handler:"' . 'iframe"' . '}' .
                " >" .
                "Upload" .
                "</a>" .
                "</div>";
    }

    private function addScript() {
        JHtml::_('behavior.modal');
        $document = JFactory::getDocument();
        $document->addScriptDeclaration('
        function jInsertFieldValue(value, id) {
            var old_id = document.id(id).value;
        	if (old_id != id) {
                	var elem = document.id(id)
                    elem.value = value;
                    elem.fireEvent("change");
                }
         }       
        ');
    }

}
