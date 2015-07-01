<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="vi" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="vi" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="vi" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<title>Phone Number Crawler</title>
</head>
<body>
<form action="">
	<label for="">Foody.vn's URL</label><br>
	<input name="url" type="text"/><input type="submit" value="Get info"/>
</form>
<?php
/**
 * Summary
 *
 * Description.
 *
 * @since 0.9.0
 *
 * @package
 * @subpackage 
 *
 * @author nguyenvanduocit
 */
require_once 'vendor/autoload.php';
if(array_key_exists('url', $_GET)&& !empty($_GET['url']))
{
	$url = $_GET['url'];
	$crawler = new \PhoneNumberCrawler\PhoneNumberCrawler($url);
	$post = $crawler->processPost();
	echo '<ul>';
	foreach($post as $prop =>$value){
		echo '<li><strong>'.$prop.'</strong>:'.$value.'</li>';
	}
	echo '</ul>';
}
?>
</body>
</html>