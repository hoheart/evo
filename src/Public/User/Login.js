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
				$('#formLogin').ajaxSubmit(me.onLoginSuccess);
			}

			return false;
		});
	}

	this.onLoginSuccess = function() {
		window.location = '/admin';
	}

	this.onChangeCaptchaImg = function() {
		var src = $('#imgCaptcha').attr('src');
		var baseSrc = src.split('?')[0];

		$('#imgCaptcha').prop('src', baseSrc + '?' + Math.random());
	}

	this.onServerError = function(errcode, errstr) {
		switch (errcode) {
		case 401000:
		case 402001:
			me.onChangeCaptchaImg();

			break;
		default:
			return false;

			break;
		}

		return true;
	}
}