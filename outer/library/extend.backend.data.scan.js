define({
	// are they fully isoated? 
	make : function (instructions, modules) {

		var self         = this
		this.setup       = instructions
		this.request     = modules.request
		this.maker       = Object.create(modules.node_making_tools)
		this.users       = []
		this.viewing_user= -1
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
										methods : {
											addEventListener : ["click", function (event) {
												if ( event.target.getAttribute("data-user") )
													self.show_user_information(event.target.getAttribute("data-user"))
											}]
										},
										children : {
										}
									},
									print_button : {
										property : {
											textContent : "Print"
										},
										attribute : { 
											"class" : this.class_names.user_button
										},
										methods : {
											addEventListener : ["click", function () {
												self.package_all_data_for_print()
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
														type : ( self.users.length > 0 ? "green" : "red" ),
														text : ( self.users.length > 0 ? "Everything has been reset" : "Nothing to reset" ),
													})

												self.clear_all_data()
											}]
										}
									}
								}
							},
						}
					},
					data : {
						attribute : { 
							"class" : this.class_names.tier
						},
						children : { 
							books : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									book : {
										attribute : { 
											"class" : this.class_names.paid_book
										},
										methods : { 
											addEventListener : ["click", function () { 

											}]
										},
										children : {
											title     : {
												property : {
													textContent : "Book"
												},
												attribute : { 
													"class" : this.class_names.paid_book_field
												},
											},
											condition : {
												attribute : { 
													"class" : this.class_names.paid_book_dropdown
												},
												children : {
													text : {
														property : {
															textContent : "1"
														},
														attribute : { 
															"class" : this.class_names.paid_book_dropdown_text
														},
														methods : {
															addEventListener : ["click", function (event) { 
																console.log(event.target)
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
															"class"     : this.class_names.paid_book_dropdown_box,
															"data-open" : false
														},
														children : {
															item : {
																property : {
																	textContent : "stuff"
																},
																attribute : { 
																	"class" : this.class_names.paid_book_dropdown_item
																}		
															}
														}
													}
												}
											},
											price     : {
												type      : "input",
												attribute : {
													"class" : this.class_names.paid_book_input
												},
											}
										}
									}
								}
							},
						}
					},
					book_tier : {
						style : {
							display : "none"
						},
						attribute : { 
							"class" : this.class_names.tier
						},
						children : {
							search : {
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									find_book     : {
										attribute : { 
											"class" : this.class_names.find_user
										},
										children : {
											title : {
												property  : {
													textContent : this.setup.find_book.title
												},
												attribute : {
													"class" : this.class_names.find_user_title
												},		
											},
											description : {
												property  : {
													textContent : this.setup.find_book.description
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
									}
								}
							},
							data : {
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									user_promise : {
										attribute : { 
											"class" : this.class_names.information
										},
										methods : {
											addEventListener : ["click", function (event) { 
												console.log("stuff")
											}]
										},
										children : {
											title : {
												property : {
													textContent : "Price Promise"
												},
												attribute : { 
													"class" : this.class_names.information_title
												},
											},
										}
									},
								}
							},
						}
					},
					user_tier : {
						attribute : { 
							"class" : this.class_names.tier
						},
						children : {
							user : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {
									find_user      : {
										attribute : { 
											"class" : this.class_names.find_user
										},
										children : {
											title : {
												property  : {
													textContent : this.setup.find_user.title
												},
												attribute : {
													"class" : this.class_names.find_user_title
												},		
											},
											description : {
												property  : {
													textContent : this.setup.find_user.description
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
															self.search_for_user({
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
														self.search_for_user({
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
									user_info      : {
										attribute : { 
											"class" : this.class_names.information
										},
										children : {
											title : {
												property : {
													textContent : "User Information"
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

	toggle_dropbox : function (toggle) { 
		if ( toggle.open === "true" ) {
			toggle.box.setAttribute("data-open", false )
			toggle.box.style.display = "none"
		} else {
			toggle.box.setAttribute("data-open", true )
			toggle.box.style.display = toggle.display
		}
	},

	package_all_data_for_print : function () { 
		console.log(this)
	},

	add_user_to_control_tab : function (user) {

		var user_item, self

		self      = this
		user_item = this.maker.create_parts({
			item : {
				attribute : { 
					"class" : this.class_names.user_list_item,
					"data-user" : user.index
				},
				children : {
					title : {
						property : {
							textContent : user.data.first_name +" "+ user.data.second_name
						},
						attribute : { 
							"class"     : this.class_names.user_list_item_title,
							"data-user" : user.index
						},
					}
				}
			}
		})

		this.maker.append_parts({
			parts : user_item
		})

		this.main.wrap.top_tier.controls.user_list["user_"+user.index] = user_item.item
		this.main.wrap.top_tier.controls.user_list.node.appendChild(user_item.item.node)
	},

	clear_control_tab : function () { 
		while ( this.main.wrap.top_tier.controls.user_list.node.firstChild )
			this.main.wrap.top_tier.controls.user_list.node.firstChild.remove()
	},

	search_for_user : function (user) {

		var request, send_data, self

		self      = this
		request   = this.request.make()
		request.send({
			url : this.setup.find_user.request.path || this.setup.main_path,
			data: this.setup.find_user.request.paramaters.call(this, user),
			type: "GET"
		}).then(function (then) {
			self.deal_with_retrieved_user_response(JSON.parse(then.change.target.response)["return"])
		})
	},

	search_for_book : function (book) {
		
		var user, pending_book, isbn

		isbn         = book.id.replace(" ", "")
		user         = this.get_viewing_user_data()
		pending_book = user.books.indexOf(book.id)
		if ( pending_book > -1 ) {
			this.notify({
				type : "green",
				text : "Book is a match"
			})
			this.mark_book_as_found({
				user  : this.viewing_user,
				index : pending_book,
			})
		} else { 
			this.notify({
				type : "red",
				text : "Book not found in price promises"
			})
		}
	},

	show_or_hide_book_tier_based_on_found_users : function () { 
		if ( this.viewing_user > -1 )
			this.main.wrap.book_tier.node.style.display = "block"
		else
			this.main.wrap.book_tier.node.style.display = "none"
	},

	mark_book_as_found : function (book) {

		this.set_book_as_paid_book({
			user  : book.user,
			index : book.index
		})
		this.remove_book_from_user({
			user : book.user,
			book : book.index
		})
		this.set_promised_book_as_fulfiled({
			index : book.index
		})
	},

	set_book_as_paid_book : function (book) { 
		this.users[book.user].paid_books.push(this.users[book.user].data.price_promise[book.index])
		this.users[book.user].ammount = this.users[book.user].ammount + parseFloat( this.users[book.user].data.price_promise[book.index].standard_price )
	},

	set_paid_book_value : function (set) { 
		this.users[set.user].paid_books[set.book][set.property] = set.value
	},

	set_promised_book_as_fulfiled : function (book) { 

		var field

		field                       = this.get_book_field_reference(book.index)		
		field.text.node.className   = this.class_names.book_status_recieved
		field.text.node.textContent = "Yes"
	},

	remove_book_from_user : function (remove) { 
		this.users[remove.user].books[remove.book] = ""
		this.users[remove.user].shown.promise[remove.book].value = "Yes"
	},

	get_book_field_reference : function (field_number) { 
		return this.main.wrap.book_tier.data.user_promise["field_"+field_number]
	},

	get_viewing_user_data : function () {

		return this.users[this.viewing_user]

	},

	deal_with_retrieved_user_response : function (user) {
		
		if ( user === false ) { 
			this.notify({
				text : "No user was found",
				type : "red"
			})

			return
		}

		this.notify({
			type : "green",
			text : "Found user "+ user.first_name,
		})

		if ( !user.price_promise || user.price_promise.length === 0 )
			this.notify({
				type : "red",
				text : "User "+ user.first_name +" has no price promises",
			})

		this.add_new_user(user)
		this.show_user_information(this.users.length-1)
		this.add_user_to_control_tab({
			index : this.viewing_user,
			data  : user
		})
		this.show_or_hide_book_tier_based_on_found_users()
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

	add_new_user : function (data) {

		var index, user, promise_index

		promise_index = 0
		index         = 0
		user          = {
			data        : data,
			shown       : {
				information : [],
				promise     : []
			},
			books       : [],
			paid_books  : [],
			ammount     : 0
			
		}
		
		if ( data.price_promise && data.price_promise.length > 0 ) { 
			for (; promise_index < data.price_promise.length; promise_index++) {
				user.shown.promise.push({
					name  : data.price_promise[promise_index].item_name,
					value : "waiting"
				})
				user.books.push(data.price_promise[promise_index].external_product_id)
			}
		}

		for (; index < this.setup.find_user.show.information.length; index++)
			user.shown.information.push({
				name  : this.setup.find_user.show.information[index].as,
				value : data[this.setup.find_user.show.information[index].what]
			})

		this.users.push(user)
	},

	show_user_information : function (user_index) { 

		this.viewing_user = user_index

		this.clear_data_fields()

		this.set_data_fields({
			for    : "book",
			fields : this.users[this.viewing_user].shown.promise
		})

		this.set_data_fields({
			for    : "user",
			fields : this.users[this.viewing_user].shown.information
		})
	},

	clear_data_fields : function () { 
		this.clear_data_field("book")		
		this.clear_data_field("user")		
	},

	clear_data_field : function (clear) { 

		var path, object, title

		path = {
			user : {
				tier : "user_tier",
				data : "user_info",
			},
			book : {
				tier : "book_tier",
				data : "user_promise",
			}
		}
		object = this.main.wrap[path[clear].tier].data[path[clear].data]
		title  = object.title.node

		for ( var property in object ) 
			if ( property !== "node" && property !== "title" )
				delete property

		while ( object.node.firstChild ) 
			object.node.firstChild.remove()

		object.node.appendChild(title)
	},

	clear_all_data : function () { 
		this.users        = []
		this.viewing_user = -1
		this.clear_control_tab()
		this.clear_data_fields()
		this.show_or_hide_book_tier_based_on_found_users()
	},

	set_data_fields : function (data) { 

		var field, index, class_names, use_class, path

		class_names = {
			user : {
				title : this.class_names.information_field_title,
				value : this.class_names.information_field_text,
			},
			book : {
				title      : this.class_names.book_title,
				value      : this.class_names.book_status_waiting,
				true_value : this.class_names.book_status_recieved,
			}
		}
		path        = {
			user : {
				tier : "user_tier",
				data : "user_info",
			},
			book : {
				tier : "book_tier",
				data : "user_promise",
			}
		}
		index       = 0

		for (; index < data.fields.length; index++) {
			
			field = this.maker.create_parts({
				field : {
					attribute : { 
						"class" : this.class_names.information_field
					},	
					children : {
						title : {
							property : {
								textContent : data.fields[index].name
							},
							attribute : { 
								"class" : class_names[data.for].title
							},	
						},
						text  : {
							property : {
								textContent : data.fields[index].value
							},
							attribute : { 
								"class" : ( data.for === "book" && data.fields[index].value === "Yes" ? class_names[data.for].true_value : class_names[data.for].value ) 
							},	
						}
					}
				}
			})
			this.maker.append_parts({
				parts : field 
			})

			this.main.wrap[path[data.for].tier].data[path[data.for].data]["field_"+index] = field.field
			this.main.wrap[path[data.for].tier].data[path[data.for].data].node.appendChild(field.field.node)
		}
	},

});