define({
	
	make : function (instructions, modules) {

		var self         = this
		this.setup       = instructions
		this.request     = modules.request
		this.maker       = Object.create(modules.node_making_tools)
		this.users       = []
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
										children : {
											notification : {
												property  : {
													textContent : "Stuffedy mc stuff stuff son"
												},
												attribute : { 
													"class" : this.class_names.information_notification_green
												},
											}
										}
									}
								}
							},
							controls : { 
								attribute : { 
									"class" : this.class_names.box
								},
								children : {}
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
					}
							
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this.main.wrap.node
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

	deal_with_retrieved_user_response : function (user) {
		if ( user === false ) { 
			this.put_notification({
				text : "No user was found son",
				type : "red"
			})
		} else { 

			this.put_notification({
				type : "green",
				text : "Found user "+ user.first_name,
			})

			var index, final_user

			index      = 0
			final_user = {
				data : user,
				shown: [],
				books: [],
				pay  : [],
				
			}

			for (; index < this.setup.find_user.show.length; index++)
				final_user.shown.push({
					name  : this.setup.find_user.show[index].as,
					value : user[this.setup.find_user.show[index].what]
				})

			this.set_data_fields({
				for    : "user",
				fields : final_user.shown
			})
		}
	},

	put_notification : function (notification) { 

		this.main.wrap.top_tier.information.box.node.insertBefore(this.maker.create_and_return_node({
			property  : {
				textContent : notification.text
			},
			attribute : { 
				"class" : ( notification.type === "green" ? this.class_names.information_notification_green : this.class_names.information_notification_red )
			}
		}), this.main.wrap.top_tier.information.box.node.firstChild )
	},

	set_data_fields : function (data) { 

		var field, index, class_names, use_class, path


		class_names = {
			user : {
				title : this.class_names.information_field_title,
				value : this.class_names.information_field_text,
			},
			book : {
				title : this.class_names.book_title,
				value : this.class_names.book_status_waiting,
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
								"class" : class_names[data.for].value
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