<?php
/**
 * Concurso Controller of the Concursos Component
 *
 * PHP versions 5
 *
 * @category  Controller
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


class ConcursosControllerConcurso extends JControllerForm
{
     /*
    protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}
	
	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) )
		{
			return JFactory::getUser()->authorise( "core.edit", "com_concursos.concurso." . $id );
		}
	}
   
    public function save()
    {
        $request=JRequest::get('post');
        if(isset($request['jform'])):
            foreach ($request['jform'] as $key=>$req):
                JRequest::setVar($key, $req);
               
            endforeach;
            
        endif;
       $arquivo = JRequest::getVar('jform', array(), 'files', 'array');
        
        
        if(isset($arquivo['name']['instrucoes_especificas'])&& $arquivo['name']['instrucoes_especificas']):
            //exit('existe');
            JRequest::setVar('instrucoes_especificas', $arquivo['name']['instrucoes_especificas']);
        endif;
        $model = $this->getModel('Concurso');
        if ($model->save()) {
            $msg = JText::_('Object saved successfully!');
        } else {
            $msg = JText::_('Error: '.$model->getError());
        }
        $this->setRedirect(JRoute::_('index.php?option=com_concursos&view=Concurso&layout=list', false), $msg);
    }
     * 
     */

   


}
