<?PHP
class file_handler{
	static $file_name;
	
	// read in selected file
	public static function read(){
		
		$fh = fopen(self::$file_name, 'r');
		if(filesize(self::$file_name) > 0){
			$data = fread($fh,filesize(self::$file_name));
		} else {
			$data = '';
		}
		fclose($fh);
		
		return $data;
	}
	
	// write to selected file
	public static function write($data){
		
		$fh = fopen(self::$file_name, 'w') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
		
	}
	
	// overwrite selected file
	public static function update($data){
	
		$fh = fopen(self::$file_name, 'a') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
	
	}
	
}