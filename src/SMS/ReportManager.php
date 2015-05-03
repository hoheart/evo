<?php

namespace sms;

use hhp\App;
use orm\Condition;
use sms\entity\SMS;

class ReportManager {

	public function readGatewayReport () {
		$f = new SMSGatewayFactory();
		$g = $f->getDefaultGateway();
		
		$ret = $g->readReport();
		
		$orm = App::Instance()->getService('orm');
		foreach ($ret as $row) {
			$cond = new Condition('msgId=' . $row['msgId']);
			$cond->add('receiver', '=', $row['phonenum']);
			$smsArr = $orm->where('SMS\Entity\SMS', $cond);
			$r = $smsArr[0];
			
			$r->reportTime = $row['time'];
			$r->longnum = $row['longnum'];
			$r->status = $row['status'];
			$r->errstr = $row['errstr'];
			$r->receiver = $row['phonenum'];
			
			$orm->save($r);
		}
	}

	public function readReport ($userId) {
		$c = new Condition('userId=' . $userId);
		$c->add('reportReadStatus', '=', '0');
		
		$orm = App::Instance()->getService('orm');
		$reportArr = $orm->where('SMS\Entity\SMS', $c);
		foreach ($reportArr as $report) {
			$report->reportReadStatus = SMS::READ_STATUS_READ;
			$orm->save($report);
		}
		
		return $reportArr;
	}
}