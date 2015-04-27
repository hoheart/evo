var Jquery = new function() {
	var me = this;

	this.oldSuccessBack = null;

	this.errorBack = null;

	this.loginIntervalId = '';

	this.ajaxBack = function(data, textStatus, jqXHR) {
		if ('number' != typeof (data.errcode)) {
			return me.oldSuccessBack(data, textStatus, jqXHR);
		}

		me.procError(data);
	}

	this.procError = function(data, textStatus, jqXHR) {
		if (data.errcode > 400000 && data.errcode < 500000) {
			$('#formErrorText').html(data.errstr);
			$('#formError').show();

			if (typeof (page.onServerError) == "function") {
				if (!page.onServerError(data.errcode, data.errstr)) {
					me.procError(data, textStatus, jqXHR);
				}
			}
		} else if (data.errcode == 0) {
			return me.oldSuccessBack(data.data, textStatus, jqXHR);
		} else {
			if (null != data.exception) {
				// 说明是调试模式
				alert(data.exception);
			} else {
				window.location = '/error';
			}
		}
	}

	this.init = function() {
		var oldAjax = $.ajax;

		$.ajax = function(url, options) {
			if ('object' == typeof (url) && 'function' == typeof (url.success)) {
				me.oldSuccessBack = url.success;
				url.success = me.ajaxBack;

				me.errorBack = url.error;
			} else if ('object' == typeof (options)
					&& 'function' == typeof (options.success)) {
				me.oldSuccessBack = options.success;
				options.success = me.ajaxBack;
			}

			return oldAjax(url, options);
		}
	}
}

Jquery.init();
