define({

	make : function (instructions, modules) {

		var self = this

		this.maker       = Object.create(modules.node_making_tools)
		this.setup       = {
			padding      : instructions.dimensions             || 0,
			row_id       : instructions.setup.row_id           || "id",
			box_height   : instructions.dimensions.box_height  || 100,
			box_width    : instructions.dimensions.box_width   || 100,
			height       : instructions.dimensions.height      || 400,
			content_width: ( ( instructions.dimensions.box_width || 100 ) + ( instructions.dimensions.padding || 0 ) ) * instructions.box.definitions.length
		}
		this.data        = []
		this.box         = instructions.box
		this.class_names = {
			wrap                : "table_wrap",
			boxes               : "table_boxes",
			names               : "table_names",
			name                : "table_name",
			row                 : "table_row",
			box                 : "table_box",
			box_dropdown        : "table_box_dropdown",
			box_dropdown_option : "table_box_dropdown_option",
			box_textarea_wrap   : "table_box_textarea_wrap",
			box_textarea        : "table_box_textarea",
			box_textarea_button : "table_box_textarea_button",
		}		
		this.main       = this.maker.create_parts({
			wrap : {
				style : {
					height   : this.setup.height +"px",
					overflow : "scroll",
				},
				attribute : {
					"class" : this.class_names.wrap
				},
				children : {
					names   : {
						style : {
							width : this.setup.content_width +"px"
						},
						attribute : {
							"class" : this.class_names.names
						},
						children : function (parent) {

							for (var index = 0; index < self.box.definitions.length; index++)
								parent["column_"+self.box.definitions[index].name] = {
									node : this.create_and_return_node({
										style : {
											width  : self.setup.box_width +"px"
										},
										property  : {
											textContent : self.box.definitions[index].title
										},
										attribute : {
											"class" : self.class_names.name
										}
									})
								}

							return parent
						}
					},
					content : {
						style : {
							width : this.setup.content_width +"px"
						},
						attribute  : {
							"class": this.class_names.boxes
						},
					},
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this
	},

	update : function (data) {

		this.data = data

		for (var index = 0; index < data.length; index++)
			this.main.wrap.content.node.appendChild(this.create_row({
				data : data[index],
				id   : index
			}))

	},

	create_row : function (row) { 

		var self, node
		
		self = this
		node = this.maker.create_parts({	
			row : {
				attribute : {
					"class" : this.class_names.row
				},
				children : function (parent) {

					var column, definition

					for ( var column in row.data )
						if ( definition = self.get_box_definition_by_name(column) )
							parent[column] = {
								node : self.create_box_based_on_definition({
									row_id     : row.data[self.setup.row_id],
									column_name: column,
									definition : definition,
									data       : row.data[column]
								})
							}

					return parent
				}
			}
		})

		this.maker.append_parts({
			parts : node
		})

		return node.row.node
	},

	create_box_based_on_definition : function (box) {

		var definition, self, box_node, open

		open       = false
		self       = this
		definition = {
			field : {
				style : {
					height: self.setup.box_height +"px",
					width : self.setup.box_width +"px"
				},
				attribute  : {
					"class"            : this.class_names.box,
					"data-row-id"      : box.row_id,
					"data-column-name" : box.column_name,
				},
				children : {
					text : {
						property : {
							textContent : box.data
						}
					}
				}
			}
		}

		if ( box.definition.changeable && box.definition.changeable.by === "dropdown" )
			definition.field = this.extend_box_definition_into_dropdown(definition.field, box)

		if ( box.definition.changeable && box.definition.changeable.by === "text" )
			definition.field = this.extend_box_definition_into_text(definition.field, box)

		box_node = this.maker.create_parts(definition)

		this.maker.append_parts({
			parts : box_node 
		})

		return box_node.field.node
	},

	extend_box_definition_into_text : function (definition, box) {
			
		var self = this

		definition.style.cursor  = "pointer"
		definition.methods       = {
			addEventListener : ["click", function (event) {
				if ( event.target.nextElementSibling && event.target.nextElementSibling.getAttribute("data-open") )
					self.open_box_option({
						option : event.target.nextElementSibling,
						open   : event.target.nextElementSibling.getAttribute("data-open")
					})
			}]
		}
		definition.children.text_box = {
			style     : {
				width   : this.setup.box_width +"px",
				display : "none"
			},
			attribute : {
				"class"     : this.class_names.box_textarea_wrap,
				"data-open" : "false"
			},
			children  : {
				text : {
					type      : "textarea",
					property  : {
						textContent : box.data
					},
					attribute : {
						"class"     : this.class_names.box_textarea,
					},
				},
				yes : {
					property : {
						textContent : "yes"
					},
					attribute : {
						"class"     : this.class_names.box_textarea_button,
					},
					methods : {
						addEventListener : ["click", function (event) {
							
							self.update_box_value({
								event : event, 
								title : event.target.previousSibling.value,
								name  : event.target.previousSibling.value
							})

							self.open_box_option({
								option : event.target.parentNode,
								open   : event.target.parentNode.getAttribute("data-open")
							})
						}]
					}
				},
				no  : {
					property : {
						textContent : "no"
					},
					attribute : {
						"class"     : this.class_names.box_textarea_button,
					},
					methods : {
						addEventListener : ["click", function (event) {
							self.open_box_option({
								option : event.target.parentNode,
								open   : event.target.parentNode.getAttribute("data-open")
							})
						}]
					}
				}
			},
		}

		return definition
	},

	extend_box_definition_into_dropdown : function (definition, box) {

			var self = this

			definition.style.cursor = "pointer"
			definition.methods      = {
				addEventListener : ["click", function (event) {

					if ( event.target.nextElementSibling && event.target.nextElementSibling.getAttribute("data-open") )
						self.open_box_option({
							option : event.target.nextElementSibling,
							open   : event.target.nextElementSibling.getAttribute("data-open")
						})
				}]
			}
			definition.children.dropdown = {
				style     : {
					display : "none"
				},
				attribute : {
					"class"     : this.class_names.box_dropdown,
					"data-open" : "false"
				},
				methods : {
					addEventListener : ["click", function (event) {

						if ( event.target.getAttribute("data-title") ) { 
							self.update_box_value({
								event : event, 
								title : event.target.getAttribute("data-title"),
								name  : event.target.getAttribute("data-name")
							})
							self.open_box_option({
								option : event.target.parentNode,
								open   : event.target.parentNode.getAttribute("data-open")
							})
						}
					}]
				},
				children : function (parent) {

					for (var index = 0; index < box.definition.changeable.choices.length; index++) 
						parent["option_"+index] = {
							node : this.create_and_return_node({
								property : {
									textContent : box.definition.changeable.choices[index].title
								},
								attribute : {
									"data-title" : box.definition.changeable.choices[index].title,
									"data-name"  : box.definition.changeable.choices[index].name,
									"class"      : self.class_names.box_dropdown_option
								}
							})
						}

					return parent 
				}
			}

		return definition
	},

	open_box_option : function (box) {
		
		if ( box.open === "false" ) {
			box.option.style.display = "block"
			box.option.setAttribute("data-open", "true" )
		}
		else {
			box.option.setAttribute("data-open", "false" )
			box.option.style.display = "none"
		}
	},

	update_box_value : function (update) {
							
		update.event.target.parentElement.previousSibling.textContent = update.title
		this.box.submit.call(this, {
			row_id      : update.event.target.parentNode.parentNode.getAttribute("data-row-id"),
			column_name : update.event.target.parentNode.parentNode.getAttribute("data-column-name"),
			box_value   : update.name
		})
	},

	get_box_definition_by_name : function (name) {

		var index, definition

		index = 0
		definition = false

		for (; index < this.box.definitions.length; index++)
			if ( this.box.definitions[index].name === name )
				definition = this.box.definitions[index]

		return definition
	}

});