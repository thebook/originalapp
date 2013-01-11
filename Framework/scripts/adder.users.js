var alpha = (function ($, alpha) {

	alpha.add_new_field_input = function (current_click) { 

		current_click.element.val("Loading...")

		$.ajax({
			type : 'GET',
			url : current_click.instructions.ajax_path,
			data : { template_options : { name : "user", user_options : current_click.instructions.user_options } },
			dataType : 'html',
			success : function (response) { 

				$(response).css('opacity', '0').insertBefore(current_click.element).animate({ opacity : '1'}, 400);
				current_click.element.val("Add Field");
			}
		});

	};

	alpha.remove_field = function (current_click) { 

		if (current_click.the_event.type === 'click' && confirm("Are you sure you want to remove this field?")) { 

			current_click.element.parent().fadeOut(400, function () { $(this).empty().remove();});
		}
	}

	return alpha;

})(jQuery, alpha || {} );