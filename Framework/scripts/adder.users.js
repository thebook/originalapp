var lf_users = (function ($, lf_users) {

	lf_users.add_new_field_input = function (current_click, event) { 

		current_click.element.val("Loading...")

		$.ajax({
			type : 'GET',
			url : this.global.loader_path,
			data : { template_options : { name : "user", user_options : this.global.user_options } },
			dataType : 'html',
			success : function (response) { 
				// $(lf_users.global.user_field_box_class).last().after(response);
				// current_click.element.before(response);	
				$(response).css('opacity', '0').insertBefore(current_click.element).animate({ opacity : '1'}, 400);
				current_click.element.val("Add Field");
			}
		});

	};

	lf_users.remove_field = function (current_click, event) { 

		current_click.element.parent().fadeOut(400, function () { $(this).empty().remove();});
	}

	return lf_users;

})(jQuery, lf_users || {} );