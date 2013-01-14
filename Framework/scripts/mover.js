var alpha = (function ( alpha, $ ) {


	alpha.mover = function (wake) { 

		var wake_parent, to_hibrenate, movement_to_track;
            wake_parent       = wake.element.parent();
			to_hibrenate      = ["mover", "add_new_field_input", "remove_field"];
            movement_to_track = $(this.instructions.elements_to_move_to).not(wake_parent);

			alpha.track_events_on_this.prototype.hibrenate(to_hibrenate);

            movement_to_track
            .on('mousemove', function (event) { 

                var self = alpha.detect_side(event, this, 8);

                ( self.top_side? self.element.css("border-top", "2px solid #0060a2") : self.element.css("border-top", "none") );
            
                ( self.bottom_side? self.element.css("border-bottom", "2px solid #0060a2") : self.element.css("border-bottom", "none") );
            })
            .on('click', function (event) { 

                var self = alpha.detect_side(event, this, 8);  

                if ( self.top_side ) { 

                    self.element.before(wake_parent);
                    movement_to_track.off();
                    alpha.track_events_on_this.prototype.awaken(to_hibrenate);
                    $(this).css("border", "none"); 
                };

                if ( self.bottom_side ) { 

                    self.element.after(wake_parent);
                    movement_to_track.off();
                    alpha.track_events_on_this.prototype.awaken(to_hibrenate);
                    $(this).css("border", "none"); 
                };
            })
            .on('mouseleave', function (event) { 

               $(this).css("border", "none"); 
            });

	};

	return alpha;

})(alpha || {}, jQuery );