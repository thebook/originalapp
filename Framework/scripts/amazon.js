var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (current_click) { 
		
		var typed_value = current_click.element.val().toLowerCase().trim();

		$.post(
			ajaxurl,
			{ action : 'amazon', paramaters : typed_value },
			function (response) { 
				// console.log(response);
			},
			'json'
		);
	};

	return alpha;

})(alpha || {}, jQuery );	