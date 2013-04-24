var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.confirm = function () {

		// if (alpha.front.prototype.parts.confirm === undefined ) alpha.front.prototype.confirm.prototype.manifest();
			
		// alpha.front.prototype.confirm.prototype.animate();
		// alpha.front.prototype.confirm.prototype.display_address_and_make_editable();

		// setTimeout(function () {
		// 	alpha.front.prototype.confirm.prototype.display_basket(alpha.front.prototype.confirm.prototype.update_sidebar);
		// 	alpha.front.prototype.confirm.prototype.update_total();
		// 	alpha.front.prototype.confirm.prototype.make_basket_items_removable();
		// }, 1000 );
		
	};

	alpha.front.prototype.confirm.prototype.animate = function () {

		alpha.front.prototype.registration.prototype.progress_to_icon(3);
		alpha.front.prototype.registration.prototype.refill_popup_box({
			title : "Sale Confirmation",
			icon  : "with-icon-confirm-progress-bar",
			text  : "confirmation"
		});

		alpha.front.prototype.parts.confirm.wrap.self
		.css({ 'margin-top': '2000px' })
		.animate({ 'margin-top': ( alpha.front.prototype.parts.bar.wrap.branch.branch.progress_popup.self.height() + 50 ) + 'px' }, 1200);
	};

	alpha.front.prototype.confirm.prototype.manifest = function () {

		var parts = alpha.front.prototype.parts;		
			
			alpha.front.prototype.parts.confirm = {
				wrap : {
					self   : '<div class="checkout_wrap"></div>',
					branch : {
						branch : {
							confirmation_overview : {
								self   : '<div class="confirmation_overview"></div>',
								branch : {
									branch : {
										basket_overview : {
											self   : '<div class="basket_overview_outer_wrap"></div>',
											branch : {
												branch : {
													basket : {
														self   : '<div class="basket_overview_wrap"></div>',
														branch : {
															branch : {
																title : {
																	self : '<div class="basket_overview_title">Basket Overview</div>'
																},
																items : {
																	self : '<div class="basket_overview_items"></div>'
																},
																bar : {
																	self   : '<div class="basket_overview_bar"></div>',
																	branch : {
																		block : '<div class="basket_overview_bar_block"></div>'
																	}
																}
															}
														}
													},
													// edit : {
													// 	self : '<div class="basket_overview_edit_button">Edit Basket</div>'
													// },
													total : {
														self  : '<div class="basket_overview_total_wrap"></div>',
														branch : {
															total : '<div class="basket_overview_total"></div>',
															text  : '<div class="basket_overview_total_text">Total Sale: </div>'
														}
													}
												}
											}
										},
										address_overview : {
											self   : '<div class="address_overview_wrap_outer"></div>',
											branch : { 
												branch : {
													address : {
														self   : '<div class="address_overview_wrap"></div>',
														branch : {
															branch : {
																title : {
																	self : '<div class="address_overview_title">Address Confirmation</div>'
																},
																inputs : {
																	self   : '<div class="address_overview_inputs"></div>',
																	branch : {
																		address  : '<input readonly class="address_overview_input" value="Address">',
																		area     : '<input readonly class="address_overview_input" value="Area">',
																		town     : '<input readonly class="address_overview_input" value="Town">',
																		post_code: '<input readonly class="address_overview_input_small" value="Post Code">'
																	}
																}																
															}
														}
													},
													edit : {
														self : '<div class="address_overview_edit">Edit Address</div>'
													}
												}
											}
										}
									}
								}
							},
							choice_wrap : {
								self   : '<div class="how_would_you_like_wrap"></div>',
								branch : {
									branch : {
										title : {
											self : '<div class="how_would_you_like_title">How would you like to send your books?</div>'
										},
										titles_tab : {
											self   : '<div class="how_would_you_like_titles_wrap"></div>',
											branch : {
												tab_one : '<div class="how_would_you_like_tab_title_active">We Send you a freepost pack</div>'
												// tab_two : '<div class="how_would_you_like_tab_title">Print your own freepost pack</div>'
											}
										},
										tabs : {
											self   : '<div class="how_would_you_like_tab_wrap"></div>',
											branch : {
												branch : {
													tab_one : {
														self   : '<div class="how_would_you_like_we_send_active_tab"></div>',
														branch : {
															branch : {
																image : {
																	self : '<img class="we_send_freepost_tab_image" src="'+ frameworkuri +'/CSS/Includes/works/freepost_send.png">'
																},
																text : {
																	self   : '<div class="we_send_freepost_tab_text_wrap"></div>',
																	branch : {
																		branch : {
																			text : {
																				self   : '<ul class="we_send_freepost_tab_text"></ul>',
																				branch : {
																					paragraph_one   : '<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>',
																					paragraph_two   : '<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>',
																					paragraph_three : '<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>'
																					}
																				},
																			check : {
																				self   : '<div class="we_send_freepost_tab_tick_button"></div>',
																				branch : {
																					tick : '<div class="with-icon-we-checkout-tick"></div>',
																					text : '<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>'
																				}
																			}
																		}
																	}
																}
															}														
														}													
													}
												}
											}
										},
										button : {
											self : '<a href="thank_you" class="checkout_button">Confirm & Complete</a>'
										}
									}
								}
							}
						}
					}
				}		
			};

			alpha.front.prototype.being.format.confirm_basket_book =
				'<div id="confirm_basket_item_{(id)}" class="basket_overview_item">'+
					'<img class="basket_overview_item_thumbnail" src="{(image)}">'+
					'<div class="basket_overview_item_text_wrap">'+
						'<div class="basket_overview_item_text_title">{(title)}</div>'+
						'<div class="basket_overview_item_text_author">by {(author)}</div>'+
						'<div class="basket_overview_item_isbn"><span class="basket_overview_item_isbn_highlight">isbn</span> {(isbn)}</div>'+
					'</div>'+
					'<div class="basket_overview_item_price_wrap">'+
						'<div class="basket_overview_item_price_text">Sell for</div>'+
						'<div class="basket_overview_item_price">£{(price)}</div>'+
					'</div>'+
				'</div>'+
				'<div id="confirm_basket_item_{(id)}" data-function-instructions="{ \'id\' : \'{(id)}\'}" data-function-to-call="front.prototype.confirm.prototype.remove_confirm_basket_item" class="with-icon-x-for-overview-item confirm_basket_remove"></div>';

			alpha.front.prototype.parts.confirm = alpha.manifest({
				what_to_manifest : alpha.front.prototype.parts.confirm,
				append_to_who : $('.checkout') 
			});
	};

	alpha.front.prototype.confirm.prototype.display_basket = function (callback) {

		var books = '',
			items = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.basket_overview.branch.branch.basket.branch.branch.items.self;

		$.each(alpha.front.prototype.being.basket.inside, function (index, book) {

			books += alpha.replace_placeholders_with_values_in_text( {
				image : book.image,
				author: book.author,
				title : book.title,
				price : book.price /100,
				isbn  : book.ISBN,
				id    : index
			}, alpha.front.prototype.being.format.confirm_basket_book );			
		});

		items.empty().append(books);

		if ( callback && callback.constructor === Function ) callback();
	};

	alpha.front.prototype.confirm.prototype.update_sidebar = function (callback) {

		var basket = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.basket_overview.branch.branch.basket.branch.branch;

			alpha.sidebar({
				content : basket.items.self, 
				bar     : basket.bar.self, 
				handle  : basket.bar.branch.block,
				increase: 5,
				content_height : 180
			});

			if ( callback && callback.constructor === Function ) callback();
	};

	alpha.front.prototype.confirm.prototype.update_total = function (callback) {

		alpha.front.prototype.parts
		.confirm.wrap.branch.branch
		.confirmation_overview.branch.branch
		.basket_overview.branch.branch
		.total.branch.total.text('£'+ ( alpha.front.prototype.being.basket.total/100 ));

		if ( callback && callback.constructor === Function ) callback();
	};

	alpha.front.prototype.confirm.prototype.make_basket_items_removable = function () {

		var basket = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.basket_overview.branch.branch;
		
			basket.edit.self.toggle(
			function () {
				basket.edit.self.text('Stop Edit');
				basket.basket.branch.branch.items.self.find('.confirm_basket_remove').css({ display : 'inline-block' });
			},
			function () {
				basket.edit.self.text('Edit Basket');
				basket.basket.branch.branch.items.self.find('.confirm_basket_remove').css({ display : 'none' });
			});
	};

	alpha.front.prototype.confirm.prototype.remove_confirm_basket_item = function (wake) {

		var id     = wake.instructions.id,
			basket = alpha.front.prototype.being.basket.inside;

			$('#confirm_basket_item_'+ id ).remove();
			delete basket[id];		
			alpha.front.prototype.being.basket.inside = basket;
	};

	alpha.front.prototype.confirm.prototype.display_address_and_make_editable = function () {

		var address = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.address_overview.branch.branch,
			inputs  = address.address.branch.branch.inputs.branch,
			values  = alpha.front.prototype.being.user_info.fields;
			
			alpha.paste_values_into_fields(
				[inputs.address, inputs.town, inputs.area, inputs.post_code], 
				[values.address, values.address_town, values.address_area, values.post_code]);
			
			address.edit.self.toggle( 
			function () {
				address.edit.self.text('Set Edits');
				address.address.branch.branch.inputs.self.find('input').removeAttr('readonly');
			},
			function () {
				address.edit.self.text('Edit');
				address.address.branch.branch.inputs.self.find('input').attr( 'readonly', true );
			});
	};

	return alpha;

})(alpha || {}, jQuery );