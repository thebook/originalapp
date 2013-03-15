var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.confirm = function () {
		
		var parts = alpha.front.prototype.parts;

		// parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.account_icon.self.removeClass('progress_icon_for_bar').addClass('progress_icon_for_bar_done');
		// parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.account_icon.branch.branch.circle.self.removeClass('progress_icon_circle_doing').addClass('progress_icon_circle_done');
		// parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.confirm.branch.branch.circle.self.removeClass('progress_icon_circle').addClass('progress_icon_circle_doing');
		// parts.bar.wrap.branch.branch.arrow.self.animate({ left : '234px' });

		alpha.front.prototype.parts.bar.wrap.branch.branch.arrow.self.animate({ opacity: 0 }, 400, function () { $(this).css({ display: 'none' }); });
		alpha.front.prototype.parts.bar.wrap.branch.branch.progress_popup.self.animate({ opacity: 0 }, 400, function () { $(this).css({ display: 'none' }); });
		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.self.animate({ top:'0px' }, 300);

		alpha.front.prototype.being.on_page = 'body';

	};

	return alpha;

})(alpha || {}, jQuery );