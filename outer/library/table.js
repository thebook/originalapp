define({

	make : function (instructions, modules) {

		var self = this

		this.maker       = Object.create(modules.node_making_tools)
		this.data        = []
		this.box         = instructions.box
		this.setup       = this.setup_definition(instructions)
		this.option      = {
			selected : []
		}

		this.class_names = {
			wrap                     : "table_wrap",
			boxes                    : "table_boxes",
			names                    : "table_names",
			name                     : "table_name",
			row                      : "table_row",
			box                      : "table_box",
			box_dropdown             : "table_box_dropdown",
			box_dropdown_option      : "table_box_dropdown_option",
			box_textarea_wrap        : "table_box_textarea_wrap",
			box_textarea             : "table_box_textarea",
			box_textarea_button      : "table_box_textarea_button",
			box_option_button        : "table_box_option_button",
			box_option_button_selected : "table_box_option_button_selected",
			box_option_dropdown      : "table_box_option_dropdown",
			box_option_dropdown_box  : "table_box_option_dropdown_box",
			box_option_dropdown_item : "table_box_option_dropdown_item",
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

							if ( self.box.options ) 
								parent["option_column"] = {
									node : this.create_and_return_node({
										style : {
											width  : self.setup.option_width +"px"
										},
										attribute : {
											"class" : self.class_names.name
										}
									})
								}
								
							for (var index = 0; index < self.box.definitions.length; index++) { 

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

	setup_definition : function (instructions) {

		var setup = this.maker.merge_objects({
			default_object : {
				padding      : 0,
				row_id       : "id",
				box_height   : 100,
				box_width    : 100,
				height       : 400,
				option_width : 30,
				option_text  : "more",
			},
			new_object : instructions.setup
		})
		
		setup.content_width = ( setup.box_width + setup.padding ) * instructions.box.definitions.length
		if ( this.box.options ) 
			setup.content_width = setup.content_width + ( setup.option_width + setup.padding )
		
		return setup
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
					
					if ( self.box.options ) 
						parent["option"] = {
							node : self.assign_option_to_row({
								index : row.id
							})
						}

					for (var index = 0; index < self.box.definitions.length; index++)
						if ( definition = self.get_box_definition_by_name(self.box.definitions[index].name) )
							parent[self.box.definitions[index].name] = {
								node : self.create_box_based_on_definition({
									row_id     : row.data[self.setup.row_id],
									column_name: self.box.definitions[index].name,
									definition : definition,
									data       : row.data[self.box.definitions[index].name]
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

	assign_option_to_row : function (row) {
		
		var option, self

		self   = this
		option = this.maker.create_parts({
			wrap : {
				style : {
					height: this.setup.box_height +"px",
					width : this.setup.option_width +"px"
				},
				attribute : {
					"class" : this.class_names.box,
				},
				children : {
					button : {
						attribute : {
							"class"    : this.class_names.box_option_button,
							"data-row" : row.index
						},
						methods : {
							addEventListener : ["click", function (event) {
								if ( event.target.getAttribute("data-row" ) ) 
									self.mark_row_as_selected_or_unselected({
										index  : row.index,
										button : event.target
									})
							}]
						}
					},
					dropdown : {
						property : {
							textContent : this.setup.option_text
						},
						attribute : {
							"class" : this.class_names.box_option_dropdown,
						},
						methods : {
							addEventListener : ["click", function (event) { 
								if ( event.target.firstElementChild && event.target.firstElementChild.getAttribute("data-open") )
									self.open_box_option({
										option : event.target.firstElementChild,
										open   : event.target.firstElementChild.getAttribute("data-open")
									})
							}]
						},
						children : {
							dropbox : {
								style : {
									display : "none"
								},
								attribute : {
									"class"     : this.class_names.box_option_dropdown_box,
									"data-open" : "false"
								},		
								methods : {
									addEventListener : ["click", function (event) { 
										if ( event.target.getAttribute("data-option") )
											self.perform_an_option({
												index : event.target.getAttribute("data-option") 
											})
									}]
								},
								children : function (parent) {

									for (var index = 0; index < self.box.options.length; index++)
										parent["option_dropdown"+index] = {
											node : this.create_and_return_node({
												property : {
													textContent : self.box.options[index].name
												},
												attribute : {
													"data-option" : index,
													"class"       : self.class_names.box_option_dropdown_item
												}
											})
										}

									return parent
								}
							}
						}
					}
				}
			}
		})

		this.maker.append_parts({
			parts : option 
		})

		return option.wrap.node
	},

	perform_an_option : function (option) {
		console.log(option.index)
		console.log( this.box.options)

		if ( this.box.options[option.index].individual === false )
			for (var index = 0; index < this.option.selected.length; index++)
				this.box.options[option.index].action.call(this, this.option.selected[index] )
		else
			this.box.options[option.index].action.call(this, this.option.selected )
	},

	mark_row_as_selected_or_unselected : function (row) { 

		var row_position 

		row_position = this.option.selected.indexOf(row.index) 

 		if ( row_position > -1 ) {  			
 			this.option.selected.splice(row_position, 1)
 			row.button.setAttribute("class", this.class_names.box_option_button )
 		} else {
 			this.option.selected.push(row.index)
 			row.button.setAttribute("class", this.class_names.box_option_button_selected )
 		}
 		console.log(this.option.selected)
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