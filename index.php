<?PHP 
require('functions.php'); 

if(isset($_POST[keywords])){
	curl::$keyword = $_POST[keywords];
	$results = proxies::walkProxies();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multi Proxy Google SERP Crawler</title>
<style>
.results{
	width:100%;
	margin:10px;
	height:150px;
	overflow:scroll;
}
</style>
</head>

<body>
<form name="serp-crawler" id="serp-crawler" method="post" enctype="application/x-www-form-urlencoded">
<label for="keywords">Keywords:</label><input type="text" name="keywords" id="keywords" />
<input type="submit" name="submit" value="Search!" />
</form>
<?PHP if(isset($results)) echo $results; ?>
</body>
</html>