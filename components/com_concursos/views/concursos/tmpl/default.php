<?php
/**
 * HTML Default Template
 *
 * PHP versions 5
 *
 * @category  Template
 * @package   Concursos
 * @author    Welton Moreira dos Santos <weltonwms@gmail.com>
 * @copyright 2015 CCABR.
 * @license   GNU General Public License
 * @link      
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<ul><li><a href="<?php echo JRoute::_('index.php?option=com_concursos&view=concurso&layout=details'); ?>">Concurso Details</a></li><li><a href="<?php echo JRoute::_('index.php?option=com_concursos&view=concurso&layout=new'); ?>">Concurso New</a></li><li><a href="<?php echo JRoute::_('index.php?option=com_concursos&view=concurso&layout=list'); ?>">Concurso List</a></li></ul>