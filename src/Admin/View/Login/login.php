<?php
use HHP\View\HTMLGenerator;
use HHP\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = 'EVO短信管理平台1.0--登录';
?>
<div class="loginpanel">
	<div class="loginpanelinner">
		<div class="logo animate0 bounceIn">
			<h2>EVO短信管理平台</h2>
		</div>
		<form id="formLogin"
			action="<?php echo $url->to( '\Admin\Controller\LoginController::login')?>"
			method="post">
			<div id="formError" class="inputwrapper login-alert">
				<div id="formErrorText" class="alert alert-error">用户名或密码错误</div>
			</div>
			<div class="inputwrapper animate1 bounceIn">
				<input type="text" name="userName" id="userName" placeholder="用户名" />
			</div>
			<div class="inputwrapper animate2 bounceIn">
				<input type="password" name="password" id="password"
					placeholder="密码" />
			</div>
			<div class="inputwrapper animate2 bounceIn">
				<input type="text" name="captcha" id="captcha" placeholder="验证码"
					style="width: 100px; margin-right: 18px;" /><img id="imgCaptcha"
					alt="验证码，点击刷新"
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
<?php
$footer[] =  $html->script('User/Login.js');
$footer[] = '<script type="text/javascript">
		var l = new Login();
		l.init();
		</script>';
?>
