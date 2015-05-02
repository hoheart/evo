<?php

namespace HHP;

class URLGenerator {

	public function to ($action) {
		$arr = explode('::', $action);
		$action = $arr[1];
		$clsName = $arr[0];
		
		$arr = explode('\\', $clsName);
		$ctrlName = array_pop($arr);
		// 去掉controller文件夹
		array_pop($arr);
		$url = '';
		foreach ($arr as $item) {
			if (empty($item)) {
				continue;
			}
			
			$url .= lcfirst($item) . '/';
		}
		$url .= lcfirst(str_replace('Controller', '', $ctrlName));
		$url .= '/' . $action;
		
		$host = $_SERVER['SERVER_NAME'];
		return 'http://' . $host . '/' . $url;
	}
}