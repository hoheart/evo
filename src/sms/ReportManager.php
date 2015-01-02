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
			$r = new Report();
			$r->time = $row['time'];
			$r->msgId = $row['msgId'];
			$r->longnum = $row['longnum'];
			$r->userId = $row['userMsgId'];
			$r->status = $row['status'];
			$r->errstr = $row['errstr'];
			
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