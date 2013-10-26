define(function () {

	var app = function (thought, modules) {
		
		var word, animator, ajax_path;

		ajax_path = window.location.origin + "/wp-admin/admin-ajax.php"
		asset_path= window.location.origin + "/wp-content/themes/book/outer/css/include/image"
		animator  = Object.create(modules.libraries.animator)
		world     = Object.create(thought)
		animator.make()

		world.make({
			parts   : {
				node_making_tools : modules.libraries.node_making_tools,
				animation         : animator,
				model             : modules.libraries.model,
				table             : modules.libraries.table,
				request           : modules.libraries.request,
				algorithm         : modules.libraries.algorithm,
				router            : modules.libraries.router,
			},
			thought : {
				wrap : {
					self : ".wrap",
					children : {
						app : {
							instructions : {
								extend : {
									into : "old",
									pass : {
										path    : ajax_path,
										include : window.location.origin + "/wp-content/themes/book/outer/css/include/old",
										modules : modules.old
									}
								}
							},
							self : ".main_wrap"
						},
						foot : {
							instructions : {
								extend : { 
									into : "foot",
									pass : {
										settings : {
											animation_speed : 250,
											popup_pushdown  : 800,
											navigation_text : {
												contact : "Contact Us",
												media   : "Media",
												word    : "A Word From Us",
												terms   : "Terms & Conditions",
												advert  : "Advertising"
											},
											media       : {
												email      : "Press@recylabook.com",
												bubble_path: "http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/media_bubble.png",
												logo_path  : "http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/media.png",
											},
											contact       : {
												image_path : "http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/contact.png",
												left_paragraph : [
													"Talk@recyclabook.com",
													"02921 202665"
												],
												right_paragraph : [
													"Britannia House",
													"Caerphilly Business Park",
													"Caerphilly",
													"CF83 3GG",
												]
											},
											word : {
												title : "A word from us",
												paragraph : [
													"Recyclabook was founded by Tom Williams and James Seear with the aim of providing the easiest possible way for a student to sell their textbook",
													"After months of trials and tribulations and with the help of some great people along the way, we’ve grown to a team of six, spoken to universities across the world and created Recyclabook - a company that provides a service that we wanted when we were students",
													"We’ve tried to create a brand that embodies ease and trust at its core, this is where the ‘Recyclabus’ stems from, a van parked in a convenient location where students can bring their books and get paid instantly. ",
													"Thanks",
													"Tom and James",
												]
											},
											legal : {
												title : "Terms & Conditions",
												text  : modules.data.terms_and_conditions.text
											},
											logo_path     : "http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/footer_logos.png",
											advert_title  : "Advertising",
											pdf_link      : "",
											advert_download_text : "Download Advertising Pack",
											advert_images : [
												"http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/advertising_one.jpg",
												"http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/advertising_two.jpg",
												"http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/advertising_three.jpg",
												"http://recyclabook.co.uk/wp-content/themes/recyclabook_23_07_2013__16_54_50/Framework/CSS/Includes/works/advertising_four.jpg"
											],
										}
									}
								}
							},
							self : ".footer"
						},
						backend : {
							instructions : {
								extend : {
									into : "backend",
									pass : {
										sign_in : {
											path : ajax_path,
											data : {
												action     : "get_setting",
												method     : "options",
												paramaters : {
													names : [
														"admin",
														"password"
													]
												}
											}
										},
										use : [
											{
												module : "data",
												title  : "Users",
												pass   : {
													settings : {
														tabs : [
															{
																name : "all",
																type : "table",
																pass : {
																	submit_changed_value : function (data) {
																		console.log("changed")
																		return {
																			action : "set_account",
																			method : "account_value",
																			paramaters : {
																				email       : data.row_id,
																				column_name : data.column_name,
																				value       : data.box_value
																			}
																		}
																	},
																	table : {
																		setup : {
																			row_id     : "email",
																			padding    : 30,
																			box_height : 100,
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title: "first name",
																				name : "first_name",
																			},
																			{
																				title: "email",
																				name : "email",
																			},
																			{
																				title: "id",
																				name : "id",
																			},
																			{
																				title: "password",
																				name : "password",
																			},
																			{
																				title: "university",
																				name : "university",
																			},
																			{
																				title: "year",
																				name : "year",
																			},
																			{
																				title      : "subject",
																				name       : "subject",
																			},
																			{
																				title      : "status",
																				name       : "status",
																				changeable : {
																					by      : "dropdown",
																					choices : [
																						{
																							title : "ordered pack",
																							name  : "ordered_pack"
																						},
																						{ 
																							title : "sent pack",
																							name  : "sent_pack"
																						},
																						{ 
																							title : "received",
																							name  : "received"
																						},
																						{ 
																							title : "paid",
																							name  : "paid"
																						},
																						{ 
																							title : "problem",
																							name  : "problem"
																						},
																						{ 
																							title : "passive",
																							name  : "passive"
																						}
																					]
																				}
																			},
																			{
																				title : "comment",
																				name  : "comment",
																				changeable : { 
																					by     : "text"
																				}
																			}
																		],
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_account",
																				method : "table",
																			},
																			method : function (data) {

																				return JSON.parse(data)["return"]
																			}
																		}
																	},
																}
															},
															{
																name : "price promises",
																type : "table",
																pass : {
																	table : {
																		setup : {
																			row_id     : "user",
																			padding    : 30,
																			box_height : 100,
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title: "user",
																				name : "user",
																			},
																			{
																				title: "name",
																				name : "item_name",
																			},
																			{
																				title: "author",
																				name : "author",
																			},
																			{
																				title: "isbn",
																				name : "external_product_id",
																			},
																			{
																				title: "price",
																				name : "standard_price",
																			},
																		],
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_account",
																				method : "table",
																			},
																			method : function (data) {

																				var index, main, table, inner_index

																				main    = JSON.parse(data)["return"]
																				index   = 0
																				table   = []
																				promise = {}

																				
																				for (; index < main.length; index++) {
																					if ( main[index].price_promise = JSON.parse(main[index].price_promise) ) {
																						for (inner_index = 0; inner_index < main[index].price_promise.length; inner_index++) {
																							promise      = main[index].price_promise[inner_index]
																							promise.user = main[index].first_name +" "+ main[index].second_name
																							table.push(promise)
																						}
																					}
																				}
																				console.log(table)
																				return table
																			}
																		}
																	},
																}
															},
															{
																name : "issues",
																type : "table",
																pass : {
																	table : {
																		setup : {
																			row_id     : "email",
																			padding    : 30,
																			box_height : 100,
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title: "id",
																				name : "id",
																			},
																			{
																				title: "first name",
																				name : "first_name",
																			},
																			{
																				title: "second name",
																				name : "second_name",
																			},
																			{
																				title: "email",
																				name : "email",
																			},
																			{
																				title   : "status",
																				name    : "status",
																			},
																			{
																				title : "comment",
																				name  : "comment",
																			}
																		],
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_account",
																				method : "table",
																			},
																			method : function (data) {

																				var index, main, table

																				main  = JSON.parse(data)["return"]
																				index = 0
																				table = []

																				for (; index < main.length; index++)
																					if ( main[index].status === "problem" ) 
																						table.push(main[index])

																				return table
																			}
																		}
																	},
																}
															},
														]
													},
												}
											},
											{
												module : "data",
												title  : "Freepost",
												pass   : {
													settings : {
														tabs : [
															{
																name : "pending",
																type : "table",
																pass : {
																	submit_changed_value : function (data) {
																		
																		return {
																			action : "set_ticket",
																			method : "freepost_ticket_value",
																			paramaters : {
																				email       : data.row_id,
																				column_name : data.column_name,
																				value       : data.box_value
																			}
																		}
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_ticket",
																				method : "freepost",
																			},
																			method : function (data) {
																				var index, main, table

																				main  = JSON.parse(data)["return"]
																				index = 0
																				table = []

																				for (; index < main.length; index++)
																					if ( main[index].status === "pending" )
																						table.push(main[index])

																				return table
																			}
																		}
																	},
																	table : {
																		setup : {
																			row_id       : "id",
																			padding      : 30,
																			box_height   : 100,
																			box_width    : 100,
																			option_width : 50,
																			height       : 400,
																		},
																		options: [
																			{
																				name       : "print",
																				individual : false,
																				action     : function (rows) {
																					var request 
																					console.log(this)
																					console.log("an option is being performed")
																				}
																			}
																		],
																		fields : [
																			{
																				title : "user id",
																				name  : "user_id",
																			},
																			{
																				title : "first name",
																				name  : "first_name",
																			},
																			{
																				title : "second name",
																				name  : "second_name",
																			},
																			{
																				title : "email",
																				name  : "email",
																			},
																			{
																				title : "address",
																				name  : "address",
																			},
																			{
																				title : "post code",
																				name  : "post_code",
																			},
																			{
																				title : "town",
																				name  : "town",
																			},
																			{
																				title : "area",
																				name  : "area",
																			},
																			{
																				title : "date",
																				name  : "date",
																			},
																			{
																				title : "status",
																				name  : "status",
																				changeable : {
																					by      : "dropdown",
																					choices : [
																						{
																							title : "pending",
																							name  : "pending"
																						},
																						{ 
																							title : "sent",
																							name  : "sent"
																						}
																					]
																				}
																			}
																		]
																	}
																}
															},
															{
																name : "sent",
																type : "table",
																pass : {
																	submit_changed_value : function (data) {
																		
																		return {
																			action : "set_ticket",
																			method : "freepost_ticket_value",
																			paramaters : {
																				email       : data.row_id,
																				column_name : data.column_name,
																				value       : data.box_value
																			}
																		}
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_ticket",
																				method : "freepost",
																			},
																			method : function (data) {
																				var index, main, table

																				main  = JSON.parse(data)["return"]
																				index = 0
																				table = []

																				for (; index < main.length; index++)
																					if ( main[index].status === "sent" )
																						table.push(main[index])

																				return table
																			}
																		}
																	},
																	table : {
																		setup : {
																			row_id     : "id",
																			padding    : 30,
																			box_height : 100,
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title : "user id",
																				name  : "user_id",
																			},
																			{
																				title : "first name",
																				name  : "first_name",
																			},
																			{
																				title : "second name",
																				name  : "second_name",
																			},
																			{
																				title : "email",
																				name  : "email",
																			},
																			{
																				title : "address",
																				name  : "address",
																			},
																			{
																				title : "post code",
																				name  : "post_code",
																			},
																			{
																				title : "town",
																				name  : "town",
																			},
																			{
																				title : "area",
																				name  : "area",
																			},
																			{
																				title : "date",
																				name  : "date",
																			},
																			{
																				title : "status",
																				name  : "status",
																				changeable : {
																					by      : "dropdown",
																					choices : [
																						{
																							title : "pending",
																							name  : "pending"
																						},
																						{ 
																							title : "sent",
																							name  : "sent"
																						}
																					]
																				}
																			}
																		]
																	},
																}
															},
														]
													}
												}
											},
											{
												module : "data",
												title  : "Payment",
												pass   : {
													settings : {
														tabs : [
															{
																name : "scan freepost",
																type : "scan",
																pass : {
																	settings  : {
																		main_path : ajax_path
																	},
																	find_user : { 
																		title       : "Find User",
																		description : "This is where you find the user pong chin peng",
																		show        : {
																			information :[
																				{
																					what : "first_name",
																					as   : "First Name",
																				},
																				{
																					what : "second_name",
																					as   : "Second Name",
																				},
																				{
																					what : "address",
																					as   : "Address",
																				},
																				{
																					what : "area",
																					as   : "Area",
																				},
																				{
																					what : "town",
																					as   : "Town",
																				},
																				{
																					what : "post_code",
																					as   : "Post Code",
																				},
																				{
																					what : "status",
																					as   : "status",
																				},
																				{
																					what : "comment",
																					as   : "comment",
																				}
																			],
																		},
																		request     : {
																			path       : ajax_path,
																			paramaters : function (user) { 
																				return {
																					action : "get_account",
																					method : "full_account_by_id",
																					paramaters : {
																						id : user.id
																					}
																				}
																			}
																		}
																	},
																	find_book : {
																		title       : "Find Book",
																		description : "This is where you find the book adopted son pong chin peng",
																		show : {
																			condition : [
																				{
																					title : "1  : Used; Like New ",
																					name  : "1"
																				},
																				{
																					title : "2  : Used; Very Good ",
																					name  : "2"
																				},
																				{
																					title : "3  : Used; Good ",
																					name  : "3"
																				},
																				{
																					title : "4  : Used; Acceptable ",
																					name  : "4"
																				},
																				{
																					title : "5  : Collectible; Like New ",
																					name  : "5"
																				},
																				{
																					title : "6  : Collectible; Very Good ",
																					name  : "6"
																				},
																				{
																					title : "7  : Collectible; Good ",
																					name  : "7"
																				},
																				{
																					title : "8  : Collectible; Acceptable ",
																					name  : "8"
																				},
																				{
																					title : "11 : New",
																					name  : "11"
																				},
																			],
																		}
																	},
																	submit : {
																		cheque : { 
																			action : "get_pdf_maker",
																			method : "cheques"
																		},
																		user : {
																			action : "set_account",
																			method : "accounts"
																		}
																	}
																}
															},
															{
																name : "printed cheques",
																type : "table",
																pass : {
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_ticket",
																				method : "cheque",
																			},
																			method : function (data) {
																				return JSON.parse(data)["return"]
																			}
																		}
																	},
																	table : {
																		setup : {
																			padding    : 30,
																			box_height : 100,
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title : "id",
																				name  : "id",
																			},
																			{
																				title : "first name",
																				name  : "first_name",
																			},
																			{
																				title : "second name",
																				name  : "second_name",
																			},
																			{
																				title : "email",
																				name  : "email",
																			},
																			{
																				title : "address",
																				name  : "address",
																			},
																			{
																				title : "post code",
																				name  : "post_code",
																			},
																			{
																				title : "town",
																				name  : "town",
																			},
																			{
																				title : "area",
																				name  : "area",
																			},
																			{
																				title : "date",
																				name  : "date",
																			},
																			{
																				title : "amount",
																				name  : "amount",
																			}
																		]
																	}
																}
															},
														]
													}
												}
											},
											{
												module : "data",
												title  : "Stock",
												pass   : {
													settings : {
														tabs : [
															{
																name : "all",
																type : "table",
																pass : {
																	submit_changed_value : function (data) {
																		return {
																			action : "set_book",
																			method : "book_value",
																			paramaters : {
																				email       : data.row_id,
																				column_name : data.column_name,
																				value       : data.box_value
																			}
																		}
																	},
																	data : {
																		retrieve : {
																			path       : ajax_path,
																			paramaters : {
																				action : "get_book",
																				method : "book_table",
																			},
																			method : function (data) {
																				return JSON.parse(data)["return"]
																			}
																		}
																	},
																	table : {
																		setup : {
																			row_id     : "item_sku",
																			padding    : 30,
																			box_height : 100,
																			box_width  : 150,
																			height     : 400,
																		},
																		options: [
																			{
																				name       : "remove",
																				individual : true,
																				action     : function (rows) {

																					var index, self

																					index = 0
																					self  = this

																					for (; index < rows.length; index++) {
																						var request 
																						request = Object(this.request)
																						request = request.make()
																						request.send({
																							url : ajax_path,
																							data: {
																								action     : "set_book",
																								method     : "remove_book",
																								paramaters : {
																									book_id : this.data[rows[index]].item_sku
																								}
																							},
																							type: "POST"
																						})
																						this.find_row_node(rows[index]).remove()
																					}
																					this.option.selected = []
																				}
																			}
																		],
																		fields : [
																			{
																				title      : "id",
																				name       : "item_sku",
																			},
																			{
																				title : "section",
																				name  : "section",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "level",
																				name  : "level",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "number",
																				name  : "number",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "title",
																				name  : "item_name",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "price",
																				name  : "standard_price",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "quantity",
																				name  : "quantity",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "condition",
																				name  : "condition_type",
																				changeable : { 
																					by     : "dropdown",
																					choices: [
																						{
																							title : "1  : Used; Like New ",
																							name  : "1"
																						},
																						{
																							title : "2  : Used; Very Good ",
																							name  : "2"
																						},
																						{
																							title : "3  : Used; Good ",
																							name  : "3"
																						},
																						{
																							title : "4  : Used; Acceptable ",
																							name  : "4"
																						},
																						{
																							title : "5  : Collectible; Like New ",
																							name  : "5"
																						},
																						{
																							title : "6  : Collectible; Very Good ",
																							name  : "6"
																						},
																						{
																							title : "7  : Collectible; Good ",
																							name  : "7"
																						},
																						{
																							title : "8  : Collectible; Acceptable ",
																							name  : "8"
																						},
																						{
																							title : "11 : New",
																							name  : "11"
																						},
																					],
																				}
																			},
																			{
																				title : "condition note",
																				name  : "condition_note",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "author",
																				name  : "author",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "binding",
																				name  : "binding",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "published",
																				name  : "publication_date",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "edition",
																				name  : "edition",
																				changeable : { 
																					by     : "text"
																				}
																			},
																			{
																				title : "status",
																				name  : "status",
																				changeable : { 
																					by     : "dropdown",
																					choices: [
																						{
																							title : "expecting",
																							name : "expecting",
																						},
																						{ 
																							title : "recieved",
																							name : "recieved",
																						},
																						{ 
																							title : "problem",
																							name : "problem",
																						},
																						{ 
																							title : "passive",
																							name : "passive"
																						},
																					]
																				}
																			},
																			{
																				title : "comment",
																				name  : "comment",
																				changeable : { 
																					by     : "text"
																				}
																			}
																		]
																	}
																}
															},
															{
																name : "add books",
																type : "book",
																pass : {
																	text : {
																		title : "Scan",
																		description : "Scan the book isbn to see if a match can be found"
																	},
																	book : {
																		show : [
																			"item_name",
																			"author",
																			"condition_type",
																			"standard_price"
																		]
																	},
																	request : {
																		path : ajax_path,
																		find : {
																			action : "get_amazon",
																			method : "find",
																		},
																		submit : {
																			action : "set_book",
																			method : "books"
																		}
																	}
																}
															},
															{
																name : "export & recalculate",
																type : "buttons",
																pass : {
																	settings : {
																		path   : ajax_path,
																	},
																	request : {
																		update : {
																			amazon : {
																				action : "get_amazon",
																				method : "find"
																			},
																			submit : {
																				action : "set_book",
																				method : "book"
																			}
																		}
																	},
																	use : [
																		{	
																			type   : "regular",
																			title  : "Export",
																			action : function () { 

																				var request, self

																				self    = this
																				request = Object.create(this.request)
																				request = request.make()
																				request.send({
																					url : this.setup.settings.path,
																					data: {
																						action     : "get_book",
																						method     : "book_table_exported_as_tab_delimited_file",
																						paramaters : {}
																					},
																					type : "GET"
																				}).then(function (then) { 
																					self.notify({
																						type : "green",
																						text : "Inventory Link : "+ JSON.parse(then.change.target.response)["return"]
																					})
																				})
																			}
																		},
																		{	
																			type   : "regular",
																			title  : "Clear Table",
																			action : function () { 
																				if (! confirm("Clear Table?") ) return
																				var request, self

																				self    = this
																				request = Object.create(this.request)
																				request = request.make()
																				request.send({
																					url : this.setup.settings.path,
																					data: {
																						action     : "set_book",
																						method     : "clear_table",
																						paramaters : {}
																					},
																					type : "POST"
																				}).then(function (then) { 
																					self.notify({
																						type : "green",
																						text : "Table Cleared"
																					})
																				})
																			}
																		},
																		{	
																			type   : "update",
																			title  : "Recalculate",
																			action : function () { 

																				var request, self

																				self    = this
																				request = Object.create(this.request)
																				request = request.make()
																				request.send({
																					url : this.setup.settings.path,
																					data: {
																						action     : "get_book",
																						method     : "book_table",
																						paramaters : {}
																					},
																					type : "GET"
																				}).then(function (then) {
																					var books, new_request, index, upload_count
																					upload_count= 0
																					books       = JSON.parse(then.change.target.response)["return"]
																					index      	= 0
																					console.log(books)
																					for (; index < books.length; index++) {
																						new_request = Object.create(self.request)
																						new_request = new_request.make()
																						new_request.send({
																							url : self.setup.settings.path,
																							data: {
																								action : "get_amazon",
																								method : "find",
																								paramaters : {
																									amazon : {
																										search_by   : "isbn",
																										search_for  : "books",
																										filter_name : "sort",
																										typed       : books[index].external_product_id,
																									}
																								}
																							},
																							type : "GET"
																						}).then(function (then) {

																							var book, submit_request

																							book           = JSON.parse(then.change.target.response)["return"]
																							if ( book.length < 1 ) return
																							book[0].standard_price = parseFloat( book[0].standard_price ) - 0.1
																							submit_request = Object.create(self.request)
																							submit_request = submit_request.make()
																							submit_request.send({
																								url : self.setup.settings.path,
																								data: {
																									action : "set_book",
																									method : "book",
																									paramaters : {
																										book : book[0]
																									}
																								},
																								type : "POST"
																							}).then(function (then) {
																								upload_count = upload_count + 1
																								self.notify({
																									type : "green",
																									text : upload_count +" Uploaded"
																								})
																							})
																						})
																					}
																				})
																			}
																		}
																	]
																}
															}
														]
													}
												}
											},
											{
												module : "data",
												title  : "Settings",
												pass   : {
													settings : {
														tabs : [
															{
																name : "emails", 
																type : "admin",
																pass : {
																	main_submit_path : ajax_path,
																	main_sort_method : function (event) {
																		var response
																		response = JSON.parse(event.target.response)
																		return response.return.value
																	},
																	options : [
																		{	
																			name        : "freepost_email",
																			title       : "Freepost Pack Email",
																			description : "Variables and what they represent: USER_NAME = first and second name of the user, PRICE_PROMISE_SUM = the value of all the book quotes added in their price price promise basket, ADDED_BOOKS = a list of all the books in their price promise basket, has title, author and quote, USER_ID = the id of the user, USER_ADDRESS = the full address of the user, ( street address, area, post code, town ), DATE = the current date, USER_PASSWORD = the users password.",
																			type        : "textbox",
																			retrieve    : {
																				paramaters : {
																					action     : "get_setting",
																					method     : "option",
																					paramaters : {
																						name   : "pack_email"
																					}
																				},
																			},
																			submit      : {     
																				action : "set_setting",
																				method : "option_value",
																				name : "pack_email",
																			}
																		},
																		{	
																			name        : "pack_email",
																			title       : "Self Print Email",
																			description : "Variables and what they represent: USER_NAME = first and second name of the user, PRICE_PROMISE_SUM = the value of all the book quotes added in their price price promise basket, ADDED_BOOKS = a list of all the books in their price promise basket, has title, author and quote, USER_ID = the id of the user, USER_ADDRESS = the full address of the user, ( street address, area, post code, town ), DATE = the current date, USER_PASSWORD = the users password.",
																			type        : "textbox",
																			retrieve    : {
																				paramaters : {
																					action     : "get_setting",
																					method     : "option",
																					paramaters : {
																						name   : "print_email"
																					}
																				},
																			},
																			submit      : {     
																				action : "set_setting",
																				method : "option_value",
																				name   : "print_email",	
																			}
																		},
																		{	
																			name        : "password_email",
																			title       : "Password Recovery Email",
																			description : "Variables and what they represent: USER_NAME = first and second name of the user, PRICE_PROMISE_SUM = the value of all the book quotes added in their price price promise basket, ADDED_BOOKS = a list of all the books in their price promise basket, has title, author and quote, USER_ID = the id of the user, USER_ADDRESS = the full address of the user, ( street address, area, post code, town ), DATE = the current date, USER_PASSWORD = the users password.",
																			type        : "textbox",
																			retrieve    : {
																				paramaters : {
																					action     : "get_setting",
																					method     : "option",
																					paramaters : {
																						name   : "password_email"
																					}
																				},
																			},
																			submit      : {     
																				action : "set_setting",
																				method : "option_value",
																				name   : "password_email",	
																			}
																		}
																	],

																},
															},
														]
													}
												}
											}
										]
									}
								}
							},
							self : ".admin"
						}
					}
				},
				
			}
		});

		world.manifest(document.body);
	};

	return app;
});