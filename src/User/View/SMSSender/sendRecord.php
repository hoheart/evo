<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '发送记录';
$navigate = '短息-->发送记录';
$action = '\User\Controller\SMSSenderController::sendRecord';

?>
<form
	action="<?php echo $url->to( '\User\Controller\SMSSenderController::sendRecord' )?>">
	关键字&nbsp;&nbsp;<input type="text" name="keywords" value="" />&nbsp;&nbsp;
	<button>搜索</button>
</form>
<table class="table">
	<tr>
		<th>接收者</th>
		<th>消息内容</th>
		<th>发送时间</th>
		<th>状态</th>
	</tr>
	<?php foreach ( $msgArr as $msg ){?>
	<tr>
		<td width="100"><?php echo $msg->receiver;?></td>
		<td><?php echo $msg->content->msg;?></td>
		<td width="200"><?php echo $msg->content->createTime->format('Y-m-d H:i:s');?></td>
		<td width="50"><?php echo $msg->status;?></td>
	</tr>
	<?php }?>
</table>

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
