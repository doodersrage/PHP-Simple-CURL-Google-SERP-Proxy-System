<?PHP
//// enabled error output
//ini_set('display_errors', 1);
//error_reporting(E_ALL | E_NOTICE);

// include required classes
require('classes/file.php');
require('classes/proxies.php');
require('classes/curl.php');

// set default file
file_handler::$file_name = 'lists/proxies.txt';
