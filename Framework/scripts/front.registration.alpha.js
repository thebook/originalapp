var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.registration = function () { 

		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.self.animate({ top:'-52px' }, 300);
		alpha.front.prototype.parts.bar.wrap.branch.branch.arrow.self.css({ display: 'inline', left: '234px', opacity: 0 }).animate({ opacity: 1 }, 300);
		alpha.front.prototype.parts.bar.wrap.branch.branch.welcome_popup.self.css({ display: 'block', opacity: 0 }).animate({ opacity: 1 }, 300);
	};

	return alpha;

})(alpha || {}, jQuery );