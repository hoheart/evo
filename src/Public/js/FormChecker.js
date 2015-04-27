function CheckerFnCollection() {

	this.checkPassword1 = function(value) {
		console.log('a');
		var passwdVal = $('#password').val();
		if (passwdVal && passwdVal != value) {
			return false;
		}

		return true;
	}
}

function FormChecker() {

	var me = this;

	/**
	 * 对每个表单元素进行的配置
	 */
	this.mConfig = {};

	/**
	 * 针对每个元素的配置
	 */
	this.mItemConfig = null;

	this.mCheckerCollection = new CheckerFnCollection();

	this.mTypeMap = {
		Phone : /^[1][3-8]+\d{9}/,
		Chinese : /^[u4e00-u9fa5]$/,
		EMail : /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/,
		Password : /.{6,16}/,
		Password1 : me.mCheckerCollection.checkPassword1,
		Captcha : /.{4}/
	};

	/**
	 * 表单
	 */
	this.formObj = null;

	this.mHasChecked = false;

	(function FormChecker() {

	})();

	this.needCheckForm = function(config) {
		me.formObj = this[0];

		me.mItemConfig = config;

//		$(me.formObj).submit(me.checkForm);
	};

	this.setConfig = function(config) {
		me.mConfig = config;
	}

	this.checkForm = function() {
		var errorItemArr = [];

		var inputArr = me.formObj;
		for ( var i = 0; i < inputArr.length; ++i) {
			var formItem = $(inputArr[i]);
			if (!me.checkFormItem(formItem)) {
				errorItemArr.push(formItem);
			}
		}

		if (0 != errorItemArr.length) {
			me.alertError(errorItemArr);

			me.mHasChecked = true;

			return false;
		} else {

			me.mHasChecked = true;

			return true;
		}
	};

	this.checkFormItem = function(formItem) {
		// 如果是事件调用，就是当前formItem产生的事件调用的,
		if (this != me) {
			formItem = $(this);
		}

		var ret = me.checkFormItemCore(formItem);
		if (ret) {
			// 检查通过，如果以前变红的，恢复成原来的颜色
			me.changeToNormal(formItem);
			me.hideErrstrView(formItem);
		} else if (me.mHasChecked) {
			me.changeToRed(formItem);
			me.showErrstrView(formItem);
		}

		formItem.unbind('keyup', me.checkFormItem);
		formItem.keyup(me.checkFormItem);

		return ret;
	}

	this.checkFormItemCore = function(formItem) {
		// 取得对每个元素的配置
		var id = formItem.attr('id');
		if (!id) {
			return true;
		}
		var itemConf = me.mItemConfig[id];

		if (itemConf && !itemConf['require'] && '' == formItem.val()) {
			return true;
		}

		// 1.首先检查datatype
		var dataType = itemConf ? itemConf['dataType'] : null;
		if (!dataType) {
			dataType = formItem.attr('dataType');
		}
		if (!dataType) {
			return true;
		}

		var reg = null;

		if ('RegExp' == dataType.constructor.name
				|| 'function' == typeof (dataType)) {
			reg = dataType;
		} else {
			reg = me.mTypeMap[dataType];
		}
		if (!reg) {
			return false;
		}
		if ('RegExp' == reg.constructor.name) {
			if (!formItem.val().match(reg)) {
				return false;
			}
		} else if ('function' == typeof (reg)) {
			if (!reg(formItem.val())) {
				return false;
			}
		}

		// 2.再检查范围
		var min = itemConf ? itemConf['min'] : null;
		var max = itemConf ? itemConf['max'] : null;
		if (min) {
			if (formItem.val() < min) {
				return false;
			}
		}
		if (max) {
			if (formItem.val() > max) {
				return false;
			}
		}

		// 3. 再检查长度
		var len = itemConf ? itemConf['length'] : null;
		if (len) {
			if (formItem.val().length > len) {
				return false;
			}
		}

		return true;
	};

	this.alertError = function(errorItemArr) {
		for ( var i = 0; i < errorItemArr.length; ++i) {
			var formItem = errorItemArr[i];

			me.changeToRed(formItem);

			if (0 == i) {
				me.showErrstrView(formItem);
			}
		}
	};

	this.hideErrstrView = function() {
		var layer = $('#xubox_layer56');
		layer.hide();
	};

	this.changeToNormal = function(formItem) {
		formItem.css({
			"border" : "0px",
			"outline" : "none"
		});
	}

	this.changeToRed = function(formItem) {
		formItem.css({
			"border" : "1px solid red",
			"outline" : "none"
		});
	}

	this.showErrstrView = function(formItem) {
		// 取得对每个元素的配置
		var id = formItem.attr('id');
		if (!id) {
			return;
		}
		var itemConf = me.mItemConfig[id];
		var errstr = itemConf ? itemConf['errmsg'] : '';
		if (!errstr) {
			errstr = formItem.attr('errmsg');
		}
		if (!errstr) {
			return;
		}

		var layer = $('#xubox_layer56');
		layer.find('.xubox_tipsMsg').html(errstr);
		layer.show();

		// $("#xubox_layer56 xubox_tipsMsg").text(errstr);
		// $('#xubox_layer56').show();
		var left = formItem.offset().left + 10;
		var top = formItem.offset().top - 40;
		layer.css({
			left : left,
			top : top
		});
	};
}

// 注册成jquery的插件
(function($) {
	var o = new FormChecker();
	$.fn.extend(o);
})(jQuery);
