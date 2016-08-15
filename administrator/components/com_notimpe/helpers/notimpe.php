<?php

defined('_JEXEC') or die;

class NotimpeHelper {

    /**
     * Configure the Linkbar.
     *
     * @param   string  $vName  The name of the active view.
     *
     * @return  void
     *
     * @since   1.6
     */
    public static function addSubmenu($vName) {
        JHtmlSidebar::addEntry(
                JText::_('Veículo'), 'index.php?option=com_notimpe&view=veiculo', $vName == 'veiculo'
        );

        JHtmlSidebar::addEntry(
                JText::_('Notimp'), 'index.php?option=com_notimpe&view=notimpe', $vName == 'notimp'
        );
    }

    public static function getActions() {
        $result = new JObject;
        $assetName = 'com_notimpe';
        $actions = JAccess::getActions('com_notimpe', 'component');

        foreach ($actions as $action) {
            $result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
        }
        return $result;
    }

    public static function criar_diretorio_imagem($data) {
        //verificação se é um novo notimpe
        if (empty($data['id'])):
            $params = JComponentHelper::getParams('com_notimpe');
            if ($params->get("criacao_automatica", 0)) {
                return self::executar_criacao_diretorio($params, $data);
            }
        endif;
    }

    private static function executar_criacao_diretorio($params, $data) {
        $retorno = 1;
        $path = rtrim($params->get('path_diretorio_imagens', 'images'), "\\/");
        $ano_notimp = $data['ano'];
        $nr_notimp = str_pad($data['nr_notimpe'], 3, '0', STR_PAD_LEFT);
        $new_path = JPATH_ROOT."/".$path . "/notimp/$ano_notimp/$nr_notimp";
        if (!is_dir($new_path)) {
            
            $retorno = mkdir($new_path, 0777, true);
        }
       // exit($new_path." ".$retorno);
        return $retorno;
    }

}
