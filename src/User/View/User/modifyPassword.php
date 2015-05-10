<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '修改密码';
$navigate = '账户设置-->修改密码';
$action = '\User\Controller\UserController::modifyPassword';

?>
<form
	action="<?php echo $url->to('\User\Controller\UserController::modifyPassword') ?>"
	method="post" id="form" enctype="multipart/form-data">
	<table class="table" style="margin-bottom: 300px">
		<tr>
			<td>原密码</td>
			<td><input type="password" id="old_password" name="old_password" /></td>
		</tr>
		<tr>
			<td>新密码</td>
			<td><input type="password" id="password" name="password" /></td>
		</tr>
		<tr>
			<td>新密码确认</td>
			<td><input type="password" id="password1" name="password1" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" id="btnSubmit" value="确定" /></td>
		</tr>
	</table>
</form>

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
$this->section('tailScript');
?>
<?php echo $html->script('js/jquery.form.js');?>
<?php echo $html->script('js/FormChecker.js');?>
<?php echo $html->script('User/UserPage.js');?>
<script type="text/javascript">
<!--
var conf = { 
		'old_password': {
			'dataType': 'Password',
			'require' : true,
			'errmsg' : '必须输入原密码。'
		},
		'password' : {
			'dataType' : 'Password',
			'require' : true,
			'errmsg' : '必须输入新密码。'
		},
		'password1' : {
			'dataType' : 'Password1',
			'require' : true,
			'errmsg' : '两次输入的密码不一致。'
		}
	};

var dn = new UserPage();
dn.init();
//-->
</script>

<?php
$this->endSection();
?>
