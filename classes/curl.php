<?PHP

class curl{
	static $proxy;
	static $keyword = 'test';
	
	// send remote request for file
	public static function results(){
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/search?q='.urlencode(self::$keyword)); 
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 Safari/534.16');
		curl_setopt($ch, CURLOPT_PROXY, self::$proxy);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		$c = curl_exec($ch); 
		$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$results['data'] = $c;
		$results['info'] = $info;
		curl_close ($ch);
		
		return $results;
	}
	
}