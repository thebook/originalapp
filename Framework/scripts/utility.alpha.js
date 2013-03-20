var alpha = (function ( alpha, $ ) {

	alpha.sidebar = function (instructions) { 

		instructions.content_height = instructions.content_height || 200;
		instructions.increase = instructions.increase || 5;

		var scroll_wrap, sroll_height, wrap_height, content_height, percentage_in_use;

		// remodel
		instructions.content    = { 
			self   : instructions.content,
			height : instructions.content_height
		};
		instructions.bar        = { 
			self   : instructions.bar,
			height : instructions.content_height,
			handle : {
				self : instructions.handle
			}
		};
		instructions.scroll	= {
			self : instructions.content.self.children().wrapAll('<div style="display: block; float: left; position: relative;" class="scroll_wrap"></div>').parent()
		};

		// css the css property is slow
		// instructions.scroll.self.css({ display: 'block', 'float': 'left', position: 'relative' });
		instructions.content.self.css({ height : instructions.content_height });
		instructions.bar.self.css({ height : instructions.content_height });

		instructions.scroll.height 		= instructions.scroll.self.height();

		instructions.content.difference = instructions.scroll.height - instructions.content.height;

		// set bar height
		instructions.bar.handle.percentage = ( (instructions.bar.height/instructions.scroll.height )* 100);
		instructions.bar.handle.self.css({ height: instructions.bar.handle.percentage +'%' });

		instructions.bar.handle.height     		 = instructions.bar.handle.self.height();
		instructions.bar.handle.pixel_difference = instructions.bar.height - (instructions.bar.handle.height);

		// 
		instructions.content.self.on('mousewheel', alpha.sidebar.prototype.scroll );
		console.log(instructions);
		this.sidebar.prototype.being = instructions;
	};

	alpha.sidebar.prototype.scroll = function (event, delta) {

		alpha.sidebar.prototype.being.delta = delta;
		alpha.sidebar.prototype.bar_scroll();
		alpha.sidebar.prototype.content_move();

		return false;
	};

	alpha.sidebar.prototype.bar_scroll = function () {

		alpha.sidebar.prototype.being.bar.handle.moved = parseInt(alpha.sidebar.prototype.being.bar.handle.self.css('margin-top').replace('px', ''));
				
		if ( alpha.sidebar.prototype.being.bar.handle.moved > 0 && alpha.sidebar.prototype.being.bar.handle.moved < alpha.sidebar.prototype.being.bar.handle.pixel_difference ) 
			alpha.sidebar.prototype.being.bar.handle.self.css({ 'margin-top': (alpha.sidebar.prototype.being.bar.handle.moved - (alpha.sidebar.prototype.being.delta * alpha.sidebar.prototype.being.increase )) +'px' });
		
		if ( alpha.sidebar.prototype.being.delta === -1 && alpha.sidebar.prototype.being.bar.handle.moved === 0 )
			alpha.sidebar.prototype.being.bar.handle.self.css({ 'margin-top': (alpha.sidebar.prototype.being.bar.handle.moved + alpha.sidebar.prototype.being.increase ) +'px' });
		
		if ( alpha.sidebar.prototype.being.delta === 1 && alpha.sidebar.prototype.being.bar.handle.moved > alpha.sidebar.prototype.being.bar.handle.pixel_difference ) 
			alpha.sidebar.prototype.being.bar.handle.self.css({ 'margin-top': (alpha.sidebar.prototype.being.bar.handle.moved - alpha.sidebar.prototype.being.increase ) +'px' });

	};

	alpha.sidebar.prototype.content_move = function () {

		// difference *( pixel difference / moved distance )
		alpha.sidebar.prototype.being.content.move_by = alpha.sidebar.prototype.being.content.difference * (alpha.sidebar.prototype.being.bar.handle.moved / alpha.sidebar.prototype.being.bar.handle.pixel_difference);
		alpha.sidebar.prototype.being.scroll.self.css({ top : '-'+ alpha.sidebar.prototype.being.content.move_by +'px' });
	};

	return alpha;

})(alpha || {}, jQuery );