<?php

namespace hhp;

interface IRequest {

	public function isHttp ();

	public function isCli ();
}
?>