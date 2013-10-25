define({
	// are they fully isoated? 
	make : function (instructions, modules) {

		var self         = this
		this.setup       = instructions
		this.request     = modules.request
		this.maker       = Object.create(modules.node_making_tools)
		this.data        = {}
		this.class_names = this.maker.merge_objects({
			default_object : {
				wrap                           : "scan_wrap",
				tier                           : "scan_tier",
				box                            : "scan_box",
				find_user                      : "scan_user",
				find_user_title                : "scan_user_title",
				find_user_description          : "scan_user_description",
				find_user_input                : "scan_user_input",
				find_user_button               : "scan_user_button",
				information                    : "scan_information",
				information_title              : "scan_information_title",
				information_field              : "scan_information_field",
				information_field_title        : "scan_information_field_title",
				information_field_text         : "scan_information_field_text",
				information_box                : "scan_notification_box",
				information_notification_green : "scan_green_notification",
				information_notification_red   : "scan_red_notification",
				book_title                     : "book_title",
				book_status_recieved           : "book_status_recieved",
				book_status_waiting            : "book_status_waiting",
				user_list                      : "scan_user_list",
				user_list_item                 : "scan_user_list_item",
				user_list_item_upload          : "scan_user_list_item",
				user_list_item_title           : "scan_user_list_item_title",
				user_button                    : "scan_user_list_button",
				paid_book                      : "scan_paid_book",
				paid_book_field                : "scan_paid_book_field",
				paid_book_dropdown             : "scan_paid_book_dropdown",
				paid_book_dropdown_text        : "scan_paid_book_dropdown_text",
				paid_book_dropdown_box         : "scan_paid_book_dropdown_box",
				paid_book_dropdown_item        : "scan_paid_book_dropdown_item",
				paid_book_input                : "scan_paid_book_input",
				paid_book_input_button         : "scan_paid_book_input_button",
				user_ammount                   : "scan_pay_field",
				user_ammount_title             : "scan_pay_field_title",
			},
			new_object     : this.setup.class_names || {}
		})

		this.main  = this.maker.create_parts({
			wrap : {
				attribute : { 
					"class" : this.class_names.wrap
				},
				children : {
					top_tier : {
						attribute : { 
							"class" : this.class_names.tier
						},
						children : { 
							information : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									box : { 
										attribute : { 
											"class" : this.class_names.information_box
										},
										children : {}
									}
								}
							},
							controls : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									user_list : {
										attribute : { 
											"class" : this.class_names.user_list
										},
										children : function (parent) { 

											for (var index = 0; index < self.setup.use.length; index++)
												parent["button_"+index] = self.add_button_to_control_tab({
													index: index,
													data : self.setup.use[index]
												})

											return parent
										}
									},
								}
							},
						}
					},	
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this.main.wrap.node
	},

	perform_button_action : function (button) {
		this.setup.use[button.index].action.call(this, event)
	},

	notify : function (notification) { 

		this.main.wrap.top_tier.information.box.node.insertBefore(this.maker.create_and_return_node({
			property  : {
				textContent : notification.text
			},
			attribute : { 
				"class" : ( notification.type === "green" ? this.class_names.information_notification_green : this.class_names.information_notification_red )
			}
		}), this.main.wrap.top_tier.information.box.node.firstChild )
	},


	define_button_type : function (button) { 

		if ( button.type === "update" ) 
			button.definition = this.define_update_button(button.definition)
		if ( button.type === "regular" ) 
			button.definition = this.define_regular_button(button.definition)
		return button.definition
	},

	define_update_button : function (definition) { 
		
		var self 
		
		self = this
		definition.type               = "input"
		definition.attribute["class"] = this.class_names.user_list_item_upload
		definition.attribute["type"]  = "file"
		definition.methods = { 
			addEventListener : ["change", function (event) {
				if ( event.target.getAttribute("data-button") ) { 
					self.read_update_file(event)
				}
			}]
		}
		
		return definition
	},

	read_update_file : function (event) { 

		var file, read, self

		self = this
		file = event.target.files || event.dataTransfer.files
		read = new FileReader()
		read.onloadend = function (data) {
			var books, index

			index = 0
			books = self.disect_inventory_file(data.target.result)
			console.log(books)
			for (; index < books.index.length; index++)
				self.search_amazon_for_book_and_submit_result(books.index[index])
		}
		read.readAsText(file[0])
	},

	search_amazon_for_book_and_submit_result : function (book) { 

		var request, self
		
		self    = this
		request = Object.create(this.request)
		request = request.make()
		request.send({
			url : this.setup.settings.path,
			data: {
				action : this.setup.request.update.amazon.action,
				method : this.setup.request.update.amazon.method,
				paramaters : {
					amazon : {
						search_by   : "isbn",
						search_for  : "books",
						filter_name : "sort",
						typed       : book.external_product_id
					}
				}
			},
			type: "GET"
		}).then(function (then) {
			var amazon_book = JSON.parse(then.change.target.response)["return"]
			if ( amazon_book.length > 0 ) 
				self.submit_book(amazon_book[0])
		})
	},

	submit_book : function (book) { 

		var request, self
		
		self    = this
		request = Object.create(this.request)
		request = request.make()
		request.send({
			url : this.setup.settings.path,
			data: {
				action : this.setup.request.update.submit.action,
				method : this.setup.request.update.submit.method,
				paramaters : {
					book : book
				}
			},
			type: "POST"
		}).then(function (then) {
			self.notify({
				type : "green",
				text : "Book Added"
			})
		})
	},

	disect_inventory_file : function (file) { 

		var inventory, column_count, inventory_book, 
		    index, sku, asin, calculated_index, 
		    books_by, books_to_recalculate

		inventory    = file.split(/\t|\n/)
		column_count = 0
		index        = 0
		books_by     = {
			asin  : {},
			index : []
		}

		inventory.splice(0,27)
		books_to_recalculate = Math.round( inventory.length/27 )

		for (; index < books_to_recalculate; index++ ) {

			calculated_index = index*27
		 	sku              = inventory[calculated_index+3].match(/([a-zA-Z]+)|([0-9]+)|(-[0-9]+)/g)
		 	if ( sku.length !== 3 ) 
		 		sku = [inventory[calculated_index+3].substring(0,10), "0", "00"]
		 	asin             = inventory[calculated_index+22]
		 	inventory_book   = {
				// section             : sku[0],
				// level               : sku[1],
				// number              : sku[2].slice(1),
				external_product_id : asin,
				condition_type      : inventory[calculated_index+12],
				quantity            : inventory[calculated_index+5]
			}

			books_by.index.push(inventory_book)
		}

		return books_by
	},

	define_regular_button : function (definition) { 
		
		var self 
		
		self = this
		definition.methods = { 
			addEventListener : ["click", function (event) {

				if ( event.target.getAttribute("data-button") )
					self.perform_button_action({
						index : event.target.getAttribute("data-button"),
						event : event 
					})
			}]
		}
		
		return definition
	},

	add_button_to_control_tab : function (button) {

		var button_item, self

		self        = this
		definition  = {
			item : {
				attribute : { 
					"class" : this.class_names.user_list_item,
					"data-button" : button.index
				},
				children : {
					title : {
						property : {
							textContent : button.data.title
						},
						attribute : { 
							"class"       : this.class_names.user_list_item_title,
							"data-button" : button.index
						},
					}
				}
			}
		}
		definition.item  = self.define_button_type({
			type       : button.data.type,
			definition : definition.item
		})
		
		button_item = this.maker.create_parts(definition)

		return button_item.item
	},

});