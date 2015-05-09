<?php
use HHP\View\HTMLGenerator;
use HHP\Router\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '发送记录';
$navigate = '短息-->发送记录';
$action = '\User\Controller\SMSSenderController::sendRecord';

?>
<table class="table">
	<tr>
		<th>Column 1 Heading</th>
		<th>Column 2 Heading</th>
	</tr>
	<tr>
		<td>Row 1: Col 1</td>
		<td>Row 1: Col 2</td>
	</tr>
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
