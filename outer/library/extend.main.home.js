define({

	make : function (module, modules) { 

		var self         = this;
		this.main        = module.main
		this.setup       = module.pass
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			main                     : "homepage_body_wrap",
			wrap                     : "homepage_body_inner_wrap",
			info_title               : "homepage_how_it_works_option_title_wrap",
			info_inner_title         : "homepage_how_it_works_option_title",
			info_title_part_one      : "homepage_how_it_works_option_title_part_one",
			info_title_part_two      : "homepage_how_it_works_option_title_part_two",
			information_numbers      : "homepage_how_it_works_boxes_numbers_wrap",
			information_number_one   : "with-icon-homepage-how-it-works-box-number-one",
			information_number_two   : "with-icon-homepage-how-it-works-box-number-two",
			information_number_three : "with-icon-homepage-how-it-works-box-number-three",
			info_boxes               : "homepage_how_it_works_boxes_wrap",
			info_box_first           : "homepage_how_it_works_box_wrap_first",
			info_box_first_content   : "homepage_how_it_works_box_first",
			info_box_second          : "homepage_how_it_works_box_wrap_second",
			info_box_second_content  : "homepage_how_it_works_box_second",
			info_box_third           : "homepage_how_it_works_box_wrap_last",
			info_box_third_content   : "homepage_how_it_works_box homepage_how_it_works_box_last",
			info_box_text            : "homepage_how_it_works_box_text_wrap",
			info_box_text_title      : "homepage_how_it_works_box_title",
			info_box_text_body       : "homepage_how_it_works_text",
			info_box_text_image      : "homepage_how_it_works_box_first_image",
			arrows                   : "homepage_arrows_warp",
			left_arrow               : "with-icon-homepage-how-it-works-box-left-blue-arrow",
			middle_arrow             : "with-icon-homepage-how-it-works-box-right-arrow",
			right_arrow              : "with-icon-homepage-how-it-works-box-left-arrow",
			trigger_box              : "homepage_how_it_works_boxes_buttons_wrap",
			trigger_button_wrap      : "homepage_how_it_works_box_first_button_wrap",
			trigger_button           : "homepage_how_it_works_box_button",
			trigger_button_arrow     : "with-icon-down-arrow-for-how-it-works-button",
			trigger_expand           : "homepage_how_it_works_box_button_expanded",
			trigger_expand_image     : "homepage_how_it_works_box_button_expanded_image",
			trigger_expand_text      : "homepage_how_it_works_box_button_expanded_text",
		}

		this.home        = this.maker.create_parts({
			main : {
				attribute : {
					"class" : this.class_names.main
				},
				children : { 
					wrap : { 
						attribute : {
							"class" : this.class_names.wrap
						},
						children : {
							info_title : { 
								attribute : {
									"class" : this.class_names.info_title
								},
								children : {
									title : {
										attribute : {
											"class" : this.class_names.info_inner_title
										},
										children : {
											part_one : {
												type : "span",
												property : {
													textContent : "Free"
												},
												attribute : {
													"class" : this.class_names.info_title_part_one
												}
											},
											part_two : {
												type : "span",
												property : {
													textContent : "post"
												},
												attribute : {
													"class" : this.class_names.info_title_part_two
												}
											}
										}
									}
								}
							},
							info_numbers : {
								attribute : {
									"class" : this.class_names.information_numbers
								},
								children : {
									one : {
										attribute : {
											"class" : this.class_names.information_number_one
										},
									},
									two : {
										attribute : {
											"class" : this.class_names.information_number_two
										},
									},
									three : { 
										attribute : {
											"class" : this.class_names.information_number_three
										},
									}
								}
							},
							info_boxes : {
								attribute : {
									"class" : this.class_names.info_boxes
								},
								children : {
									first : {
										attribute : {
											"class" : this.class_names.info_box_first
										},
										children : {
											content : {
												attribute : {
													"class" : this.class_names.info_box_first_content
												},
												children : {
													text : {
														attribute : {
															"class" : this.class_names.info_box_text
														},
														children : {
															title : {
																property : {
																	textContent : this.setup.box[0].title
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_title
																},
															},
															text  : {
																property : {
																	textContent : this.setup.box[0].description
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_body
																},
															}
														}
													},
													image : {
														type : "img",
														attribute : {
															"class" : this.class_names.info_box_text_image,
															"src"   : this.setup.box[0].image_path
														},
													}
												}
											},
											arrows : {
												attribute : {
													"class" : this.class_names.arrows
												},
												children : {
													part_one   : {
														attribute : {
															"class" : this.class_names.left_arrow
														},
													},
													part_two   : {
														attribute : {
															"class" : this.class_names.middle_arrow
														},
													},
													part_three : {
														attribute : {
															"class" : this.class_names.right_arrow
														},
													}
												}
											}
										}
									},
									second : {
										attribute : {
											"class" : this.class_names.info_box_second
										},
										children : {
											content : {
												attribute : {
													"class" : this.class_names.info_box_second_content
												},
												children : {
													text : {
														attribute : {
															"class" : this.class_names.info_box_text
														},
														children : {
															title : {
																property : {
																	textContent : this.setup.box[1].title
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_title
																},
															},
															text  : {
																property : {
																	textContent : this.setup.box[1].description
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_body
																},
															}
														}
													},
													image : {
														type : "img",
														attribute : {
															"class" : this.class_names.info_box_text_image,
															"src"   : this.setup.box[1].image_path
														},
													}
												}
											},
											arrows : {
												attribute : {
													"class" : this.class_names.arrows
												},
												children : {
													part_one   : {
														attribute : {
															"class" : this.class_names.left_arrow
														},
													},
													part_two   : {
														attribute : {
															"class" : this.class_names.middle_arrow
														},
													},
													part_three : {
														attribute : {
															"class" : this.class_names.right_arrow
														},
													}
												}
											}
										}
									},
									third : {
										attribute : {
											"class" : this.class_names.info_box_third
										},
										children : {
											content : {
												attribute : {
													"class" : this.class_names.info_box_third_content
												},
												children : {
													text : {
														attribute : {
															"class" : this.class_names.info_box_text
														},
														children : {
															title : {
																property : {
																	textContent : this.setup.box[2].title
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_title
																},
															},
															text  : {
																property : {
																	textContent : this.setup.box[2].description
																},	
																attribute : {
																	"class" : this.class_names.info_box_text_body
																},
															}
														}
													},
													image : {
														type : "img",
														attribute : {
															"class" : this.class_names.info_box_text_image,
															"src"   : this.setup.box[2].image_path
														},
													}
												}
											},
										}
									}
								}
							},
							info_buttons : {
								attribute : {
									"class" : this.class_names.trigger_box
								},
								children : function (parent) {

									var button, index

									for (index = 0; index < self.setup.box.length; index++) {
										
										button = this.create_parts({
											inner : {
												attribute : {
													"class"     : self.class_names.trigger_button_wrap,
												},
												children : { 
													trigger : {
														property  : {
															textContent : self.setup.box[index].button.title
														},
														attribute : {
															"class" : self.class_names.trigger_button,
															"data-open" : "false"
														},
														methods : {
															addEventListener : ["click", function (event) {
															console.log(event) 
																if ( event.target.getAttribute("data-open") )
																	self.open_box({
																		box : event.target,
																		open: event.target.getAttribute("data-open")
																	})
															}]
														},
														children : {
															arrow :  {
																type : "span",
																attribute : {
																	"class" : self.class_names.trigger_button_arrow
																}
															}
														}
													},
													text_box  : {
														attribute : {
															"class" : self.class_names.trigger_expand
														},
														children : {
															paragraph :  { 
																property : {
																	textContent : self.setup.box[index].button.text
																},
																attribute : {
																	"class" : self.class_names.trigger_expand_text
																},
															},
														}
													}
												}
											}
										})

										if ( self.setup.box[index].button.image_path ) {
											button.inner.text_box.image = {
												node : this.create_and_return_node({ 
													type      : "img",
													attribute : {
														"class" : self.class_names.trigger_expand_image,
														src     : self.setup.box[index].button.image_path
													}
												})
											}
										}

										this.append_parts({
											parts : button
										})

										parent["button_"+index] = {
											node : button.inner.node
										}

									}

									return parent
								}
							},
						}
					}
				}
			},
		})
		
		this.maker.append_parts({
			parts : this.home
		})

		return this.home.main.node
	},

	open_box : function (button) { 
		if ( button.open === "true" ) {
			button.box.setAttribute("data-open"," false" )
			button.box.nextSibling.style.display = "none"
		} else { 
			button.box.nextSibling.style.display = "block"
			button.box.setAttribute("data-open", "true" )
		}
	}
});	