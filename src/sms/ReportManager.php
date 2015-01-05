<?php

namespace sms;

use sms\entity\Report;
use hhp\App;
use orm\Condition;

class ReportManager {

	public function readGatewayReport () {
		$f = new SMSGatewayFactory();
		$g = $f->getDefaultGateway();
		
		$ret = $g->readReport();
		
		$orm = App::Instance()->getService('orm');
		foreach ($ret as $row) {
			$cond = new Condition('msgId=' . $row['msgId']);
			$cond->add('receiver', '=', $row['phonenum']);
			$smsArr = $orm->where('sms\entity\SMS', $cond);
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
		$c->add('readStatus', '=', '0');
		
		$orm = App::Instance()->getService('orm');
		$reportArr = $orm->where('sms\entity\Report', $c);
		foreach ($reportArr as $report) {
			$report->readStatus = Report::READ_STATUS_READ;
			$orm->save($report);
		}
		
		return $reportArr;
	}
}