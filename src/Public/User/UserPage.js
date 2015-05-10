function UserPage() {

	var me = this;

	this.init = function() {
		$('#form').needCheckForm(conf);
		$('#form').submit(function() {
			if ($('#form').checkForm()) {
				$('#form').ajaxSubmit(me.onSucc);
			}

			return false;
		});
	}

	this.onSucc = function() {
		alert('修改密码成功。');

		$('#old_password').val('');
		$('#password').val('');
		$('#password1').val('');
	}
}