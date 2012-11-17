<?PHP
class file{
	var $file;
	
	// read in selected file
	public static function fileRead($filename){
		
		$fh = fopen($filename, 'r');
		$data = trim(fread($fh, 5));
		fclose($fh);
		
		return $data;
	}
	
	// write to selected file
	public static function fileWrite($filename,$data){
		
		$fh = fopen($filename, 'w') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
		
	}
	
	// overwrite selected file
	public static function fileUpdate($filename,$data){
	
		$fh = fopen($filename, 'w') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
	
	}
	
}