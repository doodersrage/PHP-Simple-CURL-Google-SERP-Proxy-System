<?PHP 
require('functions.php'); 

// process submitted proxy list
if(isset($_POST['proxy-list'])){
	$results = proxies::updateProxies($_POST['proxy-list']);
}

$proxies = proxies::getProxiesTxt();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proxy List Updater</title>
</head>

<body>
<form name="proxy-updater" id="proxy-updater" method="post" enctype="application/x-www-form-urlencoded">
<label for="proxy-list">Proxy List:</label><br />
<textarea name="proxy-list" id="proxy-list" rows="10" cols="80"><?PHP echo $proxies; ?></textarea><br>
<input type="submit" name="submit" value="Process List"/>
</form>
<?PHP if(isset($results)) echo $results; ?>
</body>
</html>