function DeliverNotice() {

	this.init = function() {
		$('#form').needCheckForm(conf);
		$('#form').submit(function() {
			if ($('#form').checkForm()) {
				if (confirm('您确定发送吗？')) {
					return true;
				}
			}

			return false;
		});
	}
}