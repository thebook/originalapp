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
								children : {
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
											field : {
												attribute : { 
													"class" : this.class_names.information_field
												},	
												children : {
													title : {
														property : {
															textContent : "First Name"
														},
														attribute : { 
															"class" : this.class_names.information_field_title
														},	
													},
													text  : {
														property : {
															textContent : "Fong Chin Li"
														},
														attribute : { 
															"class" : this.class_names.information_field_text
														},	
													}
												}
											}
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
											field : {
												attribute : { 
													"class" : this.class_names.information_field
												},	
												children : {
													title : {
														property : {
															textContent : "Sucke gee mg gee guide to success"
														},
														attribute : { 
															"class" : this.class_names.book_title
														},	
													},
													text  : {
														property : {
															textContent : "Yes"
														},
														attribute : { 
															"class" : this.class_names.book_status_recieved
														},	
													}
												}
											},
											filed2 : {
												attribute : { 
													"class" : this.class_names.information_field
												},	
												children : {
													title : {
														property : {
															textContent : "Magical Adventures of pony jack"
														},
														attribute : { 
															"class" : this.class_names.book_title
														},	
													},
													text  : {
														property : {
															textContent : "waiting"
														},
														attribute : { 
															"class" : this.class_names.book_status_waiting
														},	
													}
												}
											}
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
		console.log(user)
	},

});