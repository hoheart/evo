<?php

namespace CRM;

use HHP\App;
use sms\SMSSender;
use sms\ClientManager;
use User\Login;

class DeliverNotice {

	/**
	 *
	 * @return \CRM\DeliverNotice
	 */
	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	protected function getMaterial ($valNameArr, $materialFilePath) {
		require_once App::$ROOT_DIR . 'HHP/PHPExcel/PHPExcel.php';
		$objReader = \PHPExcel_IOFactory::createReaderForFile($materialFilePath);
		$objPHPExcel = $objReader->load($materialFilePath);
		
		$sheet = $objPHPExcel->getSheet(0);
		$allColumn = $sheet->getHighestColumn();
		
		$colIndexArr = array();
		for ($i = 'A'; $i <= $allColumn; ++ $i) {
			$cell = $sheet->getCellByColumnAndRow(ord($i) - 65, 1)->getValue();
			if (array_key_exists($cell, $valNameArr)) {
				$colIndexArr[$cell] = $i;
			}
		}
		
		$ret = array();
		$allRow = $sheet->getHighestRow();
		for ($i = 2; $i <= $allRow; ++ $i) {
			foreach ($colIndexArr as $key => $val) {
				$ret[$i - 1][$key] = $sheet->getCellByColumnAndRow(ord($val) - 65, $i)->getValue();
			}
		}
		
		return $ret;
	}

	public function send ($template, $materialFilePath) {
		$receiverValName = '客户电话';
		
		$arr = explode('##', $template);
		$valNameArr = array();
		for ($i = 0; $i < count($arr); ++ $i) {
			if ($i % 2 != 0) {
				$valNameArr[$arr[$i]] = 1;
			}
		}
		$valNameArr[$receiverValName] = 1;
		
		$material = $this->getMaterial($valNameArr, $materialFilePath);
		
		$succCnt = 0;
		
		foreach ($material as $row) {
			$msg = '';
			for ($i = 0; $i < count($arr); ++ $i) {
				if (0 == $i % 2) {
					$msg .= $arr[$i];
				} else {
					$msg .= $row[$arr[$i]];
				}
			}
			
			$receiver = $row[$receiverValName];
			
			$cm = ClientManager::Instance();
			$clientInfo = $cm->getOneClient(Login::GetLoginedUserId());
			
			$sms = SMSSender::Instance();
			try {
				$sms->send($clientInfo, $receiver, $msg);
				
				++ $succCnt;
			} catch (\Exception $e) {
			}
		}
		
		return array(
			count($material),
			$succCnt
		);
	}
}