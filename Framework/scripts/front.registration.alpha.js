var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.registration = function () { 

		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.self.animate({ top:'-52px' }, 300);
		alpha.front.prototype.registration.prototype.progress_to_icon(1);
		alpha.front.prototype.parts.bar.wrap.branch.branch.arrow.self.css({ display: 'block', opacity: 0 }).animate({ opacity: 1 }, 300);		
		alpha.front.prototype.parts.bar.wrap.branch.branch.welcome_popup.self.css({ display: 'block', opacity: 0 }).animate({ opacity: 1 }, 300);
		alpha.animate_scroll(400, 250, false, 100);
		$('.result_books').animate({ top : "800px" }, 500);

		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.back.self.css({ display : 'none', opacity : 0 });
	};

	// Could be little better & (shared state perhaps )
	alpha.front.prototype.registration.prototype.progress_to_icon = function (on_icon, wake) {

		wake			  = wake			  || {};
		on_icon      	  = on_icon -1   	  || 0;
		wake.icon_names   = wake.icon_names   || ["welcome", "account", "confirm", "thank_you", "back"];
		wake.break_points = wake.break_points || ["68px", "152px", "234px", "318px", "318px"];

		if ( on_icon > 0 ) this.complete_icon(wake.icon_names[on_icon-1]);
		if ( on_icon > 0 ) this.set_icon_to_doing(wake.icon_names[on_icon]);
		this.move_popup_arrow({ to_break_point : on_icon, break_points : wake.break_points });
	};

	alpha.front.prototype.registration.prototype.set_icon_to_doing = function (icon) { 

		alpha.front.prototype.parts
		.bar.wrap.branch.branch
		.navigation.branch.branch.wrap.branch.branch
		.progress.branch.branch[icon].branch.branch.circle.self.removeClass('progress_icon_circle').addClass('progress_icon_circle_doing');
	};

	alpha.front.prototype.registration.prototype.complete_icon = function (icon) { 
		
		icon = alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch[icon];

		icon.self.removeClass('progress_icon_for_bar').addClass('progress_icon_for_bar_done');

		icon.branch.branch.circle.self.removeClass('progress_icon_circle_doing').addClass('progress_icon_circle_done');
	};

	alpha.front.prototype.registration.prototype.move_popup_arrow = function (instructions) {

		instructions 				= instructions || {};
		instructions.to_break_point = instructions.to_break_point || 0;
		instructions.break_points   = instructions.break_points   || ["68px", "152px", "234px", "318px"];

		alpha.front.prototype.parts
		.bar.wrap.branch.branch.arrow.self.animate({ left : instructions.break_points[instructions.to_break_point] });
	};

	// Somewhat other solution
	alpha.front.prototype.registration.prototype.refill_popup_box = function (instructions) {
		
		var popup = alpha.front.prototype.parts.bar.wrap.branch.branch.progress_popup.branch.branch;

		popup.title.branch.branch.text.self.text(instructions.title);
		popup.title.branch.branch.icon.branch.icon.removeAttr("class");
		popup.title.branch.branch.icon.branch.icon.addClass(instructions.icon);
		popup.text.self.text(alpha.front.prototype.being.text[instructions.text]);
	};

	return alpha;

})(alpha || {}, jQuery );