define({

	make : function (instructions, modules) { 

		var self         = this;
		this.maker       = Object.create(modules.node_making_tools)
		this.settings    = instructions.settings,
		this.class_names = {
			wrap        : "footer_wrap",
			popup       : "popup_lightbox",
			popup_box   : "popup_box",
			popup_close : "with-icon-outside-popup-close",
			advert      : "popup_advertising",
			advert_title: "popup_advertising_title",
			advert_link : "popup_advertising_download",
			advert_image: "popup_advertising_page"
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
										attribute : {
											href    : self.settings.pdf_link,
											"class" : self.class_names.advert_link
										}
									}))

									for (index = 0; index < self.settings.advert_images.length; index++) {
										item = this.create_and_return_node({
											type : "img",
											attribute : {
												src     : self.settings.advert_images[index],
												"class" : self.class_names.advert_image
											}
										})
										parent["image_"+index] = item
										parent.node.appendChild(item)
									}

									return parent;

								}
							},
							// media  : {},
							// contact: {},
							// word   : {},
							// legal  : {},
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
				children : {

				}
			}
		})
			
		this.maker.append_parts({
			parts : this.popup
		})

		document.body.appendChild(this.popup.wrap.node)

		return document.createElement("div")
	}, 


});	