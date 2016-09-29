<?php
/**
 * Aeronave Table Class
 *
 * PHP versions 5
 *
 * @category  Table_Class
 * @author    Caroline <carolinesantossin@gmail.com>
 * @copyright 2015 CCA-BR. All rights reserved.
 * @license   GNU General Public License
 * @version   1.0.0
 * @link      
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die('Restricted access');

class JTableAeronave extends JTable
{
    public $unidades;




    public function __construct(&$db)
    {
        parent::__construct('#__aeronaves_aeronave', 'id', $db);
    }
    
    
        
       
    
    
     

   
}
