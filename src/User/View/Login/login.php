<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '';
?>
<div class="loginpanel">
	<div class="loginpanelinner">
		<div class="logo animate0 bounceIn">
			<h2></h2>
		</div>
		<form id="formLogin"
			action="<?php echo $url->to( '\User\Controller\LoginController::login')?>"
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
					src="<?php echo $url->to( '\User\Controller\LoginController::getLoginCaptcha' ) ;?>">
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
	<p>&copy; 2010. All Rights Reserved.</p>
</div>
<div id="xubox_layer56" class="xubox_layer"
	style="position: absolute; top: 383.5px; left: 576.5px; height: auto; width: auto; margin-left: 0px; z-index: 19891070; display: none;">
	<div class="xubox_main"
		style="position: relative; height: 26px; z-index: 19891070;">
		<div class="xubox_tips"
			style="position: relative; height: 20px; line-height: 20px; min-width: 12px; padding: 3px 10px; font-size: 12px; border-radius: 3px; box-shadow: rgba(0, 0, 0, 0.298039) 1px 1px 3px; color: rgb(255, 255, 255); background-color: rgb(255, 153, 0);">
			<div class="xubox_tipsMsg"
				style="color: rgb(255, 255, 255); height: 20px; font-family: 'Hiragino Sans GB', 'Microsoft YaHei', 宋体, Helvetica, Arial, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">请输入正确手机号</div>
			<i class="layerTipsG layerTipsT"
				style="position: absolute; width: 0; height: 0; border-width: 8px; border-color: transparent; border-style: dashed; bottom: -8px; border-right-color: rgb(255, 153, 0);"></i>
			<br class="Apple-interchange-newline">
		</div>
	</div>
</div>
<?php
ob_start();

echo $html->script('js/jquery.form.js');
echo $html->script('js/FormChecker.js');
?>
<script type="text/javascript">var conf = { 
		'userName': {
			'dataType': /.{1,40}/,
			'require' : true,
			'errmsg' : '用户名不能为空，最大为40个字符。'
		} , 
		'password' : {
			'dataType' : 'Password',
			'require' : true,
			'errmsg' : '密码为6-16个字符，必填。'
		},
		'captcha' : {
			'dataType' : 'Captcha',
			'require' : true,
			'errmsg' : '验证码为4个字符，必填。'
		}
	};
</script>

<?php
echo $html->script('User/Login.js');
?>
<script type="text/javascript">
	var page = new Login();
	page.init();
</script>
<?php
$footer = ob_get_clean();
?>

