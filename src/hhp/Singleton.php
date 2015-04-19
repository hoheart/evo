<?php

namespace hhp;

class Singleton {

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$clsName = get_called_class();
			$me = new $clsName();
		}
		
		return $me;
	}
}
?>