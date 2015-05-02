<?php
$title = '充值记录';
$navigate = '账户-->充值记录';
$action = '\User\Controller\FundController::chargeRecord';
?>


<table class="table responsive">
	<thead>
		<tr>
			<th width="100px">充值金额（元）</th>
			<th width="120px">充值时间</th>
			<th width="100px">充值后余额（元）</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ( $chargeRecord as $record){?>
		<tr>
			<td><?php echo $record->amount / 1000;?></td>
			<td><?php echo $record->createTime->format( 'Y-d-m H:i:s' );?></td>
			<td><?php echo $record->balance / 1000;?></td>
			<td><?php echo $record->desc;?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
