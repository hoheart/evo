#!/bin/sh

phpPath=~/app/php-5.5.19/bin/php

#读取网关的状态报告
smsIndexFile=~/www/sms/web/index.php
cmd="$phpPath $smsIndexFile /sms/report/readGateway"

echo "* * * * * $cmd" > cronfile
crontab cronfile