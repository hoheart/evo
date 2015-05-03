<?php
$arr = array();
foreach ($reportArr as $obj) {
	$arr[] = array(
		'time' => $obj->reportTime,
		'msgId' => $obj->msgId,
		'longnum' => $obj->longnum,
		'phonenum' => $obj->receiver,
		'userMsgId' => $obj->userMsgId,
		'status' => $obj->reportReadStatus,
		'errstr' => $obj->errstr
	);
}
return $arr;