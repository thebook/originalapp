var alpha = (function ( alpha, $ ) {


	alpha.mover = function (wake) { 

		var wake_parent, to_hibrenate;  
            wake_parent  = wake.element.parent();
			to_hibrenate = ["mover", "add_new_field_input", "remove_field"];

			alpha.track_events_on_this.prototype.hibrenate(to_hibrenate);

            this.prototype.handle_sides($(this.instructions.elements_to_move_to).not(wake_parent));
	};

    alpha.mover.prototype.handle_sides = function (elements_to_detect) { 

        elements_to_detect.on('mousemove', function (event) { 

            var self = alpha.detect_side(event, this);

            ( self.top_side? self.element.css("border-top", "2px solid #0060a2") : self.element.css("border-top", "none") );
            
            ( self.bottom_side? self.element.css("border-bottom", "2px solid #0060a2") : self.element.css("border-bottom", "none") );



        })
        .on('mouseleave', function (event) { 

           $(this).css("border", "none"); 

        });
    };

	return alpha;

})(alpha || {}, jQuery );