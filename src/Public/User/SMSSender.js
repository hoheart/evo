function SMSSender() {

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
		alert('发送成功。');
	}
}