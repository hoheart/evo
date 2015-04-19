<?php

namespace Hfc\util;

use hhp\App;
use Hfc\Util\Logger;

/**
 * 是logger的一个factory
 *
 * @author Jejim
 *        
 */
class Log {

	static public function info ($str, $module = '') {
		$logger = App::Instance()->getService('log');
		$logger->log($str, Logger::LOG_TYPE_RUN);
	}
}
?>