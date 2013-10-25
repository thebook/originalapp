define({

	make : function (instructions, modules) {

		var self         = this
		this.setup       = instructions
		this.request     = modules.request
		this.maker       = Object.create(modules.node_making_tools)
		this.option      = {
			value_reference : {}
		}
		this.class_names = this.maker.merge_objects({
			default_object : {
				wrap               : "options_wrap",
				box                : "options_box",
				box_title          : "options_box_title",
				box_description    : "options_box_description",
				box_option_textbox : "options_box_option_textbox",
				box_option_button  : "options_box_button",
			},
			new_object     : this.setup.class_names || {}
		})

		this.retrieve_and_create_a_value_referene_for_every_option()

		this.main  = this.maker.create_parts({
			wrap : {
				attribute : { 
					"class" : this.class_names.wrap
				},
				children : function (parent) {

					for (var index = 0; index < self.setup.options.length; index++)
						parent[self.setup.options[index].name] = self.create_option({
							index  : index,
							definition : self.setup.options[index]
						})

					return parent
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this.main.wrap.node
	},

	retrieve_and_create_a_value_referene_for_every_option : function () {

		var index

		index   = 0

		for (var index = 0; index < this.setup.options.length; index++)
			this.retrieve_and_create_a_value_reference_for_option(this.setup.options[index])

	},

	retrieve_and_create_a_value_reference_for_option : function (option) {

		var request, self

		self    = this
		request = Object.create(this.request)

		request.make().send({
			url  : option.retrieve.path || this.setup.main_submit_path,
			data : option.retrieve.paramaters,
			type : "GET",
		}).then(function (response) {

			var sort_method, value

			sort_method                              = option.retrieve.sort || self.setup.main_sort_method
			value                                    = sort_method.call(self, response.change)
			self.option.value_reference[option.name] = value
			self.set_option_value({
				name : option.name,
				value: value
			})
		})
	},

	set_option_value : function (option) {
		this.main.wrap[option.name].control.node.value = option.value
	},

	submit_option : function (option) { 
		
		var request, self
		
		self    = this
		request = Object.create(this.request)
		request.make().send({
			url  : this.setup.main_submit_path,
			data : {
				action : this.setup.options[option.index].submit.action,
				method : this.setup.options[option.index].submit.method,
				paramaters : {
					name  : this.setup.options[option.index].submit.name,
					value : option.value
				}
			},
			type : "POST",
		}).then(function (response) {

		})
	},

	create_option : function (option) {

		var option, self

		self   = this
		option = this.maker.create_parts({
			box : {
				attribute : {
					"class" : this.class_names.box
				},
				children : {
					title : {
						property : {
							textContent : option.definition.title,
						},
						attribute : {
							"class" : this.class_names.box_title
						},
					},
					description : {
						property : {
							textContent : option.definition.description,
						},
						attribute : {
							"class" : this.class_names.box_description
						},
					},
					control : {
						type      : "textarea",
						property  : {
							textContent : this.option.value_reference[option.definition.name]
						},
						attribute : {
							"class" : this.class_names.box_option_textbox
						},
					},
					ok : {
						property : {
							textContent : "save",
						},
						attribute : {
							"class"      : this.class_names.box_option_button,
							"data-index" : option.index
						},
						methods : {
							addEventListener : ["click", function (event) { 
								if ( name = event.target.getAttribute("data-index") )
									self.submit_option({
										index : event.target.getAttribute("data-index"),
										value : event.target.previousSibling.value
									})
							}]
						}
					},
					reset : {
						property : {
							textContent : "reset",
						},
						attribute : {
							"class"     : this.class_names.box_option_button,
							"data-name" : option.definition.name
						},
						methods : {
							addEventListener : ["click", function (event) { 
								
								var name

								if ( name = event.target.getAttribute("data-name") )
									self.set_option_value({
										name : name,
										value: self.option.value_reference[name]
									})
							}]
						}
					}
				}
			}
		})
		
		this.maker.append_parts({
			parts : option
		})

		return option.box
	}
})