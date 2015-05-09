<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '马上发';
$navigate = '短息-->马上发';
$action = '\User\Controller\SMSSenderController::send';

?>
<form
	action="<?php echo $url->to('\User\Controller\SMSSenderController::send') ?>"
	method="post" id="form" enctype="multipart/form-data">
	<table class="table" style="margin-bottom: 300px">
		<tr>
			<td>接收者</td>
			<td><input name="receiver" id="receiver" type="text" /></td>
		</tr>
		<tr>
			<td>内容</td>
			<td><textarea name="content" id="content"
					style="width: 500px; height: 150px"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" id="btnSend" value="发送" /></td>
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
<?php echo $html->script('User/SMSSender.js');?>
<script type="text/javascript">
<!--
var conf = { 
		'receiver': {
			'dataType': 'Phone',
			'require' : true,
			'errmsg' : '接收者手机号必填，为11位数字。'
		} , 
		'content' : {
			'dataType' : /.{1,}/,
			'require' : true,
			'errmsg' : '短信内容必填。'
		}
	};

var dn = new SMSSender();
dn . init();
// -->
</script>
<?php
$this->endSection();
?>
