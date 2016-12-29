<?php

/**
 * Notimpe Model of the Notimpe Component
 *
 * PHP versions 5
 *
 * @category  Model
 * @package   Notimp
 * @author    Welton Moreira dos Santos <welton@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

//$com_path = JPATH_SITE . '/components/com_content/';
//JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');

class NotimpModelNotimps extends JModelList {

    private $anoAtivo;

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'data',
                'ano'
            );
        }
        $this->setAnoAtivo();
        parent::__construct($config);
    }

    public function getAnoAtivo() {
        return $this->anoAtivo;
    }

    private function setAnoAtivo() {
        $this->anoAtivo = JFactory::getApplication()->input->get('ano', date('Y'));
    }

    public function getAnos() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('DISTINCT ano');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("estado=1");
        $query->order("data desc");
        $db->setQuery($query);
        $results = $db->loadAssocList(null, 'ano');
        return $results;
    }

    public function getNotimps() {
        $ano = $this->getAnoAtivo();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__notimpe_notimpe'));
        $query->where("ano=$ano");
        $query->where("estado=1");
        $query->order("data desc");
        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
    }

}
