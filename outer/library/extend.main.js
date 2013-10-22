define({
	
	make : function (instructions, modules) {

		var self         = this
		this.modules     = modules
		this.use         = instructions.use
		this.route       = instructions.route
		this.main        = {
			module : {},
			being  : {},
			route  : Object.create(modules.router)
		}
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

		setTimeout(function () {
			console.log("init stuff")
			self.make_router()
		}, 1000 )
		
		return this.content.wrap.node
	},

	make_content : function (parent) {
		
		var index, part

		for (index = 0; index < this.use.length; index++) { 
			
			if (!this.components[this.use[index].name]) throw new Error("main extention does not have a component "+ this.use[index].name +" added check to see if it is included in the manifest.define or if you have spelt it correctly")
			this.main.module[this.use[index].name] = Object.create(this.components[this.use[index].name]).make({
				main   : this.main,
				pass   : this.use[index].pass,
			}, this.modules )
			parent.node.appendChild(this.main.module[this.use[index].name].body.wrap.node)
		}

		return parent
	},

	make_router : function () { 

		self = this

		this.main.route.make(function () {
			self.route_all.call(self, this)
		}).begin()
	},

	route_all : function (router) {

		if ( this.route[router.on_route] )
			this.handle_single_route({
				route  : this.route[router.on_route],
				router : router
			})
	},

	handle_single_route : function (handle) { 
		console.log("handle")
		var index, module_paramaters
		for (index = 0 ; index < handle.route.length; index++) {
			module_paramaters = ( 
				handle.route[index].pass.constructor === Function ? 
					handle.route[index].pass.call(this, handle.router) : 
					handle.route[index].pass 
			)
			this.main.module[handle.route[index].module][handle.route[index].method](module_paramaters)
		}
	},

	components : {}

});