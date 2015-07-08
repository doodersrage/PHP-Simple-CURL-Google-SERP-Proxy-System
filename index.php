<?PHP 
error_reporting(-1);
ini_set('display_errors', 'On');

require('functions.php'); 

if(isset($_POST['keywords'])){
	curl::$keyword = $_POST['keywords'];
	$results = proxies::walkProxies();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multi Proxy Google SERP Crawler</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<style>
.results{
	width:100%;
	margin:10px;
}
</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<form name="serp-crawler" id="serp-crawler" method="post" enctype="application/x-www-form-urlencoded">
				<label for="keywords">Keywords:</label><input class="form-control" type="text" name="keywords" id="keywords" />
				<input class="btn btn-default" type="submit" name="submit" value="Search!" />
			</form>
			<?PHP if(isset($results)) echo $results; ?>
		</div>
	</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>