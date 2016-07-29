<?php
/**
 * Concurso Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');

/**
 * Concurso Table Class
 *
 * @category  Table_Class
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @version   1.0.0
 */
class JTableConcurso extends JTable
{
    /**
     * @var int Primary key
     */
    var $id = null;
    
    /**
     * @var string Sigla
     */
    var $sigla = '';

    /**
     * @var string Nome
     */
    var $nome = '';

    /**
     * @var string Escola
     */
    var $escola = '';

    /**
     * @var string Turma
     */
    var $turma = '';

    /**
     * @var date Data Inicio
     */
    var $data_inicio = null;

    /**
     * @var date Data Termino
     */
    var $data_termino = null;

    /**
     * @var int Ica Inspecao
     */
    var $ica_inspecao = 0;

    /**
     * @var int Ica Psicologico
     */
    var $ica_psicologico = 0;

    /**
     * @var int Ica Tacf
     */
    var $ica_tacf = 0;

    /**
     * @var string Instrucoes Especificas
     */
    var $instrucoes_especificas = '';

    /**
     * @var string Veiculo
     */
    var $veiculo = '';
    
    var $ambito = '';

    /**
     * @var int Status
     */
    var $status = 0;

    /**
     * @var string Site
     */
    var $site = '';

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
        parent::__construct('#__concursos_concurso', 'id', $db);
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
        //$required_fields = array('sigla' => 'Sigla', 'nome' => 'Nome', 'escola' => 'Escola', 'turma' => 'Turma', 'data_inicio' => 'Data Inicio', 'data_termino' => 'Data Termino', 'ica_inspecao' => 'Ica Inspecao', 'ica_psicologico' => 'Ica Psicologico', 'ica_tacf' => 'Ica Tacf', 'instrucoes_especificas' => 'Instrucoes Especificas', 'veiculo' => 'Veiculo', 'status' => 'Status', 'site' => 'Site');
        $required_fields= array();
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
