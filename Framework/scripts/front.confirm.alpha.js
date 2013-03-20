var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.confirm = function () {
		
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
												edit : {
													self : '<div class="basket_overview_edit_button">Edit Basket</div>'
												},
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
										self : '<div data-function-to-call="front.prototype.thank_you" class="checkout_button">Confirm & Complete</div>'
									}
								}
							}
						}
					}
				}
			}		
		};

		alpha.front.prototype.being.format.confirm_basket_book =
			'<div class="basket_overview_item">'+
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
			'</div>';

		alpha.front.prototype.parts.confirm = alpha.manifest({
			what_to_manifest : alpha.front.prototype.parts.confirm,
			append_to_who : $('.checkout') 
		});

		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.account_icon.self.removeClass('progress_icon_for_bar').addClass('progress_icon_for_bar_done');
		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.account_icon.branch.branch.circle.self.removeClass('progress_icon_circle_doing').addClass('progress_icon_circle_done');
		parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.confirm.branch.branch.circle.self.removeClass('progress_icon_circle').addClass('progress_icon_circle_doing');
		parts.bar.wrap.branch.branch.arrow.self.animate({ left : '234px' });

		// fill in the popup box with information
		parts.bar.wrap.branch.branch.progress_popup.branch.branch.title.branch.branch.text.self.text("Sale Confirmation");
		parts.bar.wrap.branch.branch.progress_popup.branch.branch.title.branch.branch.icon.branch.icon.removeAttr("class");
		parts.bar.wrap.branch.branch.progress_popup.branch.branch.title.branch.branch.icon.branch.icon.addClass("with-icon-confirm-progress-bar");
		parts.bar.wrap.branch.branch.progress_popup.branch.branch.text.self.text(alpha.front.prototype.being.text.confirmation);

		parts.confirm.wrap.self.css({ 'margin-top': '2000px' }).animate({ 'margin-top': ( parts.bar.wrap.branch.branch.progress_popup.self.height() + 50 ) + 'px' }, 1200);

		alpha.front.prototype.confirm.prototype.display_address_and_make_editable();
		alpha.front.prototype.confirm.prototype.display_basket_and_make_editable();

		alpha.front.prototype.being.on_page = 'checkout';

	};

	alpha.front.prototype.confirm.prototype.display_basket_and_make_editable = function () {

		var books, basket, basket_overview;
			books  			= '';
			basket_overview = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.basket_overview.branch.branch;
			basket 			= basket_overview.basket.branch.branch;

		$.each(alpha.front.prototype.being.basket.inside, 
		function (index, book) {

			books += alpha.replace_placeholders_with_values_in_text(
			{
				image : book.image,
				author: book.author,
				title : book.title,
				price : book.price /100,
				isbn  : book.ISBN
			}, 
			alpha.front.prototype.being.format.confirm_basket_book );
		});

		$(books).appendTo(basket.items.self);

		setTimeout(function () {
			alpha.sidebar({
				content : basket.items.self, 
				bar     : basket.bar.self, 
				handle  : basket.bar.branch.block,
				increase: 5
			});
		}, 1000);

		basket_overview.total.branch.total.text('£'+ ( alpha.front.prototype.being.basket.total/100 ));
	};

	alpha.front.prototype.confirm.prototype.display_address_and_make_editable = function () {

		var address = alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.address_overview.branch.branch,
			inputs  = address.address.branch.branch.inputs.branch,
			values  = alpha.front.prototype.being.user_info.fields;
			
			alpha.paste_values_into_fields([inputs.address, inputs.town, inputs.area, inputs.post_code], [values.address, values.address_town, values.address_area, values.post_code]);
			
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