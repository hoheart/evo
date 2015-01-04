<?php

namespace sms\controller;

use hhp\Controller;
use hhp\view\View;
use sms\ClientManager;
use sms\ReportManager;
use hhp\IRequest;

/**
 * 状态报告controller
 *
 * @author Jejim
 *        
 */
class ReportController extends Controller {

	public function readAction (IRequest $req) {
		$clientManager = new ClientManager();
		$client = $clientManager->getOnlieClient();
		if (null == $client) {
			$client = $clientManager->checkClient($req->get('userName'), $req->get('password'));
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readReport($client->userId);
		
		$view = new View('sms/report/read');
		$view->assign('reportArr', $reportArr);
		
		return $view;
	}

	/**
	 * 读取网关的状态报告
	 */
	public function readGatewayAction () {
		if (! $this->mRequest->isCli()) {
			exit(); // 禁止非命令行访问
		}
		
		$rm = new ReportManager();
		$reportArr = $rm->readGatewayReport();
	}
}