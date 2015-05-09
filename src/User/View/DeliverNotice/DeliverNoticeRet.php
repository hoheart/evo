<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '发货通知';
$navigate = '客户关系管理-->发货通知';
$action = '\User\Controller\DeliverNoticeController::index';

?>
<div style="border: solid 1px #DDD; padding: 20px 30px;">总共<?php echo $total;?>条信息，发送成功<?php echo $succCnt;?>条。</div>
<div style="margin: 30px 0px 100px 0px">
	<a href="javascript:history.go(-1)">返回</a>
</div>
<?php
$this->section('tailScript');
?>
<?php echo $html->script('js/jquery.form.js');?>
<?php echo $html->script('js/FormChecker.js');?>
<?php echo $html->script('User/DeliverNotice.js');?>
<script type="text/javascript">
<!--
var conf = { 
		'smsTemplate': {
			'dataType': /.{20,250}/,
			'require' : true,
			'errmsg' : '短信模板必填，为20～250个字符。'
		} , 
		'material' : {
			'dataType' : /.*/,
			'require' : true,
			'errmsg' : '必须上传资料文件。'
		}
	};

var dn = new DeliverNotice();
dn.init();
//-->
</script>

<?php
$this->endSection();
?>