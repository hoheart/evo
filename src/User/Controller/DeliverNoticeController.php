<?php

namespace User\Controller;

use CRM\DeliverNotice;
use HHP\IRequest;

class DeliverNoticeController extends UserBaseController {

	public function __construct () {
		parent::__construct();
	}

	public function index () {
		$this->setView('User/DeliverNotice/DeliverNotice');
	}

	public function sendSms (IRequest $req) {
		$template = $req->get('smsTemplate');
		
		$upload = $_FILES['material'];
		if (0 == $upload['error'] && $upload['size'] > 0) {
			$dn = DeliverNotice::Instance();
			
			list ($total, $succCnt) = $dn->send($template, $upload['tmp_name']);
			
			$this->setView('User/DeliverNotice/DeliverNoticeRet');
			$this->assign('total', $total);
			$this->assign('succCnt', $succCnt);
		}
	}
}