define(function () {

	var app = function (thought, modules) {
		
		var word, animator, ajax_path;

		ajax_path = window.location.origin + "/wp-admin/admin-ajax.php"
		animator  = Object.create(modules.libraries.animator)
		world     = Object.create(thought)
		animator.make()

		world.make({
			parts   : {
				node_making_tools : modules.libraries.node_making_tools,
				animation         : animator,
				model             : modules.libraries.model,
				table             : modules.libraries.table
			},
			thought : {
				wrap : {
					self : ".wrap",
					children : {
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
										use : [
											{
												module : "data",
												title  : "View Users",
												pass   : {
													settings : {
														tabs : [
															{
																name : "users",
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
																type : "recreate",
																pass : {
																	from       : ["price_promise"],
																	add_fields : ["first_name"],
																	formating  : function () {}
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
																					if ( main[index].status !== "passive" ) 
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
												title  : "View Freepost",
												pass   : {
													settings : {
														tabs : [
															{
																name : "pending",
																type : "table",
																pass : {
																	submit_changed_value : function (data) {
																		console.log(data)
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
																			row_id     : "id",
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
																		console.log("changed value")
																		return {
																			action : "set_freepost",
																			method : "ticket_value",
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
												title  : "View Cheques",
												pass   : {
													settings : {
														tabs : [
															{
																name : "all",
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
												title  : "View Books",
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
																			box_width  : 100,
																			height     : 400,
																		},
																		fields : [
																			{
																				title      : "id",
																				name       : "item_sku",
																				changeable : { 
																					by         : "text"
																				}
																			},
																			{
																				title : "section",
																				name  : "first_name",
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
																					by     : "text"
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
																					by     : "text"
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