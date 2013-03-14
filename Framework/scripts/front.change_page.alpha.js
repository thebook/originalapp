var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.page_changer = function (property, old_page, page) {

		if ( old_page.length < 1 ) old_page = 'pages';

		if ( old_page !== page )
			$('.'+ old_page ).fadeOut(500, function () { $('.'+ page ).fadeIn(500); });
			$('#navigation_for_'+ old_page ).removeClass('with-icon-for-navigation-text-for-bar-active').addClass('navigation_text_for_bar');
			$('#navigation_for_'+ page ).removeClass('navigation_text_for_bar').addClass('with-icon-for-navigation-text-for-bar-active');

		return page;
	};

	alpha.front.prototype.change_page = function (wake, callback) {

		callback = callback || false;

		alpha.front.prototype.being.on_page = wake.instructions.page;

		if (callback)
			callback(wake.instructions.page);	
	};

	return alpha;

})(alpha || {}, jQuery );