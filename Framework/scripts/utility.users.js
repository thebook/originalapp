var alpha = (function ( alpha, $ ) {

	alpha.toggle_user_field = function ( current_click ) { 

		var close_box = current_click.element.nextAll(current_click.instructions.user_field_inner_box);

		if ( current_click.element.hasClass('open') ) {

			current_click.element.removeClass('open').addClass('close') 
			close_box.css({ display : "none"}).before('<div data-function-to-call="mover" class="user_profile_toggle">'+ current_click.instructions.what_to_say +'</div>');
		}
		else { 

		 	current_click.element.removeClass('close').addClass('open');
			close_box.prev().remove();
			close_box.css({ display : "block" });
		}
	};

	alpha.toggle_hide = function ( current_click ) { 

		var instructions = current_click.instructions,
			close_box 	 = current_click.element.closest(instructions.parent_of_the_element).children(instructions.element_to_hide);
			
			if ( current_click.element.hasClass('open') ) { 
				
				current_click.element.removeClass('open').addClass('close');	
				close_box.css({ display : "none" });
			}
			else if ( current_click.element.hasClass('close') ) {

				current_click.element.removeClass('close').addClass('open');
				close_box.css({ display : "block" });
			}
			else { 

				current_click.element.addClass('close');	
				close_box.css({ display : "none" });
			}
	};

	return alpha;

})(alpha || {}, jQuery );