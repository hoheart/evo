<?php
use HHP\View\HTMLGenerator;
use HHP\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
if (is_array($head)) {
	foreach ($head as $item) {
		echo $item;
	}
}
?>
<title><?php echo $title;?></title>
<?php echo $html->css('css/bootstrap.min.css')?>
<?php echo $html->css('css/style.default.css')?>
</head>

<body class="loginpage">
<?php echo $mainBody;?>
</body>
<?php
$html->script('js/jquery-1.11.2.min.js');
if (is_array($footer)) {
	foreach ($footer as $item) {
		echo $item;
	}
}
?>
</html>