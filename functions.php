<?PHP

function fileRead($filename){
	
	$fh = fopen($filename, 'r');
	$data = trim(fread($fh, 5));
	fclose($fh);
	
	return $data;
}

function fileWrite($filename,$data){
	
	$fh = fopen($filename, 'w') or die("can't open file");
	fwrite($fh, $data);
	fclose($fh);
	
}

function fileUpdate($filename,$data){

	$fh = fopen($filename, 'w') or die("can't open file");
	fwrite($fh, $data);
	fclose($fh);

}

function curlResults($proxy,$keyword = 'test'){
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/search?q='.urlencode($keyword)); 
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	$c = curl_exec($ch); 
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	
	$results[data] = $c;
	$results[info] = $info;
	
	return $results;
}

function updateProxies($proxylist = ''){
	
	if($proxylist == ''){
		$proxies = getProxies();
	} else {
		$proxies = explode("\n",$proxylist);
	}
	
	$usableProxies = array();
	$testResults = '';
	foreach($proxies as $curProxy){
		
		$results = testProxy(trim($curProxy));
		
		if($results[info][http_code] == 200){
			$usableProxies[] = $curProxy;
			$testResults .= $curProxy.' added to proxy list<br>';
		} else {
			$testResults .= $curProxy.' not usable<br>';
		}
	}
	fileWrite('proxies.txt',implode("\n",$usableProxies));
	
	return $testResults;
}

function getProxies(){
	
	$proxies = fileRead('proxies.txt');
	
	// break proxy list into an array
	$proxies = explode("\n",$proxies);

	return $proxies;
}

function getProxiesTxt(){
	
	$proxies = fileRead('proxies.txt');

	return $proxies;
}

function testProxy($proxy){
	
	$results = curlResults($proxy);
	
	if($results[info][http_code] == 200){
		return true;
	} else {
		return false;
	}
	
}

function walkProxies($keyword = 'test'){
	$proxies = getProxies();
	
	$results = '';
	foreach($proxies as $proxy){
		$results .= useProxy($proxy,$keyword);
	}
	
	return $results;
}

function useProxy($proxy,$keyword = 'test'){
	
	$results = curlResults($proxy,$keyword);
	
	if($results[info][http_code] == 200){
		return '<div class="results">'.$results[data].'<div>';
	} else {
		return '<div class="results">Unsable to retrieve results using proxy: '.$proxy.'<div>';
	}

}