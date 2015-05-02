<?php
/*echo sha1( sha1(':"?>A34$' . 'Jnd@123*') . ':"?>A34$' );exit;*/
// ini_set ( 'display_errors', 'On' );
// error_reporting ( E_ALL );
require_once (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'HHP' . DIRECTORY_SEPARATOR . 'App.php');

$app = HHP\App::Instance();
$app->run();
?>