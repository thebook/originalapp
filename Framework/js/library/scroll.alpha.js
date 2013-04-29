var alpha = (function ( alpha, $ ) {

	alpha.scroll_bar = function (wake) { 

		var self = alpha.scroll_bar.prototype;
			self.wake  = wake;
			self.part  = {};
			self.part.parent       = {};
			self.part.holder       = {};
			self.part.handle       = {};
			self.part.parent.self  = $(self.wake.parent);
			self.part.holder.self  = $(self.wake.holder);
			self.part.holder.wrap  = $(self.wake.wrap);
			self.part.parent.size  = self.wake.size;
			self.part.scroll       = $(self.wake.scroll);
			self.part.handle.self = $(self.wake.handle);
			self.part.handle.increment_by      = 5;
			self.initiate_being();
			
			alpha.observe({
				object   : self.part.handle,
				property : "space_moved",
				observer : function (change) {
					self.part.holder.self.css({ top : "-"+change.new+"%" });
				}
			});
			
			alpha.observe({
				object   : self.part.handle,
				property : "space_moved",
				observer : function (change) {
					self.part.handle.self.css({ top : change.new+"%" });
				}
			});

			self.part.holder.self.on("DOMNodeInserted", function (event) { 
				self.initiate_being();
			});

			self.part.holder.self.on("DOMNodeRemoved", function (event) { 
				setTimeout(function () { 
					self.initiate_being(); 
				}, 100);
			});

			self.part.parent.self.on("mousewheel", function (event, delta) { 
				var moved = ( delta === -1 ? self.part.handle.space_moved+self.part.handle.increment_by : self.part.handle.space_moved-self.part.handle.increment_by);
					if ( moved > self.part.handle.manuverable_space ) moved = self.part.handle.manuverable_space;
					if ( moved < 0 ) moved = 0;
					self.part.handle.space_moved = moved;
					return false;
			});

	};

	alpha.scroll_bar.prototype.initiate_being = function () { 

		this.part.holder.items = this.part.holder.self.children();
		this.part.holder.size  = this.calculate_internal_height(this.part.holder.items);

		this.part.handle.size = parseFloat((this.part.parent.size/this.part.holder.size).toFixed(4)*100);
		if ( this.part.handle.size > 100 ) this.part.handle.size = 100;
		this.part.handle.manuverable_space = 100 - this.part.handle.size;
		this.part.handle.space_moved       = this.part.handle.space_moved || 0;
		if ( this.part.handle.space_moved > this.part.handle.manuverable_space ) this.part.handle.space_moved = this.part.handle.manuverable_space;
		
		this.part.handle.self.css({ position: "relative", height : this.part.handle.size+"%" });
		this.part.parent.self.css({ height : this.part.parent.size+"px"});
		this.part.holder.self.css({ position: "relative"});
		this.part.holder.wrap.css({ height : this.part.holder.size+"px"});
	};

	alpha.scroll_bar.prototype.calculate_internal_height = function (items) {
		var size = 0;

		for (var index = 0; index < items.length; index++) {
			var item   = $(items[index]),
				height = 0;
				height += parseInt(item.css("marginTop").replace("px", ""));
				height += parseInt(item.css("marginBottom").replace("px", ""));
				height += parseInt(item.css("paddingTop").replace("px", ""));
				height += parseInt(item.css("paddingBottom").replace("px", ""));
				height += parseInt(item.css("height").replace("px", ""));
				size += height;
		};
		return size;
	};


	return alpha;

})( alpha || {}, jQuery );