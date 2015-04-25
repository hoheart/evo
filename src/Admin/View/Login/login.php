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
<title>Shamcey - Metro Style Admin Template - shared on themelock.com</title>
<?php echo $html->css('css/bootstrap.min.css')?>
<?php echo $html->css('css/style.default.css')?>
</head>

<body class="loginpage">

	<div class="loginpanel">
		<div class="loginpanelinner">
			<div class="logo animate0 bounceIn">
				<h2>EVO短信管理平台</h2>
			</div>
			<form id="login" action="dashboard.html" method="post">
				<div class="inputwrapper login-alert">
					<div class="alert alert-error">用户名或密码错误</div>
				</div>
				<div class="inputwrapper animate1 bounceIn">
					<input type="text" name="userName" id="username" placeholder="用户名" />
				</div>
				<div class="inputwrapper animate2 bounceIn">
					<input type="password" name="password" id="password"
						placeholder="密码" />
				</div>
				<div class="inputwrapper animate2 bounceIn">
					<input type="text" name="password" id="password" placeholder="验证码"
						style="width: 100px; margin-right: 18px;" /><img alt="验证码，点击刷新"
						style="vertical-align: middle; height: 40px; margin-top: -10px;"
						src="<?php echo $url->to( '\Admin\Controller\LoginController::getLoginCaptcha' ) ;?>">
				</div>
				<div class="inputwrapper animate3 bounceIn">
					<button name="submit">登录</button>
				</div>
			</form>
		</div>
		<!--loginpanelinner-->
	</div>
	<!--loginpanel-->

	<div class="loginfooter">
		<p>&copy; 2010. 维欧短信. All Rights Reserved.</p>
	</div>

</body>
</html>

