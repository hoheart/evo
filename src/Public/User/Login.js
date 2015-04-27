function Login() {

	var me = this;

	this.init = function() {
		this.bindEvent();
	}

	this.bindEvent = function() {
		$('#imgCaptcha').click(this.onChangeCaptchaImg);
		$('#formLogin').needCheckForm(conf);
		$('#formLogin').submit(function() {
			if ($('#formLogin').checkForm()) {
				$('#formLogin').ajaxSubmit();
			}

			return false;
		});
	}

	this.onChangeCaptchaImg = function() {
		var src = $('#imgCaptcha').attr('src');
		var baseSrc = src.split('?')[0];

		$('#imgCaptcha').prop('src', baseSrc + '?' + Math.random());
	}

	this.onServerError = function(errcode, errstr) {
		if (416000 == errcode) {
			me.onChangeCaptchaImg();

			return true;
		}

		return false;
	}
}