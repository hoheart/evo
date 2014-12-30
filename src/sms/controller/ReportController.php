<?php

namespace sms\controller;

use hhp\Controller;
use hhp\view\View;
use sms\ClientManager;
use sms\ReportManager;

/**
 * 状态报告controller
 *
 * @author Jejim
 *        
 */
class ReportController extends Controller {

	public function readAction ($argv) {
		$clientManager = new ClientManager();
		$client = $clientManager->getOnlieClient();
		if (null == $client) {
			$client = $clientManager->checkClient($argv['userName'], $argv['password']);
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readReport();
		
		$view = new View('sms/SMSSender/send');
		$view->assign('reportArr', $reportArr);
		
		return $view;
	}

	public function readGatewayReport () {
		if (! $this->mRequest->isCli()) {
			exit(); // 禁止非命令行访问
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readGatewayReport();
	}
}