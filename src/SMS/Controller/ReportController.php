<?php

namespace SMS\Controller;

use HHP\Controller;
use HHP\View\View;
use SMS\ReportManager;
use HHP\IRequest;
use User\Login;

/**
 * 状态报告controller
 *
 * @author Jejim
 *        
 */
class ReportController extends Controller {

	public function read (IRequest $req) {
		if (! Login::IsLogin()) {
			$l = Login::Instance();
			$l->loginWithoutCaptcha($req->get('userName'), $req->get('password'));
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readReport($req->get('productId'));
		
		$this->setView('SMS/Report/read', View::VIEW_TYPE_JSON);
		$this->assign('reportArr', $reportArr);
	}

	/**
	 * 读取网关的状态报告
	 */
	public function readGateway () {
		if (! $this->mRequest->isCli()) {
			exit(); // 禁止非命令行访问
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readGatewayReport();
	}
}