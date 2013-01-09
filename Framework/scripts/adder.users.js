var lf_users = (function ($, lf_users) {

	lf_users.add_new_field_input = function (current_click, event) { 

		current_click.template_path = current_click.element.attr('data-ajax-template');
		
		console.log(current_click.template_path);
		
		$.get({
			url : current_click.element.attr('data-ajax-template'),
			data : { template_options : { name : "user", user_options : "" } },
			dataType : 'html',
			sucess : function (response) { 

			}
		});

		console.log(current_click);
	};

	return lf_users;

})(jQuery, lf_users || {} );