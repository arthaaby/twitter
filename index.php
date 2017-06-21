<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'kzjrK6moYoUKJM8QcGsEuMXte'); 
define('CONSUMER_SECRET', 'K8FLwDxgAlJ4CPRk5GRiQWyIo33gBAioOGt9Y9BATmorKLM3yS'); 
define('OAUTH_CALLBACK', 'http://localhost/twitter/callback.php');

if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	echo $url;
} else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");
	echo "<pre>";
	print_r($user);
	echo "string";
}
?>