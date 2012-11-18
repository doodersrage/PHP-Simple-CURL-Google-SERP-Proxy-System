<?PHP
//// enabled error output
//ini_set('display_errors', 1);
//error_reporting(E_ALL | E_NOTICE);

// include required classes
require('classes/file.php');
require('classes/proxies.php');

// set default file
file_handler::$file_name = 'proxies.txt';

// send remote request for file
function curlResults($proxy,$keyword = 'test'){
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/search?q='.urlencode($keyword)); 
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 Safari/534.16');
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	$c = curl_exec($ch); 
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$results[data] = $c;
	$results[info] = $info;
	curl_close ($ch);
	
	return $results;
}
