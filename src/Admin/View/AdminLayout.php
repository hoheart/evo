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
<title><?php echo $title;?></title>
<?php echo $html->css('css/bootstrap.min.css')?>
<?php echo $html->css('css/style.default.css')?>
</head>

<body>

	<div class="mainwrapper">

		<div class="header">
			<div style="font-size: 18pt">
				管理系统&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 12pt">V1.0</span>
			</div>
		</div>

		<div class="leftpanel">

			<div class="leftmenu">
				<ul class="nav nav-tabs nav-stacked">
					<li class="nav-header">菜单</li>
					<li class="dropdown"><a href=""><span class="iconfa-pencil"></span>
							账户设置</a>
						<ul>
							<li><a href="forms.html">基本信息</a></li>
							<li><a href="forms.html">充值</a></li>
							<li><a href="forms.html">消费记录</a></li>
						</ul></li>
					<li class="dropdown"><a href=""><span class="iconfa-pencil"></span>
							特色业务</a>
						<ul>
							<li><a href="forms.html">短信群发</a></li>
						</ul></li>
				</ul>
			</div>
			<!--leftmenu-->

		</div>
		<!-- leftpanel -->

		<div class="rightpanel">

			<ul class="breadcrumbs">
				<li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span
					class="separator"></span></li>
				<li>Dashboard</li>
			</ul>

			<div class="maincontent">
				<div class="maincontentinner">

					<div class="footer">
						<div class="footer-left">
							<span>&copy; 2010. Evo. All Rights Reserved.</span>
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
</html>
