var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.thank_you = function () { 

		var parts = alpha.front.prototype.parts;

		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.confirm.self.removeClass('progress_icon_for_bar').addClass('progress_icon_for_bar_done');
		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.confirm.branch.branch.circle.self.removeClass('progress_icon_circle_doing').addClass('progress_icon_circle_done');
		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.thank_you.branch.branch.circle.self.removeClass('progress_icon_circle').addClass('progress_icon_circle_doing');
		parts.bar.wrap.branch.branch.arrow.self.animate({ left : '318px' });

		// Remove the popup box
		alpha.front.prototype.parts.bar.wrap.branch.branch.arrow.self.fadeOut(300);
		alpha.front.prototype.parts.bar.wrap.branch.branch.progress_popup.self.fadeOut(300);

		// Page change
		alpha.front.prototype.being.on_page = 'thank_you';

		console.log("thank you");
	};

	return alpha;

})(alpha || {}, jQuery);