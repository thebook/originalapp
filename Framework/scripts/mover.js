var alpha = (function ( alpha, $ ) {


	alpha.mover = function (wake) { 

		var wake_parent = wake.element.parent(), 
			hibrenation_list = ["mover", "add_new_field_input", "remove_field"];

			alpha.track_events_on_this.prototype.hibrenate(hibrenation_list);

			this.prototype.detect_side($(this.instructions.elements_to_move_to).not(wake_parent));

	};

    alpha.mover.prototype.detect_side = function (instructions_to_detect) { 

    	instructions_to_detect.on('mousemove', function (event) { 

    		var self = new Object;
    			self.height        = Math.round($(this).height()),
    			self.width         = Math.round($(this).width() );
    			self.offset        = $(this).offset();
    			self.offset.left   = Math.round(self.offset.left);
    			self.offset.top    = Math.round(self.offset.top);
    			self.padding_left  = Math.round($(this).css("padding-left").replace("px", "") );
    			self.padding_right = Math.round($(this).css("padding-right").replace("px", ""));
				self.left_side     = ((event.pageX - self.offset.left ) - self.padding_left < 0 );
				self.right_side    = ((event.pageX - self.offset.left ) - self.padding_left > self.width );
    			self.horizontal_padding = ( self.padding_left + self.padding_right );
				

    		// console.log(self.width - (event.pageX - self.offset.left));
    		// console.log(self);
    		console.log(self.left_side);
    		console.log(self.right_side);
    		// console.log(self);
    		// console.log(self);
    		// console.log((event.pageX - self.offset.left ) - self.padding_left);
    		// console.log(self.right_side);
    		// console.log(event.pageX - self.offset.left);
    		// console.log(self.height);
    		// console.log(self.width);
    		// console.log(self.width - ( event.pageX - self.offset.left));
    		// slef.is_on_the_left = (self.width - ( event.pageX - self.offset.left)) )
    		// console.log(event.pageX - self.offset.left);
    		// console.log(event.pageY - self.offset.top );
    		
    	});
    };

	return alpha;

})(alpha || {}, jQuery );