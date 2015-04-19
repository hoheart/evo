<?php

namespace util\captcha;

interface ISmsContentCreator {

	public function createSmsContent ($captcha);
}