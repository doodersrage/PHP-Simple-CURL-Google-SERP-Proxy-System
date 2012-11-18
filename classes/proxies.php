<?PHP
class proxies{
	static $usedProxies = array();
	static $unusableProxies = array();
	
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
		file_handler::write(implode("\n",$usableProxies));
		
		return $testResults;
	}
	
	// gather proxy list from saved flat file then convert to array
	private function getProxies(){
		
		$proxies = file_handler::read();
		
		// break proxy list into an array
		$proxies = explode("\n",$proxies);
	
		return $proxies;
	}
	
	// gather proxy list from flat file the store as string variable
	public static function getProxiesTxt(){
		
		$proxies = file_handler::read();
	
		return $proxies;
	}
	
	// test selected proxy value
	private function testProxy($proxy){
		
		curl::$proxy;
		$results = curl::results();

		if($results[info][http_code] == 200){
			return true;
		} else {
			return false;
		}
		
	}
	
	// walkthrough list of selected proxies while testing assigned keyword
	public static function walkProxies(){
		$proxies = self::getProxies();
		
		// walk through available proxies
		$results = '';
		self::$usedProxies = array();
		foreach($proxies as $proxy){
			$results .= self::useProxy($proxy,self::keyword);
		}
		
		// update proxy list with only the proxies that worked
		self::updateProxies(self::$usedProxies);
		
		// save unusable proxies to text file for backup
		file_handler::$file_name = 'lists/badproxies.txt';
		file_handler::update(implode("\n",self::$unusableProxies));
		
		return $results;
	}
	
	// test selected proxy value with assigned keyword
	private function useProxy($proxy){
		
		curl::$proxy;
		$results = curl::results();
		
		if($results[info][http_code] == 200){
			self::$usedProxies[] = $proxy;
			return '<div class="results">'.$results[data].'<div>';
		} else {
			self::$unusableProxies[] = $proxy;
			return '<div class="results">Unsable to retrieve results using proxy: '.$proxy.'<div>';
		}
	
	}
	
}