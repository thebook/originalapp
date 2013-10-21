define({
	
	make : function (instructions, modules) {

		var self         = this
		this.modules     = modules
		this.use         = instructions.use
		this.main        = {
			module : {},
			being  : {}
		}
		this.router      = Object.create(module.router)
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			wrap      : "main",
		}
		this.content     = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.wrap
				},
				children : function (parent) {
					return self.make_content(parent)
				}
			}
		})

		this.maker.append_parts({
			parts : this.content
		})
		
		return this.content.wrap.node
	},

	make_content : function (parent) {
		
		var index, part

		for (index = 0; index < this.use.length; index++) { 
			
			if (!this.components[this.use[index].name]) throw new Error("main extention does not have a component "+ this.use[index].name +" added check to see if it is included in the manifest.define or if you have spelt it correctly")
			this.main.module[this.components[this.use[index].name]] = Object.create(this.components[this.use[index].name]).make({
				main : this.main,
				pass : this.use[index].pass,
			}, this.modules )
			parent.node.appendChild(this.main.module[this.components[this.use[index].name]])
		}

		return parent
	},

	make_router : function () { 

	},

	components : {}

});