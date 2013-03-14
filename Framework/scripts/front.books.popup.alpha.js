var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.popup_book = function () { 

		this.parts = this.parts || {};

		this.parts.book.popup = {
			wrap : {
				self   : ' <div data-function-to-call="front.prototype.close_book_popup" class="search_books_expanded_book_wrap"></div>',
				branch : {
					branch : {
						book : {
							self   : '<div class="search_books_expanded_book"></div>',
							branch : {
								branch : { 
									close : { 
										self : '<span data-function-to-call="front.prototype.close_book_popup" class="with-icon-info-close"></span>'
									},
									image_wrap : {
										self   : '<div class="search_books_expanded_image_wrap"></div>',
										branch : {
											image : '<img src="" class="search_books_expanded_image">'
										}
									},
									books_text : {
										self   : '<div class="search_books_expanded_text"></div>',
										branch : {
											branch : {
												title : { 
													self : '<div class="search_books_expanded_title"></div>'
												},
												author : { 
													self : '<div class="search_books_expanded_author"></div>'
												},
												isbn : { 
													self   : '<div class="search_books_expanded_isbn"></div>',
													branch : {
														text : '<span class="search_books_expanded_isbn_highlight">isbn: </span>',
														isbn : '<span></span>'
													}
												},
												description : {
													self   : '<div class="search_books_expanded_book_description"></div>',
													branch : {
														title : '<div class="search_books_expanded_book_description_title">Book Description</div>',
														text  : '<div class="search_books_expanded_book_description_text"></div>' 
													}										
												},
												quote : {
													self   : '<div class="search_books_expanded_book_price">Well Buy For: </div>',
													branch : {
														price : '<span class="search_books_expanded_book_price_highlight">£5.30</span>'
													}
												},
												buttons : {
													self   : '<div class="search_books_expanded_book_add_to_sell_basket_wrap"></div>',
													branch : {
														branch : {
															inner_wrap : {
																self   : '<div class="search_books_expanded_book_add_to_sell_basket_inner_wrap"></div>',
																branch : {
																	branch : {
																		add_button : {
																			self   : '<div class="search_books_expanded_book_add_to_sell_basket_button"></div>',
																			branch : {
																				text : '<span data-function-instructions="" data-function-to-call="front.prototype.add_to_basket_from_popup" class="search_books_expanded_book_add_to_sell_basket_button_text">Add To Basket</span>'
																			}
																		},
																		add_again_button : {
																			self   : '<div class="search_books_expanded_book_add_to_sell_basket_add_again_button"></div>',
																			branch : {
																				text : '<span data-function-instructions="" data-function-to-call="front.prototype.add_to_basket_from_popup" class="with-icon-added-to-sell-basket-expanded-tick">Add Again?</span>'
																			}
																		}}}
																	}}}}
																}}}
															}}}
														}}}
													};

		this.parts.book.popup = alpha.manifest({
			what_to_manifest : this.parts.book.popup,
			append_to_who : $('.wrap') 
		});

		this.parts.book.popup.wrap.self.css({ display : 'none' });
	};

	alpha.front.prototype.open_book_popup = function (wake) {

		var popup      = alpha.front.prototype.parts.book.popup,
			popup_book = popup.wrap.branch.branch.book.branch.branch,
			book       = alpha.front.prototype.being.basket.items[wake.instructions.id];

			book.description = ( book.editorial_review && book.editorial_review.Content.length > 35? book.editorial_review.Content : "Sorry no given description is available at this time" );
			popup_book.image_wrap.branch.image.attr('src', book.image);
			popup_book.books_text.branch.branch.title.self.text(book.title);
			popup_book.books_text.branch.branch.author.self.text('by '+ book.author);
			popup_book.books_text.branch.branch.description.branch.text.text(book.description);
			popup_book.books_text.branch.branch.isbn.branch.isbn.text(book.ISBN);
			popup_book.books_text.branch.branch.buttons.branch.branch.inner_wrap.branch.branch.add_button.branch.text.attr('data-function-instructions', "{ 'id' : '"+ wake.instructions.id +"', 'add_again' : 'false' }");
			popup_book.books_text.branch.branch.buttons.branch.branch.inner_wrap.self.css({ position: 'static', top: '0' });
			popup_book.books_text.branch.branch.buttons.branch.branch.inner_wrap.branch.branch.add_again_button.self.css({ display: 'none' });
			popup_book.books_text.branch.branch.buttons.branch.branch.inner_wrap.branch.branch.add_again_button.branch.text.attr('data-function-instructions', "{ 'id' : '"+ wake.instructions.id +"', 'add_again' : 'true' }");
			popup_book.books_text.branch.branch.quote.branch.price.text( '£'+ ( book.price/100 ));

			popup.wrap.self
			.css({ top : '0px', background: 'transparent', width:'5%', height:'5%', 'font-size':((16/100)*5)+'px', opacity:0, display:'block', margin:'50% 47.5%' })
			.animate({ width:'100%', height:'100%', 'font-size':'16px', opacity:1, margin:0 }, 300);
	};

	alpha.front.prototype.close_book_popup = function (wake) {

		alpha.front.prototype.parts.book.popup.wrap.self.animate({ top: '1000px' }, 400, function () { $(this).css({ display: 'block'}); });
	};	

	return alpha;


})(alpha || {}, jQuery );