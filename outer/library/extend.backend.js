define({
	
	make : function (instructions, modules) { 

		var self         = this
		this.settings    = {
			use : instructions.use
		}
		this.modules     = modules
		this.animate     = modules.animator
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			admin_wrap      : "admin_wrap",
			admin_list      : "admin_list",
			admin_list_item : "admin_list_item",
			admin_content   : "admin_content",
			admin_back_button: "admin_back_button",
		}

		this.main        = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.admin_wrap
				}, 
				children : {
					list : {
						attribute : {
							"class" : this.class_names.admin_list
						},
						children : function (parent) {

							parent["back"] = {
								node : this.create_and_return_node({
									property : {
										textContent : "Back",
									},
									attribute : {
										"class" : self.class_names.admin_back_button,
									}
								})
							}

							return self.add_components(parent)
						}
					},
					content : {
						attribute : {
							"class" : this.class_names.admin_content
						}
					}
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this.main.wrap.node
	},

	add_components : function (parent) {

		var self = this;

		for (var index = 0; index < this.settings.use.length; index++)
			parent[this.settings.use[index].title] = {
				node : this.maker.create_and_return_node({
					property : {
						textContent : this.settings.use[index].title
					},
					attribute : {
						"class" : this.class_names.admin_list_item,
						"data-component" : index
					},
					methods : {
						addEventListener : ["click", function (event) {
							if ( event.target.getAttribute("data-component") )
								self.add_componenet_to_content(self.settings.use[event.target.getAttribute("data-component")])
						}]
					}	
				})
			}

		return parent
	},

	add_componenet_to_content : function (component) {

		if ( !this.components[component.module] ) throw new Error("backend extention does not have a component "+ component.module +" added check to see if it is included in the manifest.define or if you have spelt it correctly")

		var module = Object.create(this.components[component.module]).make(component.pass, this.modules )
		
		if ( this.main.wrap.content.node.firstChild ) 
			this.main.wrap.content.node.firstChild.remove()
		
		this.main.wrap.content.node.appendChild(module)
	},

	components : {}

});