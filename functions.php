<?PHP
require 'vendor/autoload.php';
require('vendor/simple-html-dom/simple-html-dom/simple_html_dom.php');


// include required classes
require('classes/file.php');
require('classes/proxies.php');
require('classes/curl.php');

// set default file
file_handler::$file_name = 'lists/proxies.txt';
