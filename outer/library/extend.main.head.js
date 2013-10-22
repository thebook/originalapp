define({

	make : function (module, modules) { 

		var self         = this;
		this.main        = module.main
		this.setup       = module.pass
		this.algorithm   = Object.create(modules.algorithm)
		this.request     = modules.request
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.class_names = {
			main                    : "header",
			wrap                    : "header_wrap",
			text_box                : "header_invisible_box",
			text_box_image          : "header_invisible_box_image_title",
			text_box_text           : "header_invisible_box_text_wrap",
			text_box_title          : "header_invisible_box_text_title",
			text_box_paragraph      : "header_invisible_box_text",
			search_box              : "header_text_box",
			search_box_title        : "header_text_box_title",
			search_box_input_wrap   : "header_text_box_input",
			search_box_input_box    : "header_field_for_input",
			search_box_input        : "header_input_block_for_search block_for_search",
			search_box_input_button : "with-icon-header-search",
			search_box_arrow        : "with-icon-header-text-box-arrow",
			background              : "header_image_wrap",
			background_image        : "header_image",
		}

		this.body        = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.main
				},
				children : {
					wrap : { 
						attribute : {
							"class" : this.class_names.wrap
						},
						children : { 
							foreground : {
								type : "div",
								attribute : {
									"class" : this.class_names.wrap
								},
								children : {
									text_box : { 
										attribute : {
											"class" : this.class_names.text_box
										},
										children : {
											logo : {
												type      : "a",
												attribute : {
													"href"  : "/"
												},
												children : {
													image : {
														type      : "img",
														attribute : {
															"class" : this.class_names.text_box_image,
															"src"   : this.setup.images.logo
														},		
													}
												}
											},
											text : {
												attribute : {
													"class" : this.class_names.text_box_text
												},
												children : {
													title     : {
														property : {
															textContent : this.setup.text.title
														},	
														attribute : {
															"class" : this.class_names.text_box_title
														},
													},
													paragraph : {
														property : {
															textContent : this.setup.text.paragraph
														},	
														attribute : {
															"class" : this.class_names.text_box_paragraph
														},
													}
												}
											},
										}
									},
									search : {
										attribute : { 
											"class" : this.class_names.search_box
										},
										children : {
											title  : {
												property : {
													textContent : this.setup.search.title
												},	
												attribute : { 
													"class" : this.class_names.search_box_title
												},
											},
											search : { 
												attribute : { 
													"class" : this.class_names.search_box_input_wrap
												},
												children : {
													input_wrap : {
														attribute : { 
															"class" : this.class_names.search_box_input_box
														},
														children : {
															input : {
																type : "input",
																attribute : { 
																	"class"       : this.class_names.search_box_input,
																	"placeholder" : this.setup.search.input,
																},
															}
														},
														methods : {
															addEventListener : ["keypress", function (event) { 
																if ( event.keyCode === 13 ) 
																	self.search_for_book({
																		isbn : event.target.value
																	})
															}]
														},
													},
													search_button : {
														type : "span",
														attribute : { 
															"class" : this.class_names.search_box_input_button
														},
														methods : {
															addEventListener : ["click", function (event) {
																self.search_for_book({
																	isbn : event.target.previousSibling.firstChild.value
																})
															}]
														},
													}
												}
											}
										}
									},
									search_box_arrow : { 
										attribute : { 
											"class" : this.class_names.search_box_arrow
										},
									}
								}
							},
							background : {
								attribute : {
									"class" : this.class_names.background
								},
								children : {
									image : { 
										type : "img",
										attribute : {
											"class" : this.class_names.background_image,
											"src"   : this.setup.images.background,
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
			parts : this.body
		})

		return this
	},

	search_for_book : function (book) { 

		var request, self

		self    = this
		request = Object.create(this.request)
		request = request.make()
		console.log(this.main.module)
		this.main.module.notify.notify("Searching For Your Book")
		request.send({
			url : this.setup.request.path,
			data: {
				action : this.setup.request.action,
				method : this.setup.request.method,
				paramaters : {
					amazon : {
						search_by   : "isbn",
						search_for  : "books",
						filter_name : "sort",
						typed       : book.isbn
					}
				}
			},
			type : "GET"
		}).then(function (then) { 
			self.deal_with_books(JSON.parse(then.change.target.response)["return"])
		})
	},

	deal_with_books : function (books) { 

		books = this.algorithm.run({
			 books     : books,
			 algorithm : "post",
			 filter    : "bellow_one"
		})

		if ( books.length < 1 ) {
			return 
		}

		this.main.being.book = books[0]
		this.main.route.change_url("/sell")
	}
});	