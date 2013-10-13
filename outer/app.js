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
																	submit_changed_value : function (data) {
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
													model : {
														retrieve : {
															users : {
																paramaters : {
																	action : "get_account",
																	method : "table",
																}
															}
														},
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