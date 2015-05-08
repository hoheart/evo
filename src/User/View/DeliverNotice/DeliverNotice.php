<?php
use HHP\View\HTMLGenerator;
use HHP\URLGenerator;

$html = new HTMLGenerator();
$url = new URLGenerator();

$title = '发货通知';
$navigate = '客户关系管理-->发货通知';
$action = '\User\Controller\DeliverNoticeController::index';

?>
<form
	action="<?php echo $url->to('\User\Controller\DeliverNoticeController::sendSms') ?>"
	method="post" id="form" enctype="multipart/form-data">
	<table class="table" style="margin-bottom: 300px">
		<tr>
			<td>内容模板</td>
			<td><textarea name="smsTemplate" id="smsTemplate"
					style="width: 500px; height: 150px">尊敬的合作伙伴：您在我公司所采购的本批货已出库，货物件数：##货物件数##，货单号：##货单号##，物流公司：##物流公司##，电话：##电话##。预计3天左右到货，请注意查收，到货有异议请及时沟通联系。感谢您对佳能达的信赖与支持！祝您生意兴隆！</textarea></td>
		</tr>
		<tr>
			<td>物流资料</td>
			<td><input type="file" id="material" name="material" /></td>
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
			'dataType' : /.{1,}/,
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
