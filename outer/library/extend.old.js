define({
	
	make : function (instructions, modules) {

		var self         = this
		this.modules     = modules
		this.setup       = instructions
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			wrap      : "main",
		}
		this.content     = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.wrap
				},
			}
		})

		this.maker.append_parts({
			parts : this.content
		})

		// setTimeout(function () {
			self.setup.modules.app.make( 
				self.setup.modules.alpha, 
				window.jQuery, 
				self.setup.include, 
				self.setup.path,
				this.content.wrap.node )
		// }, 1000 )
		
		return this.content.wrap.node
	},

});