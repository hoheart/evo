<?php
//echo sha1( sha1(',w2!3xCb' . '123456') . ',w2!3xCb' );exit;
// ini_set ( 'display_errors', 'On' );
// error_reporting ( E_ALL );
require_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'HHP' . DIRECTORY_SEPARATOR . 'App.php');

$app = HHP\App::Instance();
$app->run();
?>
