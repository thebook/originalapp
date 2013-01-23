var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (current_click) { 
		
		var typed_value = $('#'+ current_click.instructions.input_id).val().trim(),
			search_by   = (alpha._is_number(typed_value)? current_click.instructions.numerical_search : 'keywords' );
		console.log(typed_value);
		// console.log(search_by_function);

		$.post(
			ajaxurl,
			{ 
				action     : 'amazon', 
				paramaters : { 
					typed       : typed_value, 
					search_by   : search_by, 
					search_for  : current_click.instructions.search_for, 
					filter_name : current_click.instructions.filter_by  
			}},
			function (response) { 
				console.log(response);
			},
			'json'
		);
	};

	return alpha;

})(alpha || {}, jQuery );	