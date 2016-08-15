<?php

/**
 * @package		Joomla.Site
 * @subpackage	plg_content_rating
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

jimport('joomla.utilities.date');

/**
 * An example custom profile plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	User.profile
 * @version		1.6
 */
class plgContentNotimpe extends JPlugin {

    /**
     * Constructor
     *
     * @access      protected
     * @param       object  $subject The object to observe
     * @param       array   $config  An array that holds the plugin configuration
     * @since       2.5
     */
    public function __construct(& $subject, $config) {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

    /*
     * O metodo abaixo é utilizado para carregar dados do banco para o formulário
     * de edição de artigo. É feito um merge (junção dos dados do joomla com os
     * dados do notimpe
     */

    function onContentPrepareData($context, $data) {


        if (is_object($data)) {
            $articleId = isset($data->id) ? $data->id : 0;

            if (!isset($data->notimpe) and $articleId > 0) {

                // Carrega notimpe  from the database. (caso não exista notimpe ainda e houver artigo para editar
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->select('*');
                $query->from('#__notimpe_artigos');
                $query->where('id_artigo = ' . $db->Quote($articleId));


                $db->setQuery($query);
                $results = $db->loadRowList();

                // Check for a database error.
                if ($db->getErrorNum()) {
                    $this->_subject->setError($db->getErrorMsg());
                    return false;
                }

                // Merge the notimpe data.
                if (count($results) > 0):
                    $data->notimpe = array('veiculo' => $results[0][2], 'nr_notimpe' => $results[0][3]);

                endif;
            }
        }

        return true;
    }

    /**
      O método abaixo é utilizado para fazer um merge (junção) do formulaŕio natural do
     * joomla com os campos extras do plugin notimpe.
     */
    function onContentPrepareForm($form, $data) {
        $app = JFactory::getApplication();
        $option = $app->input->get('option');

        switch ($option) {

            case 'com_content':
                if ($app->isAdmin()) {
                    $document = JFactory::getDocument();
                    $notimp_category=$this->params->get('notimp_category');
                    $notimp_id=$app->input->get('notimpeId',0);
                    //exit($notimp_id);
                    $document->addScriptDeclaration("var notimp_category=$notimp_category; var notimp_id=$notimp_id");
                    $document->addScript(JURI::root() . "plugins/content/notimpe/assets/js/notimpe.js");
                    
                    JForm::addFormPath(dirname(__FILE__) . '/forms');

                    $form->loadFile('form', false); //carregamento do xml campos extras notimpe
                    if (isset($data->notimpe)):
                        $id_notimpe = $data->notimpe['nr_notimpe'];
                        $query = "SELECT ID, concat(nr_notimpe, ' (',ano, ')') as titulo FROM #__notimpe_notimpe where estado=0 OR id=$id_notimpe";
                        $form->setFieldAttribute('nr_notimpe', 'query', $query, 'notimpe');
                    endif;
                }
                return true;
        }

        return true;
    }

    /*
      Método abaixo é utilizado para salvar os campos extras do notimpe. depois que
      é salvo o artigo.

     */

    public function onContentAfterSave($context, $article, $isNew) {
        $x = JRequest::get();
        //a condição abaixo é usada para garantir que haverá um insert somente se
        // o dado existir e tiver alguma coisa nele.
        if (isset($x['jform']['notimpe']) && $x['jform']['notimpe']['veiculo']):

            $veiculo = $x['jform']['notimpe']['veiculo'];
            $nr_notimpe = $x['jform']['notimpe']['nr_notimpe'];
            try {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);

                $query->delete('#__notimpe_artigos');
                $query->where('id_artigo = ' . $db->Quote($article->id));

                $db->setQuery($query);
                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }

                $query->clear();
                $query->insert('#__notimpe_artigos');
                $query->values("'',{$article->id},$veiculo,$nr_notimpe");

                $db->setQuery($query);

                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }
            } catch (JException $e) {
                $this->_subject->setError($e->getMessage());
                return false;
            }
        endif;

        return true;
    }

    public function onContentAfterDelete($context, $article) {

        $articleId = $article->id;
        if ($articleId) {
            try {
                $db = JFactory::getDbo();

                $query = $db->getQuery(true);
                $query->delete();
                $query->from('#__notimpe_artigos');
                $query->where('id_artigo = ' . $db->Quote($articleId));
                $db->setQuery($query);

                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }
            } catch (JException $e) {
                $this->_subject->setError($e->getMessage());
                return false;
            }
        }

        return true;
    }

    /*
     * método customizado para atender somente o Notimp
     */
    public function onContentPrepareNotimp(&$artigos_notimpe) {
        //grupos autorizados a ver NOTIMP de comando na configuração de plugin
        $command_usergroups = $this->params->get('command_usergroup', array());

        //verificar se algum usuário está logado e obter seus grupos
        $user = JFactory::getUser();
        $user_groups = $user->get('groups', 0);

        //verificar se o usuario logado pertence a um dos grupos

        $intersecao = array_intersect($command_usergroups, $user_groups);
        if (empty($intersecao)) :
            foreach ($artigos_notimpe as $grupo):
                foreach ($grupo->artigos_veiculo as $artigo):
                    $this->retirar_styles($artigo->introtext);
                    $this->retirar_styles($artigo->fulltext);
                endforeach;
            endforeach;
        endif;
    }

    protected function retirar_styles(&$text) {
        //retirar ocorrencias de texto com fundo colorido
        $pattern = '/background-color:.+;/U';
        $replacement = '';
        $text = preg_replace($pattern, $replacement, $text);

        //retirar atributos style vazios de  <span style=""> ... </span>

        $pattern = '/(<span) style=""/';
        $replacement = '$1';

        $text = preg_replace($pattern, $replacement, $text);
    }
    
     public function onContentPrepare($context, $row, $params, $page = 0) {
        //não implementado ainda. Quando um conteudo é preparado para display.
    }
    
     public function onContentBeforeSave($user, $isnew, $data) {
        //não implementado. Método acionado antes de salvar artigo
    }

}
