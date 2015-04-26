function Login() {

	this.init = function() {
		this.bindEvent();
	}

	this.bindEvent = function() {
		$('#imgCaptcha').click(this.changeCaptcha);
	}

	this.changeCaptcha = function() {
		var src = $('#imgCaptcha').attr('src');
		var baseSrc = src.split('?')[0];

		$('#imgCaptcha').prop('src', baseSrc + '?' + Math.random());
	}
}