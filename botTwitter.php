<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

header('Content-Type: text/html; charset=utf-8');

include_once 'thirdparty/twitter-api-php/TwitterAPIExchange.php';
include_once 'config/twitterCredentials.php';
include_once 'config/dbConfig.php';
include_once 'config/database.php';
include_once 'config/botConfig.php';
include_once 'table/lexique.php';
include_once 'random.php';

//header('Content-Type: text/html; charset=utf-8');

/** Set access tokens here - see: https://apps.twitter.com/ **/

$tweet = getPhrasing();

// Post the tweet
$postfields = array(
    'status' => $tweet);
$url = "https://api.twitter.com/1.1/statuses/update.json";
$requestMethod = "POST";

$twitter = new TwitterAPIExchange($APIsettings);
echo $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();