define({
	
	make : function (instructions, modules) {

		var self         = this
		this.setup       = instructions
		this.request     = modules.request
		this.maker       = Object.create(modules.node_making_tools)
		this.books       = []
		this.viewing_book= -1
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
									book_list : {
										attribute : { 
											"class" : this.class_names.user_list
										},
										methods : {
											addEventListener : ["click", function (event) {
												if ( event.target.getAttribute("data-book") )
													self.show_book_information(self.books[event.target.getAttribute("data-book")])
											}]
										},
										children : {
										}
									},
									submit_button : {
										property : {
											textContent : "Submit"
										},
										attribute : { 
											"class" : this.class_names.user_button
										},
										methods : {
											addEventListener : ["click", function () {
												self.submit_book_data()
											}]
										}
									},
									reset_button : {
										property : {
											textContent : "Reset"
										},
										attribute : { 
											"class" : this.class_names.user_button
										},
										methods : {
											addEventListener : ["click", function () {
												self.notify({
													type : ( self.books.length > 0 ? "green" : "red" ),
													text : ( self.books.length > 0 ? "Everything has been reset" : "Nothing to reset" ),
												})

												self.clear_all_data()
											}]
										}
									}
								}
							},
						}
					},
					data_tier : {
						attribute : { 
							"class" : this.class_names.tier
						},
						children : { 
							books : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {}
							},
						}
					},
					book_tier : {
						attribute : { 
							"class" : this.class_names.tier
						},
						children : {
							search : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									find_book      : {
										attribute : { 
											"class" : this.class_names.find_user
										},
										children : {
											title : {
												property  : {
													textContent : this.setup.text.title
												},
												attribute : {
													"class" : this.class_names.find_user_title
												},		
											},
											description : {
												property  : {
													textContent : this.setup.text.description
												},
												attribute : {
													"class" : this.class_names.find_user_description
												},		
											},
											input : {
												type      : "input",
												attribute : {
													"class" : this.class_names.find_user_input
												},
												methods : {
													addEventListener : ["keypress", function (event) {
														if ( event.keyCode === 13 )
															self.search_for_book({
																id : event.target.value
															})
													}]
												}
											},
											go : {
												property : {
													textContent : "find"
												},
												attribute : {
													"class" : this.class_names.find_user_button
												},
												methods : {
													addEventListener : ["click", function (event) {
														self.search_for_book({
															id : event.target.previousSibling.value
														})
													}]
												}	
											}
										}
									},
								}
							},
							data : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									book_info      : {
										attribute : { 
											"class" : this.class_names.information
										},
										children : {
											title : {
												property : {
													textContent : "Book Information"
												},
												attribute : { 
													"class" : this.class_names.information_title
												},
											},
										}
									},
								}
							}
						},
					},		
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this.main.wrap.node
	},

	search_for_book : function (book) { 

		var request, self

		self    = this
		request = this.request.make()
		request.send({
			url : this.setup.request.path,
			data: {
				action : this.setup.request.find.action,
				method : this.setup.request.find.method,
				paramaters : {
					amazon : {
						search_by   : "isbn",
						search_for  : "books",
						filter_name : "sort",
						typed       : book.id
					}
				}
			},
			type: "GET"
		}).then(function (then) {
			self.deal_with_book_response(JSON.parse(then.change.target.response)["return"])
		})
	},

	submit_book_data : function () { 

		var request, self

		self    = this
		request = this.request.make()

		this.notify({
			type : "green",
			text : "Submiting Books"
		})
		request.send({
			url : this.setup.request.path,
			data: {
				action : this.setup.request.submit.action,
				method : this.setup.request.submit.method,
				paramaters : {
					books : this.books
				}
			},
			type: "POST"
		}).then(function (then) {
			self.deal_with_submit_response(JSON.parse(then.change.target.response)["return"])
		})
	},

	deal_with_submit_response : function (response) { 
		if ( response === null ) 
			this.notify({
				type : "green",
				text : "Books Submited"
			})
	},

	deal_with_book_response : function (response) {

		if ( response.length === 0 ) {
			this.notify({
				type : "red",
				text : "No results were found"
			})
			return
		}

		var book

		book = response[0]
		this.notify({
			type : "green",
			text : "Found book"
		})
		this.add_new_book_to_data(book)
		this.show_book_control_tab({
			index: this.viewing_book,
			data : book
		})
		this.show_book_information(book)
	},

	show_book_information : function (book) {
		this.clear_data_fields()
		this.set_data_fields(book)
	},

	add_new_book_to_data : function (book) {
		this.books.push(book)
		this.viewing_book = this.books.length-1
	},

	show_book_control_tab : function (book) {

		var book_item, self
		console.log(book)
		self      = this
		book_item = this.maker.create_parts({
			item : {
				attribute : { 
					"class" : this.class_names.user_list_item,
					"data-book" : book.index
				},
				children : {
					title : {
						property : {
							textContent : book.data.item_name
						},
						attribute : { 
							"class"     : this.class_names.user_list_item_title,
							"data-book" : book.index
						},
					}
				}
			}
		})

		this.maker.append_parts({
			parts : book_item
		})

		this.main.wrap.top_tier.controls.book_list["book_"+book.index] = book_item.item
		this.main.wrap.top_tier.controls.book_list.node.appendChild(book_item.item.node)
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

	set_data_fields : function (book) { 

		var field, index,

		self  = this
		index = 0

		for (; index < this.setup.book.show.length; index++) {
			if ( book[this.setup.book.show[index]] ) {
				
				field = this.maker.create_parts({
					field : {
						attribute : { 
							"class" : this.class_names.information_field
						},	
						children : {
							title : {
								property : {
									textContent : this.setup.book.show[index]
								},
								attribute : { 
									"class" : this.class_names.information_field_title,
								},	
							},
							text : {
								attribute : {
									"class" : this.class_names.paid_book_dropdown
								},
								children : {
									text : {
										property : {
											textContent : book[this.setup.book.show[index]]
										},
										attribute : { 
											"class" : this.class_names.information_field_text,
										},
										methods : {
											addEventListener : ["click", function (event) { 
												
												if ( event.target.nextSibling.getAttribute("data-open") ) 
													self.toggle_dropbox({
														box     : event.target.nextSibling,
														open    : event.target.nextSibling.getAttribute("data-open"),
														display : "inline-block"
													})
											}]
										}
									},
									box : {
										style : {
											display : "none"
										},
										attribute : { 
											"class"         : this.class_names.paid_book_dropdown_box,
											"data-open"     : "false",
											"data-property" : this.setup.book.show[index]
										},
										children : {
											text : {
												type : "textarea",
												attribute : { 
													"class"     : this.class_names.paid_book_input,
												},
											},
											yes : {
												property : {
													textContent : "yes"
												},
												attribute : { 
													"class"     : this.class_names.paid_book_input_button,
												},
												methods : { 
													addEventListener : ["click", function (event) { 
														self.set_book_value({
															index    : self.viewing_book,
															property : event.target.parentElement.getAttribute("data-property"),
															value    : event.target.previousSibling.value
														})
														self.update_box_value({	
															box   : event.target.parentElement.previousSibling,
															value : event.target.previousSibling.value
														})
														self.toggle_dropbox({
															box     : event.target.parentElement,
															open    : event.target.parentElement.getAttribute("data-open"),
															display : "inline-block"
														})
													}]
												}
											},
											no : {
												property : {
													textContent : "no"
												},
												attribute : { 
													"class"     : this.class_names.paid_book_input_button,
												},
												methods : { 
													addEventListener : ["click", function () { 
														self.toggle_dropbox({
															box     : event.target.parentElement,
															open    : event.target.parentElement.getAttribute("data-open"),
															display : "inline-block"
														})
													}]
												}
											}
										}
									}
								}
							},
						}
					}
				})

				this.maker.append_parts({
					parts : field 
				})

				this.main.wrap.book_tier.data.book_info["field_"+index] = field.field
				this.main.wrap.book_tier.data.book_info.node.appendChild(field.field.node)
			}
		}
	},

	set_book_value : function (book) {
		this.books[book.index][book.property] = book.value
	},

	clear_control_tab : function () { 
		while ( this.main.wrap.top_tier.controls.book_list.node.firstChild )
			this.main.wrap.top_tier.controls.book_list.node.firstChild.remove()
	},

	clear_data_fields : function () {

		object = this.main.wrap.book_tier.data.book_info
		title  = object.title.node

		for ( var property in object ) 
			if ( property !== "node" && property !== "title" )
				delete property

		while ( object.node.firstChild ) 
			object.node.firstChild.remove()

		object.node.appendChild(title)
	},

	clear_all_data : function () { 
		this.books        = []
		this.viewing_book = -1
		this.clear_control_tab()
		this.clear_data_fields()
	},

	toggle_dropbox : function (toggle) { 
		if ( toggle.open === "true" ) {
			toggle.box.setAttribute("data-open", false )
			toggle.box.style.display = "none"
		} else {
			toggle.box.setAttribute("data-open", true )
			toggle.box.style.display = toggle.display
		}
	},

	update_box_value : function (update) { 
		update.box.textContent = update.value
	},

});