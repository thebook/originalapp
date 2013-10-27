define({
	
	make : function (instructions, modules) { 

		var self         = this
		this.settings    = {
			use   : instructions.use,
			admin : instructions.sign_in,
		}
		this.open        = true
		this.request     = modules.request
		this.modules     = modules
		this.animate     = modules.animator
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			admin_wrap         : "admin_wrap",
			admin_list         : "admin_list",
			admin_list_item    : "admin_list_item",
			admin_content      : "admin_content",
			admin_back_button  : "admin_back_button",
			admin_notification : "admin_notification",
			admin_input        : "admin_input",
			admin_button       : "admin_button",
			admin_opener       : "admin_open"
		}

		this.main        = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.admin_wrap
				}, 
				children : {
					opener : {
						attribute : {
							"class" : this.class_names.admin_opener
						},
						methods : {
							addEventListener : ["click", function (event) { 
								self.open_admin()
							}]
						},
					},
					login: {
						style : {
							display : "block"
						},
						attribute : {
							"class" : this.class_names.admin_list
						},
						children : {
							back : {
								property : {
									textContent : "Back",
								},
								attribute : {
									"class" : self.class_names.admin_back_button,
								},
								methods : {
									addEventListener : ["click", function (event) { 
										self.close_admin()
									}]
								}
							},
							notification : {
								property : {
									textContent : "Log In"
								},
								attribute : {
									"class" : this.class_names.admin_notification
								},
							},
							user     : {
								type      : "input",
								attribute : {
									"class" : this.class_names.admin_input,
								},
							},
							password : {
								type      : "input",
								attribute : {
									"class" : this.class_names.admin_input,
									"type"  : "password",
								},
								methods : {
									addEventListener : ["keypress", function (event) { 
										
										if ( event.keyCode === 13 ) {
											self.admin_notify("Checking...")
											self.search_for_user()
										}
									}]
								}
							},
							go : {
								property : {
									textContent : "Go"
								},
								attribute : {
									"class" : this.class_names.admin_button
								},
								methods : {
									addEventListener : ["click", function () { 
										self.admin_notify("Checking...")
										self.search_for_user()
									}]
								}
							}
						}
					},
					list : {
						style : {
							display : "none"
						},
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
									},
									methods : {
										addEventListener : ["click", function (event) { 
											self.close_admin()
										}]
									}
								})
							}

							return self.add_components(parent)
						}
					},
					content : {
						attribute : {
							"class" : this.class_names.admin_content
						},
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

	search_for_user : function () { 

		var request 

		user    = {
			name  : this.main.wrap.login.user.node.value,
			value : this.main.wrap.login.password.node.value,
		}
		self    = this
		request = Object.create(this.request)
		request = request.make()
		request.send({
			url  : this.settings.admin.path,
			data : this.settings.admin.data,
			type : "GET"
		}).then(function (then) {

			var true_user 

			true_user = JSON.parse(then.change.target.response)["return"]
			if ( user.name === true_user[0].value && user.value === true_user[1].value ) { 
				self.admin_notify("Pass")
				self.hide_admin_and_show_list()
			} else {
				self.admin_notify("Wrong Cred")
			}	
		})
	},

	hide_admin_and_show_list : function () { 
		this.main.wrap.login.node.style.display = "none"
		this.main.wrap.list.node.style.display  = "block"
	},

	admin_notify : function (text) { 
		this.main.wrap.login.notification.node.textContent = text
	},

	close_admin : function () { 
		this.open = false
		this.main.wrap.node.parentElement.style.left    = "-99.5%"
		this.main.wrap.node.parentElement.style.opacity = "0"
		this.main.wrap.opener.node.style.display        = "block"
	},

	open_admin : function () {
		this.main.wrap.node.parentElement.style.left    = "0"
		this.main.wrap.node.parentElement.style.opacity = "1"
		this.main.wrap.opener.node.style.display        = "none"
	},

	components : {}

});