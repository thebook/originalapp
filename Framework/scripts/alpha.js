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

	alpha.detect_side = function (event, element) { 

    	var self        = new Object;
            self.parent = new Object;
            self.is     = new Object;
            self.element        = $(element);
            self.parent.self    = self.element.parent();
            self.parent.width   = Math.round(self.parent.self.width());
            self.parent.height  = Math.round(self.parent.self.height());
    		self.height         = Math.round(self.element.height());
    		self.width          = Math.round(self.element.width());
    		self.offset         = self.element.offset();
    		self.offset.left    = Math.round(self.offset.left);
    		self.offset.top     = Math.round(self.offset.top);

            self.padding_left   = Math.round(self.element.css("padding-left").replace("px", "") );
            self.padding_right  = Math.round(self.element.css("padding-right").replace("px", "") );
            self.margin_left    = Math.round(self.element.css("margin-left").replace("px", "") );
    		self.margin_right   = Math.round(self.element.css("margin-right").replace("px", "") );
            self.padding_top    = Math.round(self.element.css("padding-top").replace("px", ""));
            self.padding_bottom = Math.round(self.element.css("padding-bottom").replace("px", ""));
            self.margin_top     = Math.round(self.element.css("margin-top").replace("px", ""));
    		self.margin_bottom  = Math.round(self.element.css("margin-bottom").replace("px", ""));
            self.full_width     = ( self.width + self.padding_left + self.padding_right + self.margin_right + self.margin_left );
            self.full_height    = ( self.height + self.padding_top + self.padding_bottom + self.margin_right + self.margin_left );
			self.left_side      = ((event.pageX - self.offset.left ) - self.padding_left < 0 );
			self.right_side     = ((event.pageX - self.offset.left ) - self.padding_left > self.width );
			self.top_side       = ((event.pageY - self.offset.top  ) - self.padding_top  < 0 );
			self.bottom_side    = ((event.pageY - self.offset.top  ) - self.padding_top  > self.height );
            self.is.as_wide_as_parent = ( self.full_width  > self.parent.width  - 5 );
			self.is.as_tall_as_parent = ( self.full_height > self.parent.height - 10 );
			



            return self; 		
    };

	return alpha;

})(alpha || {}, jQuery );