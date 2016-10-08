<?php
/**
  * Debug class
  *
  * PHP version 5
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    SVN: $Id$
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */

/**
  * ZC_Controller_Plugin_Header class
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    Release: @package_version@
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */
class Debug
{
    /**
     * Debug helper function.  This is a wrapper for var_dump() that adds
     * the <pre /> tags, cleans up newlines and indents, and runs
     * htmlentities() before output, also dumps the content in file if necessary
     *
     * @param  mixed  $var   The variable to dump.
     * @param  string $label OPTIONAL Label to prepend to output.
     * @param  string $type  OPTIONAL Where to send the output. Defult echo, can be also html or
	 *						fire (for firePHP extension in mozzila)
     * @return string
     */
	public static function dump($var, $label = '', $type = 'echo')
    {
		switch ($type)
		{
			default:
			case "echo":
				$content = xdebug_call_file().":".
							xdebug_call_line()." from ".
							xdebug_call_function().
							Zend_Debug::dump($var, $label, false);
				echo $content;
				break;
			case "html":
				$content = xdebug_call_file().":".
							xdebug_call_line()." from ".
							xdebug_call_function().
							Zend_Debug::dump($var, $label, false);


				$appCon = new Zend_Config_Ini(APPLICATION_INI, APPLICATION_ENV);
				file_put_contents($appCon->log->path.$label.".html", $content.'<br/><br/>', FILE_APPEND);
				break;
			case "fire":

				$writer = new Zend_Log_Writer_Firebug();
				$logger = new Zend_Log($writer);

				$content = xdebug_call_file().":".
							xdebug_call_line()." from ".
							xdebug_call_function()." ".
							$label.": ".$var;

				$logger->info($content);
				break;
		}

		return $content;
    }
}