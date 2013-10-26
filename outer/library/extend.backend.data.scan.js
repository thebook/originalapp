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
												self.submit_data()
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
							pay : {
								style : {
									display : "none",
									"float" : "right"
								},
								attribute : {
									"class" : this.class_names.box
								},
								children : {
									title : {
										property : {
											textContent : "Pay Amount"
										},
										attribute : { 
											"class" : this.class_names.user_ammount_title
										},
									},
									text : {
										property : {
											textContent : "0.00"
										},
										attribute : { 
											"class" : this.class_names.user_ammount
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
											"class"     : this.class_names.paid_book_dropdown_box,
											"data-open" : "false",
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
														self.set_user_ammount({
															user     : self.viewing_user,
															value    : event.target.previousSibling.value
														})
														self.set_user_ammount_box(event.target.previousSibling.value)
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
							}
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

	add_paid_books : function (book) {
		for (var index = 0; index < this.users[book.user].paid_books.length; index++)
			this.add_paid_book({
				user : book.user,
				index: index
			})
	},

	add_paid_book : function (add) {

		var node, book, self

		self = this
		book = this.users[add.user].data.price_promise[add.index]
		node = this.maker.create_parts({
			wrap : {
				attribute : { 
					"class" : this.class_names.paid_book
				},
				children : {
					title     : {
						property : {
							textContent : book.item_name
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
									textContent : book.condition_type
								},
								attribute : { 
									"class" : this.class_names.paid_book_dropdown_text
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
									"class"     : this.class_names.paid_book_dropdown_box,
									"data-open" : "false",
									"data-book" : add.index
								},
								methods : { 
									addEventListener : ["click", function (event) {

										if ( !event.target.getAttribute("data-option") ) return

										self.set_paid_book_value({
											user     : self.viewing_user,
											book     : event.target.parentElement.getAttribute("data-book"),
											property : "condition_type",
											value    : event.target.getAttribute("data-option")
										})

										self.update_box_value({	
											box   : event.target.parentElement.previousSibling,
											value : event.target.getAttribute("data-option")
										})
										self.toggle_dropbox({
											box     : event.target.parentElement,
											open    : event.target.parentElement.getAttribute("data-open"),
											display : "inline-block"
										})
									}]
								},
								children : function (parent) {
									for (var index = 0; index < self.setup.find_book.show.condition.length; index++)
											parent["condition_"+index] = {
												node : this.create_and_return_node({
													property : {
														textContent : self.setup.find_book.show.condition[index].title
													},
													attribute : { 
														"class"       : self.class_names.paid_book_dropdown_item,
														"data-option" : self.setup.find_book.show.condition[index].name,
													}		
												})
											}


									return parent
								}
							}
						}
					},
					price     : {
						attribute : {
							"class" : this.class_names.paid_book_dropdown
						},
						children : {
							text : {
								property : {
									textContent : book.standard_price
								},
								attribute : { 
									"class" : this.class_names.paid_book_dropdown_text
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
									"class"     : this.class_names.paid_book_dropdown_box,
									"data-open" : "false",
									"data-book" : add.index
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
												self.set_paid_book_value({
													user     : self.viewing_user,
													book     : event.target.parentElement.getAttribute("data-book"),
													property : "standard_price",
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
					}
				}
			}
		})

		this.maker.append_parts({
			parts : node 
		})
		this.main.wrap.data_tier.books["book_"] = node.wrap
		this.main.wrap.data_tier.books.node.appendChild(node.wrap.node)
	},

	update_box_value : function (update) { 
		update.box.textContent = update.value
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
		request   = Object.create(this.request)
		request   = request.make()
		request.send({
			url : this.setup.find_user.request.path || this.setup.settings.main_path,
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

	does_value_match_any_in_the_array : function (match) { 

		var is_a_match

		is_a_match = false 
		for (var index = 0; index < match.array.length; index++)
			if ( match.array[index] === match.value ) 
				is_a_match = true 

		return is_a_match
	},

	extract_objects_from_an_array_that_dont_match_the_other : function (extract) { 

		var the_extract = []
		for (var index = 0; index < extract.from.length; index++) {
			if ( this.does_value_match_any_in_the_array({
				value : extract.from[index],
				array : extract.by
			}) !== true ) the_extract.push(extract.from[index]) 
		}

		return the_extract
	},

	submit_data : function () {

		var packaged

		packaged  = this.package_all_data()
		console.log(packaged)
		this.submit_user_update(packaged.user)
		this.submit_cheques(packaged.cheque.submit)
		this.submit_print(packaged.cheque.print)
	},

	submit_print : function (print) { 
		var request, self
		self      = this
		request   = Object.create(this.request)
		request   = request.make()
		request.send({
			url : this.setup.settings.main_path,
			data: {
				action     : this.setup.submit.print.action,
				method     : this.setup.submit.print.method,
				paramaters : {
					print : print
				}
			},
			type: "GET"
		}).then(function (then) {
			window.open(JSON.parse(then.change.target.response)["return"], '_blank')
		})
	},

	submit_user_update : function (users) { 
		var request, self

		self      = this
		request   = Object.create(this.request)
		request   = request.make()
		request.send({
			url : this.setup.settings.main_path,
			data: {
				action     : this.setup.submit.user.action,
				method     : this.setup.submit.user.method,
				paramaters : {
					users : users
				}
			},
			type: "POST"
		}).then(function (then) {
			self.notify({
				type : "green", 
				text : "User Information Updated"
			})
		})
	},

	submit_cheques : function (cheques) { 
		var request, self

		self      = this
		request   = Object.create(this.request)
		request   = request.make()
		request.send({
			url : this.setup.settings.main_path,
			data: {
				action     : this.setup.submit.cheque.action,
				method     : this.setup.submit.cheque.method,
				paramaters : {
					cheques : cheques
				}
			},
			type: "POST"
		}).then(function (then) {
			self.notify({
				type : "green", 
				text : "Cheques added to history"
			})
		})
	},

	package_all_data : function () { 
		return { 
			user   : this.package_user_information(this.users),
			cheque : this.package_cheque_information(this.users)
		}
	},

	package_user_information : function (users) { 

		var packaged, user 

		packaged = []

		for (var index = 0; index < users.length; index++) {
			user               = users[index].data
			user.price_promise = this.extract_objects_from_an_array_that_dont_match_the_other({
				from : users[index].data.price_promise || [],
				by   : users[index].paid_books
			})
			user.credit        = parseFloat(user.credit) + users[index].ammount
			packaged.push({
				email         : user.email,
				price_promise : user.price_promise,
				credit        : user.credit,
			})
		
		}
		
		return packaged
	},

	convert_amount : function (number) {
		
		var main, point, pounds, pence

		number = number.split(".")
		main   = parseInt(number[0])
		point  = ( number[1] ? parseInt(number[1]) : false )
		pounds = this.number_to_text(main) +"pounds"
		pence  = ""		
		if ( point !== false && point > 0 ) 
			pence = " and "+ this.number_to_text(point) +"pence"

		return pounds + pence
	},

	number_to_text : function (num) { 

		var a, b	

		a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen ']
		b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']

	    if ((num = num.toString()).length > 9) return 'overflow';
	    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
	    if (!n) return; var str = '';
	    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
	    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
	    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
	    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
	    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';

	    return str;
	},

	package_cheque_information : function (users) { 

		var date, packaged

		date     = new Date
		date     = date.getFullYear() +"-"+ date.getMonth() +"-"+ date.getDay()
		packaged = {
			submit : [],
			print  : []
		}

		for (var index = 0; index < users.length; index++) {
			packaged.print.push({
				address        : users[index].data.address+"\n"+users[index].data.post_code+"\n"+users[index].data.town+"\n"+users[index].data.area,
				number_amount  : users[index].ammount,
				date           : date,
				name           : users[index].data.first_name +" "+ users[index].data.second_name,
				books_sold_sum : users[index].paid_books.length,
				text_amount    : this.convert_amount(users[index].ammount.toFixed(2))
			})
			packaged.submit.push({
				email       : users[index].data.email,
				amount      : users[index].ammount,
				address     : users[index].data.address,
				post_code   : users[index].data.post_code,
				town        : users[index].data.town,
				area        : users[index].data.area,
				first_name  : users[index].data.first_name,
				second_name : users[index].data.second_name,
				date        : date
			})
		}

		return packaged
	},

	submit_user_data : function () { 
		
		var request

		request = this.request.make()
		request.send({
			url : this.setup.submit.path || this.setup.main_path,
			data: {
				action : this.setup.submit.action,
				method : this.setup.submit.method,
				paramaters : { 
					users : this.users
				}
			},
			type: "GET"
		}).then(function (then) {
			console.log(then.change.target.response)
		})
	},

	show_or_hide_book_tier_based_on_found_users : function () { 
		if ( this.viewing_user > -1 )
			this.main.wrap.book_tier.node.style.display = "block"
		else
			this.main.wrap.book_tier.node.style.display = "none"
	},

	mark_book_as_found : function (book) {

		this.add_paid_book({
			user : book.user,
			index: book.index	
		})
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
		this.update_user_paid_ammount_based_on_book_prices({
			user : book.user
		})
		this.set_user_ammount_box(this.users[book.user].ammount)
	},

	set_book_as_paid_book : function (book) { 
		this.users[book.user].paid_books.push(this.users[book.user].data.price_promise[book.index])
		this.users[book.user].ammount = this.users[book.user].ammount + parseFloat( this.users[book.user].data.price_promise[book.index].standard_price )
	},

	set_paid_book_value : function (set) { 
		this.users[set.user].paid_books[set.book][set.property] = set.value
		if ( set.property === "standard_price" ) {
			this.update_user_paid_ammount_based_on_book_prices({
				user : set.user
			})
			this.set_user_ammount_box(this.users[set.user].ammount)
		}
	},

	set_user_ammount : function (set) { 
		this.users[set.user]["amount"] = set.value
	},

	set_user_ammount_box : function (value) { 
		this.main.wrap.data_tier.pay.text.node.textContent = value
	},

	update_user_paid_ammount_based_on_book_prices : function (update) { 

		var ammount, index

		ammount = 0 
		index   = 0

		for (; index < this.users[update.user].paid_books.length; index++)
			ammount = ammount + parseFloat( this.users[update.user].paid_books[index].standard_price )

		this.users[update.user].ammount = ammount
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
		this.show_or_hide_data_tier_based_on_users()
	},

	show_or_hide_data_tier_based_on_users : function () { 

		if ( this.users.length > 0 ) 
			this.main.wrap.data_tier.pay.node.style.display = "inline-block"
		else 
			this.main.wrap.data_tier.pay.node.style.display = "none"
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

		this.clear_paid_books()
		this.clear_data_fields()

		this.add_paid_books({
			user : this.viewing_user
		})

		this.set_data_fields({
			for    : "book",
			fields : this.users[this.viewing_user].shown.promise
		})

		this.set_data_fields({
			for    : "user",
			fields : this.users[this.viewing_user].shown.information
		})
		this.set_user_ammount_box(this.users[this.viewing_user].ammount)
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

	clear_paid_books : function () {
		this.empty_node(this.main.wrap.data_tier.books.node)
	},

	clear_all_data : function () { 
		this.users        = []
		this.viewing_user = -1
		this.clear_control_tab()
		this.clear_data_fields()
		this.clear_paid_books()
		this.show_or_hide_book_tier_based_on_found_users()
		this.show_or_hide_data_tier_based_on_users()
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

	empty_node : function (node) {
		while ( node.firstChild ) 
			node.firstChild.remove()
	}

});