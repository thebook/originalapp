define({

	make : function (module, modules) { 

		var self         = this;
		this.main        = module.main
		this.setup       = module.pass
		this.request     = modules.request
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			main                             : "body",
			basket                           : "search_books_description_title",
			basket_icon                      : "with-icon-description-title-thumbs-up",
			basket_text                      : "search_books_description_title_text",
			basket_box                       : "sell_and_buy_basket",
			basket_stats                     : "basket_stats",
			basket_stats_icon                : "with-icon-sell-basket-piggy",
			basket_stats_quote               : "with-icon-sell-basket-number",
			items                            : "result_books",
			book                             : "result_book_search_wrapper_left",
			book_wrap                        : "result_book_search",
			book_main_icon                   : "with-icon-info-for-book",
			book_main_image                  : "result_book_thumbnail_image",
			book_main_text                   : "result_book_search_text",
			book_main_title                  : "result_book_title",
			book_main_author                 : "result_book_author",
			book_main_sell                   : "result_book_price_wrap",
			book_main_sell_text              : "result_book_price_text",
			book_main_sell_price             : "result_book_price",
			book_main_button                 : "result_book_add_button_wrap",
			book_main_button_wrap            : "result_book_inner_wrap",
			book_main_button_add             : "result_book_add_button",
			book_main_button_text            : "result_book_add_button_text",
			book_main_button_unaccepted      : "result_book_add_button_static",
			book_main_button_unaccepted_text : "with-icon-added-to-sell-basket-tick",
			book_main_extra                  : "result_book_extra_options_buttons",
			book_main_extra_button           : "result_book_added_book_sell_button",
			book_main_extra_button_again     : "result_book_added_book_add_again_button",
			book_main_extra_arrow            : "with-icon-sell-now-arrow",
			book_main_extra_again_arrow      : "with-icon-add-again"
		}
		this.body        = this.maker.create_parts({
			wrap : {
				style : {
					display : "block",
					opacity : "1",
				},
				attribute : {
					"class" : this.class_names.main
				},
				children : {	
					basket : {
						attribute : {
							"class" : this.class_names.basket
						},
						children : {
							icon : {
								type : "span",
								attribute : {
									"class" : this.class_names.basket_icon
								},
							},
							promotional_text : {
								type : "span",
								property : {
									textContent : this.setup.text.promotion
								},
								attribute : {
									"class" : this.class_names.basket_text
								},
							},
							basket_box : {
								attribute : {
									"class" : this.class_names.basket_box
								},
								children : {
									stats : { 
										attribute : {
											"class" : this.class_names.basket_stats
										},
										children : {
											pig : {
												type : "span",
												property : {
													textContent : " Basket : "
												},
												attribute : {
													"class" : this.class_names.basket_stats_icon
												},
											},
											quote : {
												type : "span",
												property : {
													textContent : "0.00"
												},
												attribute : {
													"class" : this.class_names.basket_stats_quote
												},
											}
										}
									}
								}
							}
						}
					},
					items : {
						style : {
							top : this.setup.move.padding +"px"
						},
						attribute : {
							"class" : this.class_names.items
						},
						children : {
							book : {
								style : {
									display : "none"
								},
								attribute : {
									"class": this.class_names.book
								},
								children : { 
									main : {
										attribute : {
											"class": this.class_names.book_wrap
										},
										children : { 
											info : {
												attribute : {
													"class": this.class_names.book_main_icon
												},
											},
											image        : {
												type : "img",
												attribute : {
													"class": this.class_names.book_main_image,
													"src"  : "http://ecx.images-amazon.com/images/I/51-fHlGoU8L.jpg"
												},
											},
											text         : {
												attribute : {
													"class": this.class_names.book_main_text
												},
												children : {
													title : {
														property : {
															textContent : "Economics"
														},
														attribute : {
															"class": this.class_names.book_main_title
														},
													},
													author : {
														property : {
															textContent : "by Some Guy"
														},
														attribute : {
															"class": this.class_names.book_main_author
														},
													},
													sell : {
														attribute : {
															"class": this.class_names.book_main_sell
														},
														children : {
															text : { 
																type : "span",
																property  : {
																	textContent : this.setup.text.sell_for
																},
																attribute : {
																	"class": this.class_names.book_main_sell_text
																},
															},
															price : {
																type : "strong",
																property : {
																	textContent : "20.00"
																},
																attribute : {
																	"class": this.class_names.book_main_sell_price
																},
															}
														}
													}
												}
											},
											accept_button     : {
												attribute : {
													"class": this.class_names.book_main_button
												},
												children : {
													wrap : {
														attribute : {
															"class": this.class_names.book_main_button_wrap
														},
														children : {
															add : {
																attribute : {
																	"class": this.class_names.book_main_button_add
																},
																children : {
																	text : { 
																		property  : {
																			textContent : this.setup.text.add
																		},
																		attribute : {
																			"class": this.class_names.book_main_button_text
																		},
																	},
																}
															},
															added : {
																attribute : {
																	"class": this.class_names.book_main_button_unaccepted
																},
																children : {
																	text : { 
																		property  : {
																			textContent : this.setup.text.added
																		},
																		attribute : {
																			"class": this.class_names.book_main_button_unaccepted_text
																		},
																	},
																}
															},
														}
													},
												}
											},
										}
									},
									button : {
										attribute : {
											"class": this.class_names.book_main_extra
										},
										children : {
											sell : {
												attribute : {
													"class": this.class_names.book_main_extra_button
												},
												children : {
													arrow : {
														attribute : {
															"class": this.class_names.book_main_extra_arrow
														},
													},
													text : { 
														property  : {
															textContent : "Sell Now?"
														},
													},
												}
											},
											add  : {
												attribute : {
													"class": this.class_names.book_main_extra_button_again
												},
												children : {
													arrow : {
														attribute : {
															"class": this.class_names.book_main_extra_again_arrow
														},
													},
													text : { 
														property  : {
															textContent : "Sell Now?"
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
				}			
			}
		})
		
		this.maker.append_parts({
			parts : this.body
		})

		return this
	},

	add_book : function () { 

	},

	set_book : function (book) { 
		this.animation.animate({
			element : this.body.wrap.items.node,
			property: ["top"],
			from    : [this.setup.move.padding],
			to      : [0],
			how_long: this.setup.move.speed,
			easing  : "easeInCubic",
		})
		this.body.wrap.items.book.node.style.display                    = "block"
		this.body.wrap.items.book.main.text.title.node.textContent      = book.item_name.slice(0,10)
		this.body.wrap.items.book.main.text.author.node.textContent     = book.author.slice(0,18)
		this.body.wrap.items.book.main.text.sell.price.node.textContent = book.standard_price
		this.body.wrap.items.book.main.text.sell.price.node.textContent = book.standard_price
		this.body.wrap.items.book.main.image.node.setAttribute("src", book.main_image_url )
	},

	show_or_hide : function (act) { 

		var self, action

		self   = this
		action = {
			show : {
				from : 0,
				to   : 1,
			},
			hide : {
				from : 1,
				to   : 0,
			}
		}
		
		this.animation.animate({
			element : this.body.wrap.node,
			property: ["opacity"],
			from    : [action[act].from],
			to      : [action[act].to],
			how_long: 100,
			easing  : "easeInQuad",
		})

		if ( act === "hide" ) {
			window.setTimeout(function () {
				self.body.wrap.node.style.display = "none"
			}, 100 )
		} else { 
			this.body.wrap.node.style.display = "block"
		}
	}

});	