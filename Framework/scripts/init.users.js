var lf_users = (function ($, lf_users) {

	lf_users.init = function (track_events_on_this_body) {

		$(track_events_on_this_body)
		.on('click', function (event) {

			var current_click = lf_users.initialise_current_click_object(event);

			if (current_click.has_a_function_call && typeof lf_users[current_click.function_call] === 'function') { 

				lf_users[current_click.function_call](current_click, event); 
			}

		});
	};

	lf_users.initialise_current_click_object = function (the_click_event) { 

		var current_click = new Object;
			current_click.element = $(the_click_event.target);
			current_click.function_call = current_click.element.attr('data-function-to-call');
			current_click.has_a_function_call = ( current_click.function_call? true : false );

			return current_click;
	};

	lf_users.create_global_variable = function (variable_name, variable_value) { 

		lf_users.global = lf_users.global || new Object;

		lf_users.global[variable_name] = lf_users.global[variable_name] || variable_value;
	};

	return lf_users;

})(jQuery, lf_users || {} );