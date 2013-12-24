<?php
/**----------------------------------------------------------------
# @appName: NMEA 0183 GPGGA Simulator & Sentense Parser
# @version: 0.0.1
# @fileName: conf.php,
    App configuration settings
# @date: December 21st, 2013
# @author: Derrick Muturi
# @appUrl: http://www.github.com/nmea-gpgga-simulator-parser
# @COPYRIGHTS: Refer to License File
----------------------------------------------------------------**/

//Enable debug mode while in development mode. Change to false in production
$DEBUG = false;

if($DEBUG == true)
{
    ini_set('error_reporting', 'on');
    error_reporting(E_ALL^E_STRICT);
}
else{
    ini_set('error_reporting', 'off');
}

//App root contains full path to the application
define('APP_ROOT', dirname(dirname(__FILE__)));
//Library defines path to the application 3rd party library files
define('LIBRARY', APP_ROOT . '/library/');

define('MIN_STR_LENGTH', 14);
define('MAX_STR_LENGTH', 82);
define('SERIAL_COM_PORT', 'COM1');

?>