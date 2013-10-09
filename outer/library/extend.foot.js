define({

	make : function (instructions, modules) { 

		var self         = this;
		this.animation   = modules.animation
		this.maker       = Object.create(modules.node_making_tools)
		this.settings    = instructions.settings
		this.class_names = {
			wrap              : "footer_wrap",
			popup             : "popup_lightbox",
			popup_box         : "popup_box",
			popup_close       : "with-icon-outside-popup-close",
			navigation_wrap   : "footer_navigation",
			navigation_button : "footer_text",
			logo              : "footer_logos",
			logo_image        : "footer_logo",
			media             : "popup_media",
			media_logo        : "popup_media_logos",
			media_bubble      : "popup_media_bubble",
			media_email       : "popup_media_email",
			advert          : "popup_advertising",
			advert_title    : "popup_advertising_title",
			advert_link     : "popup_advertising_download",
			advert_image    : "popup_advertising_page",
			contact            : "popup_contact",
			contact_image      : "popup_contact_image",
			contact_text       : "popup_contact_text",
			contact_left       : "popup_contact_text_left",
			contact_left_text  : "popup_contact_text_left_text",
			contact_right      : "popup_contact_text_right",
			contact_right_text : "popup_contact_text_right_text",
			word               : "popup_word",
			word_title         : "popup_word_title",
			word_text          : "popup_word_text",
			word_line          : "popup_word_paragraph",
			legal              : "popup_legal", 
			legal_title        : "popup_legal_title",       
			legal_text         : "popup_legal_text",      
		}
		this.popup       = this.maker.create_parts({
			wrap : {
				type : "div",
				attribute : {
					"class" : this.class_names.popup
				},
				children : {
					box : {
						type : "div",
						attribute : {
							"class" : this.class_names.popup_box
						},
						children : {
							close : {
								type : "div",
								attribute : {
									"class" : this.class_names.popup_close
								},
								methods : {
									addEventListener : ["click", function () {
										self.close_popup();
									}]
								}
							},
							advert : {
								type : "div",
								attribute : {
									"class" : this.class_names.advert,
								},
								children : function (parent) {

									var index, item;

									parent.node.appendChild(this.create_and_return_node({
										type : "div",
										property : {
											textContent : self.settings.advert_title
										},
										attribute : {
											"class" : self.class_names.advert_title
										}
									}))

									parent.node.appendChild(this.create_and_return_node({
										type : "a",
										property : {
											textContent : self.settings.advert_download_text
										},
										attribute : {
											href    : self.settings.pdf_link,
											"class" : self.class_names.advert_link
										}
									}))

									for (index = 0; index < self.settings.advert_images.length; index++) {
										item = {
											node : this.create_and_return_node({
												type : "img",
												attribute : {
													src     : self.settings.advert_images[index],
													"class" : self.class_names.advert_image
												}
											})
										}
										parent["image_"+index] = item
										// parent.node.appendChild(item.node)
									}

									return parent;

								}
							},
							media  : {
								attribute : {
									"class" : this.class_names.media
								},
								children : {
									bubble : {
										type : "img",
										attribute : {
											src     : this.settings.media.bubble_path,
											"class" : this.class_names.media_bubble
										}
									},
									logo   : {
										type : "img",
										attribute : {
											src     : this.settings.media.logo_path,
											"class" : this.class_names.media_logo
										}
									},
									email  : {
										property : {
											textContent : this.settings.media.email
										},
										attribute : {
											"class" : this.class_names.media_email
										}
									}
								}
							},
							contact: {
								attribute : {
									"class" : this.class_names.contact
								},
								children : {
									image : {
										type : "img",
										attribute : {
											src     : this.settings.contact.image_path,
											"class" : this.class_names.contact_image
										}
									},
									text : {
										attribute : {
											"class" : this.class_names.contact_text
										},
										children : {
											left : {
												attribute : {
													"class" : this.class_names.contact_left
												},
												children : function (parent) {

													for (var index = 0; index < self.settings.contact.left_paragraph.length; index++)
														parent["line_"+index] = {
															node : this.create_and_return_node({
																property : {
																	textContent : self.settings.contact.left_paragraph[index]
																},
																attribute : {
																	"class" : self.class_names.contact_left_text
																}
															})
														}

													return parent;
												}
											},
											right : {
												attribute : {
													"class" : this.class_names.contact_right
												},
												children : function (parent) {

													for (var index = 0; index < self.settings.contact.right_paragraph.length; index++)
														parent["line_"+index] = {
															node : this.create_and_return_node({
																property : {
																	textContent : self.settings.contact.right_paragraph[index]
																},
																attribute : {
																	"class" : self.class_names.contact_right_text
																}
															})
														}

													return parent;
												}
											}
										}
									}
								}
							},
							word   : {
								attribute : {
									"class" : this.class_names.word
								},
								children : {
									title : {
										property : {
											textContent : this.settings.word.title
										},
										attribute : {
											"class" : this.class_names.word_title
										},
									},
									paragraph : {
										attribute : {
											"class" : this.class_names.word_text
										},
										children : function (parent) {

											for (var index = 0; index < self.settings.word.paragraph.length; index++)
												parent["line_"+index] = {
													node : this.create_and_return_node({
														property : {
															textContent : self.settings.word.paragraph[index]
														},
														attribute : {
															"class" : self.class_names.word_line
														}
													})
												}

											return parent;
										}
									}
								}
							},
							terms  : {
								attribute : {
									"class" : this.class_names.legal
								},
								children : {
									title : {
										property : {
											textContent : this.settings.legal.title
										},
										attribute : {
											"class" : this.class_names.legal_title
										},
									},
									paragraph : {
										attribute : {
											"class" : this.class_names.legal_text
										},
										children : function (parent) {

											for (var index = 0; index < self.settings.legal.text.length; index++)
												parent["line_"+index] = {
													node : this.create_and_return_node({
														type : ( self.settings.legal.text[index].type === "title" ? "h3" : "p" ),
														property : {
															textContent : self.settings.legal.text[index].content
														}
													})
												}

											return parent
										}
									}
								}
							},
						},
					}
				},
			}
		})
		this.foot        = this.maker.create_parts({
			wrap : {
				type : "div",
				attribute : {
					"class" : this.class_names.wrap
				},
				methods : {
					addEventListener : ["click", function (event) {
						self.show_popup(event)
					}]
				},
				children : {
					navigation : {
						attribute : {
							"class" : this.class_names.navigation_wrap
						},
						children : {
							contact : {
								property : {
									textContent : this.settings.navigation_text.contact
								},
								attribute : {
									"class" : this.class_names.navigation_button,
									"data-navigation" : "contact"
								}
							},
							media : {
								property : {
									textContent : this.settings.navigation_text.media
								},
								attribute : {
									"class" : this.class_names.navigation_button,
									"data-navigation" : "media"
								}
							},
							word : {
								property : {
									textContent : this.settings.navigation_text.word
								},
								attribute : {
									"class" : this.class_names.navigation_button,
									"data-navigation" : "word"
								}
							},
							terms : {
								property : {
									textContent : this.settings.navigation_text.terms
								},
								attribute : {
									"class" : this.class_names.navigation_button,
									"data-navigation" : "terms"
								}
							},
							advert : {
								property : {
									textContent : this.settings.navigation_text.advert
								},
								attribute : {
									"class" : this.class_names.navigation_button,
									"data-navigation" : "advert"
								}
							}
						}
					},
					logos : {
						attribute : {
							"class" : this.class_names.logo
						},
						children : {
							link : {
								type : "a",
								children : {
									logo_image : {
										type : "img",
										attribute : {
											src     : this.settings.logo_path,
											"class" : this.class_names.logo_image
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
			parts : this.popup
		})

		this.maker.append_parts({
			parts : this.foot
		})

		document.body.appendChild(this.popup.wrap.node)

		return this.foot.wrap.node
	},

	show_popup : function (event) {
		
		if ( event.target.getAttribute("data-navigation" ) ) {
			
			this.open_popup                    = event.target.getAttribute("data-navigation")
			document.body.style.overflow       = "hidden"
			this.popup.wrap.node.style.display = "block"
			this.popup.wrap.box[this.open_popup].node.style.display = "block"
			this.animation.animate({
				element : this.popup.wrap.node,
				property: ["opacity"],
				from    : [0],
				to      : [1],
				how_long: this.settings.animation_speed,
				easing  : "easeInQuad",
			})
			this.animation.animate({
				element : this.popup.wrap.box.node,
				property: ["top"],
				from    : [this.settings.popup_pushdown],
				to      : [0],
				how_long: this.settings.animation_speed,
				easing  : "easeInQuad",
			})
		}
	},

	close_popup : function () {	

		var self = this;	
		
		this.animation.animate({
			element : this.popup.wrap.node,
			property: ["opacity"],
			from    : [1],
			to      : [0],
			how_long: this.settings.animation_speed,
			easing  : "easeInQuad",
		})
		this.animation.animate({
			element : this.popup.wrap.box.node,
			property: ["top"],
			from    : [0],
			to      : [this.settings.popup_pushdown],
			how_long: this.settings.animation_speed,
			easing  : "easeInQuad",
		})
		window.setTimeout(function () {
			document.body.style.overflow       = "auto"
			self.popup.wrap.node.style.display = "none"
			self.popup.wrap.box[self.open_popup].node.style.display = "none"
		}, this.settings.animation_speed );
	}
});	