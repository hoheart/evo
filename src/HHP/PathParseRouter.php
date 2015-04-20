<?php

namespace HHP;

/**
 * 直接解析请求路径的路由器
 *
 * @author Hoheart
 *        
 */
class PathParseRouter implements IRouter {

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new PathParseRouter();
		}
		
		return $me;
	}

	public function getRoute (IRequest $request) {
		if (! empty($this->mRedirection)) {
			return $this->mRedirection;
		}
		
		$uri = $request->getScriptName();
		$uriLen = strlen($uri);
		
		$ctrlName = '';
		$pos = $uriLen - 1;
		
		
		$actionName = '';
		$pos = strrpos($uri, '?');
		if ($pos > 0) {
			$pos -= 1;
		} else {
			$pos = $uriLen - 1;
		}
		$pos1 = strrpos($uri, '/', $pos - $uriLen);
		$actionName = substr($uri, $pos1 + 1, $pos - $pos1);
		
		$ctrlName = '';
		while ($pos1 > 0) {
			$pos = $pos1 - 1;
			$pos1 = strrpos($uri, '/', $pos - $uriLen);
			$ctrlName = substr($uri, $pos1 + 1, $pos - $pos1);
			if (empty($ctrlName)) {
				continue;
			}
			
			break;
		}
		
		$moduleAlias = substr($uri, 1, $pos1 - $uriLen);
		
		$this->mRedirection = array(
			$moduleAlias,
			$ctrlName,
			$actionName
		);
		
		return $this->mRedirection;
	}
}