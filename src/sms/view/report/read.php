<?php
$arr = array();
foreach ($reportArr as $obj) {
	$arr[] = array(
		'time' => $obj->time,
		'msgId' => $obj->msgId,
		'longnum' => $obj->longnum,
		'phonenum' => $obj->phonenum,
		'userMsgId' => $obj->userMsgId,
		'status' => $obj->status,
		'errstr' => $obj->errstr
	);
}
return $arr;