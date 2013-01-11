var alpha = (function ( alpha, $ ) {

	alpha.toggle_user_field = function ( current_click ) { 

		var close_box = current_click.element.nextAll(current_click.instructions.user_field_inner_box);

		if ( current_click.element.hasClass('open') ) {

			current_click.element.removeClass('open').addClass('close') 
			close_box.css({ display : "none"}).before('<div data-function-to-call="mover" class="user_profile_toggle">Drag me, drag me</div>');
		}
		else { 

		 	current_click.element.removeClass('close').addClass('open');
			close_box.prev().remove();
			close_box.css({ display : "block" });
		}
	};

	return alpha;

})(alpha || {}, jQuery );