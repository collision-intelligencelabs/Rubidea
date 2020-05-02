<?php
require_once("../config/Config.inc.php");
require_once("../logger/Logger.class.php");
define("ABSPATH", "../");
$payload = $_SERVER['QUERY_STRING'];
$url_referer = $_SERVER["HTTP_REFERER"];

if(!empty($payload)){

	$log = new Logger();
	$log->add($url_referer, $payload);
	header("location: " . HTTP_REDIRECT);
}else{

	header("location: " . HTTP_REDIRECT);
}
