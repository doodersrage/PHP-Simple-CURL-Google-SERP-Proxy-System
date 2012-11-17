<?PHP
class proxies{
	var $keyword = 'test';
	var $usedProxies = array();
	var $unusableProxies = array();
	
	// updates existing or submitted proxy list
	public static function updateProxies($proxylist = ''){

		if(empty($proxylist)){
			$proxies = self::getProxies();
		} else {
			$proxies = explode("\n",$proxylist);
		}
		
		$usableProxies = array();
		$testResults = '';
		foreach($proxies as $curProxy){
			
			$results = self::testProxy($curProxy);

			if($results == true){
				$usableProxies[] = $curProxy;
				$testResults .= $curProxy.' added to proxy list<br>';
			} else {
				$testResults .= $curProxy.' not usable<br>';
			}
		}
		file::fileWrite('proxies.txt',implode("\n",$usableProxies));
		
		return $testResults;
	}
	
	// gather proxy list from saved flat file then convert to array
	private function getProxies(){
		
		$proxies = file::fileRead('proxies.txt');
		
		// break proxy list into an array
		$proxies = explode("\n",$proxies);
	
		return $proxies;
	}
	
	// gather proxy list from flat file the store as string variable
	public static function getProxiesTxt(){
		
		$proxies = file::fileRead('proxies.txt');
	
		return $proxies;
	}
	
	// test selected proxy value
	private function testProxy($proxy){
		
		$results = curlResults($proxy);

		if($results[info][http_code] == 200){
			return true;
		} else {
			return false;
		}
		
	}
	
	// walkthrough list of selected proxies while testing assigned keyword
	public static function walkProxies(){
		$proxies = self::getProxies();
		
		$results = '';
		foreach($proxies as $proxy){
			$results .= self::useProxy($proxy,self::keyword);
		}
		
		return $results;
	}
	
	// test selected proxy value with assigned keyword
	private function useProxy($proxy){
		
		$results = curlResults($proxy,self::keyword);
		
		if($results[info][http_code] == 200){
			return '<div class="results">'.$results[data].'<div>';
		} else {
			return '<div class="results">Unsable to retrieve results using proxy: '.$proxy.'<div>';
		}
	
	}
	
}