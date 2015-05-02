<?php
use HHP\View\HTMLGenerator;
use HHP\URLGenerator;
use User\Login;

$html = new HTMLGenerator();
$url = new URLGenerator();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title;?>--佳能达客户关系管理系统V1.0</title>
<?php echo $html->css('css/bootstrap.min.css')?>
<?php echo $html->css('css/style.default.css')?>
</head>

<body>

	<div class="mainwrapper">

		<div class="header">
			<div style="font-size: 18pt">
				佳能达客户关系管理系统&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 12pt">V1.0</span>
			</div>
		</div>

		<div class="leftpanel">

			<div class="leftmenu">
				<ul class="nav nav-tabs nav-stacked">
					<li class="nav-header">&nbsp;</li>
					<li class="dropdown"><a
						href="<?php echo $url->to( '\User\Controller\UserController::info' )?>"><span
							class="iconfa-pencil"></span>账户设置</a>
						<ul>
							<li
								<?php if( $action == '\User\Controller\UserController::info' ){?>
								class="active" <?php }?>><a
								href="<?php echo $url->to( '\User\Controller\UserController::info' )?>">基本信息</a></li>
							<li
								<?php if( $action == '\User\Controller\FundController::chargeRecord' ){?>
								class="active" <?php }?>><a
								href="<?php echo $url->to( '\User\Controller\FundController::chargeRecord' )?>">充值记录</a></li>
						</ul></li>
					<!-- 
					<li class="dropdown"><a
						href="<?php echo $url->to( '\User\Controller\UserController::info' )?>"><span
							class="iconfa-pencil"></span>短信</a>
						<ul>
							<li><a href="">马上发</a></li>
							<li><a href="forms.html">发送记录</a></li>
						</ul></li>
					-->
						<?php if( 2 == Login::GetLoginedUserId() ){?>
					<li class="dropdown"><a
						href="<?php echo $url->to( '\User\Controller\DeliverNoticeController::index' )?>"><span
							class="iconfa-pencil"></span> 客户关系管理</a>
						<ul>
							<li
								<?php if( $action == '\User\Controller\DeliverNoticeController::index' ){?>
								class="active" <?php }?>><a
								href="<?php echo $url->to( '\User\Controller\DeliverNoticeController::index' )?>">发货通知</a></li>
						</ul></li>
						<?php }?>
				</ul>
			</div>
			<!--leftmenu-->

		</div>
		<!-- leftpanel -->

		<div class="rightpanel">

			<ul class="breadcrumbs">
				<li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span
					class="separator"></span></li>
				<li><?php echo $navigate;?></li>
			</ul>

			<div class="maincontent">
				<div class="maincontentinner"><?php echo $mainBody;?>

					<div class="footer">
						<div class="footer-left">
							<span>&copy; 2010. EVO. All Rights Reserved.</span>
						</div>
						<div class="footer-right">
							<span>Designed by: <a href="http://www.evo-sms.com/">EVO</a></span>
						</div>
					</div>
					<!--footer-->

				</div>
				<!--maincontentinner-->
			</div>
			<!--maincontent-->

		</div>
		<!--rightpanel-->

	</div>
	<!--mainwrapper-->
</body>
<?php echo $html->script('js/jquery-1.11.2.min.js');?>
<?php echo $tailScript;?>
</html>
