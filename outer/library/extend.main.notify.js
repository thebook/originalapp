define({

	make : function (module, modules) { 

		var self         = this;
		this.main        = module.main
		this.setup       = module.pass
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			main                    : "load",
		}

		this.body = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.main
				}
			}
		})
		
		this.maker.append_parts({
			parts : this.body
		})

		return this
	},

	notify : function (text) {

		var self = this

		this.animation.animate({
			element : this.body.wrap.node,
			property: ["opacity"],
			from    : [0],
			to      : [1],
			how_long: this.setup.animation_speed,
			easing  : "easeInQuad",
		})

		this.body.wrap.node.style.display = "block" 
		this.body.wrap.node.textContent   = text

		window.setTimeout(function () { 
			
			self.animation.animate({
				element : self.body.wrap.node,
				property: ["opacity"],
				from    : [1],
				to      : [0],
				how_long: self.setup.animation_speed,
				easing  : "easeInQuad",
			})

			window.setTimeout(function () { 
				self.body.wrap.node.style.display = "none" 
				self.body.wrap.node.textContent   = ""
			}, self.setup.animation_speed )
			
		}, this.setup.duration )
	}
});	