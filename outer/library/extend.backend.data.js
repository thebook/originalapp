define({
	
	make : function (data, modules) {

		var self         = this
		this.modules     = modules
		this.maker       = Object.create(modules.node_making_tools)
		this.settings    = data.settings
		this.class_names = {
			wrap      : "admin_content_wrap",
			menu      : "admin_content_menu",
			menu_item : "admin_content_menu_item",
		}
		this.content     = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.wrap
				},
				children : {
					menu : {
						attribute : {
							"class" : this.class_names.menu
						},
						children : function (parent) {

							return self.create_menu_items(parent)
						}
					},
					content : {}
				}	
			}
		})
		this.maker.append_parts({
			parts : this.content
		})

		return this.content.wrap.node
	},

	create_menu_items : function (parent) {

		var self = this

		for ( var index = 0; index < this.settings.tabs.length; index++)
			parent["item_"+index] = {
				node : this.maker.create_and_return_node({
					property : {
						textContent : this.settings.tabs[index].name
					},
					attribute : {
						"class"    : this.class_names.menu_item,
						"data-tab" : index
					},
					methods : {
						addEventListener : ["click", function (event) {
							if ( event.target.getAttribute("data-tab") ) 
								self.show_content(self.settings.tabs[event.target.getAttribute("data-tab")])
						}]
					}
				})
			}
			
		return parent
	},

	show_content : function (component) {
		
		if ( !this.components[component.type] ) throw new Error("backend data extention does not have a component "+ component.type +" added check to see if it is included in the manifest.define or if you have spelt it correctly")

		var module = Object.create(this.components[component.type]).make(component.pass, this.modules )

		if ( this.content.wrap.content.node.firstChild )
				this.content.wrap.content.node.firstChild.remove()

		this.content.wrap.content.node.appendChild(module)
	},

	components : {}

});