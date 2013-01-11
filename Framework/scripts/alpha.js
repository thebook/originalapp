var alpha = (function ( alpha, $ ) {

	alpha.track_events_on_this = function (track_events_on, events_to_track) { 

		var thought_of_this = this.track_events_on_this.prototype;

		$(track_events_on)
		.on(events_to_track, function (event) { 

			var current_click = thought_of_this.create_current_click_object(event);

			if (current_click.has_a_function_call && typeof alpha[current_click.function_call] === 'function' && !thought_of_this.is_asleep(current_click.function_call) ) { 

				alpha[current_click.function_call].call(alpha[current_click.function_call], current_click);
			}
		});
	};

	alpha.track_events_on_this.prototype.create_current_click_object = function (the_event) {
		
		var current_click = new Object;
			current_click.element = $(the_event.target);
			current_click.function_call = current_click.element.attr('data-function-to-call');
			current_click.has_a_function_call = ( current_click.function_call? true : false );
			current_click.instructions = ( current_click.element.attr('data-function-instructions')? JSON.parse(current_click.element.attr('data-function-instructions').replace("'", "\"", "g")) : false );
			current_click.the_event = the_event;

			return current_click;
	};

	alpha.track_events_on_this.prototype.is_asleep = function (slumberer) { 

		return alpha[slumberer].prototype.sleeping = alpha[slumberer].prototype.sleeping || false;

	};

	alpha.track_events_on_this.prototype.hibrenate = function (slumberers) { 

		$.each(slumberers, 
		function (order, slumberer) { 

			alpha[slumberer].prototype.sleeping = true;

		});
	};

	alpha.track_events_on_this.prototype.awaken = function (slumberers) { 

		$.each(slumberers, 
		function (order, slumberer) { 

			alpha[slumberer].prototype.sleeping = false;

		});		
	};

	alpha.create_instruction_variable = function (instruction_name, variable_name, variable_value) { 

		alpha[instruction_name].instructions = alpha[instruction_name].instructions || new Object;

		alpha[instruction_name].instructions[variable_name] = alpha[instruction_name].instructions[variable_name] || variable_value;
	};

	return alpha;

})(alpha || {}, jQuery );