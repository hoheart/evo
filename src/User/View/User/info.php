<?php
$title = '账户基本信息';
$navigate = '账户-->基本信息';
$action = '\User\Controller\UserController::info';
?>

<table class="table responsive">
	<tbody>
		<tr>
			<td width="20%" class="formHead">企业名称</td>
			<td><?php echo $user->realName;?></td>
		</tr>
		<tr>
			<td class="formHead">用户名</td>
			<td><?php echo $user->name;?></td>
		</tr>
		<tr>
			<td class="formHead">联系人手机号</td>
			<td><?php echo $user->phonenum;?></td>
		</tr>
		<tr>
			<td class="formHead">余额</td>
			<td><?php echo $account->amount / 1000 . '(元)';?></td>
		</tr>
		<tr>
			<td class="formHead">创建时间</td>
			<td><?php echo $user->createTime->format( 'Y-m-d H:i:s' );?></td>
		</tr>
		<tr>
			<td class="formHead">最后登录IP</td>
			<td><?php echo $user->lastLoginIP;?></td>
		</tr>
	</tbody>
</table>
<?php foreach ( $clientArr as $client){?>
<table class="table responsive">
	<tbody>
		<tr>
			<th>用户名</th>
			<td>Internet Explorer 4.0</td>
		</tr>
	</tbody>
</table>
<?php }?>