<?php


// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');


class JTableConfig extends JTable
{
    /**
     * @var int Primary key
     */
    var $id = null;
    
    /**
     * @var string Nome
     */
    var $grupo_oficiais_servico = '';

    /**
     * @var string Imagem
     */
    var $grupo_graduados_servico = '';

    /**
     * Constructor
     *
     * @param object &$db A database connector object
     *
     * @return void
     * @access public
     * @since  1.0
     */
    public function __construct(&$db)
    {
        parent::__construct('#__notimpe_config', 'id', $db);
    }

    /**
     * Overloaded check function
     *
     * @return boolean
     * @access public
     * @since  1.0
     * @see    JTable::check
     */
    public function check()
    {
        // check required fields
        $required_fields = array('grupo_oficiais_servico' => 'grupo_oficiais_servico', 'grupo_graduados_servico' => 'grupo_graduados_servico');
        foreach($required_fields as $field => $description) {
            if(!$this->get($field)) {
                $this->setError(JText::_($description.' is required.'));
                return false;
            }
        }

        return true;
    }
}
?>
