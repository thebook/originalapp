var alpha = (function ( alpha, $ ) {

	// if (alpha.front && alpha.front.constructor === Function ) var old_front_prototype = alpha.front.prototype;

	alpha.front = function () { 

		this.track_events_on_this('.wrap', 'click');
		
		this.front.prototype.parts = {};
		this.front.prototype.parts.book = {};

		this.front.prototype.being = {};		
		this.front.prototype.being.on_page      = '';
		this.front.prototype.being.user_id      = '';
		this.front.prototype.being.user_info    = {};
		this.front.prototype.being.search       = {};
		this.front.prototype.being.listed_items = {};

		this.front.prototype.being.basket            = {};
		this.front.prototype.being.basket.items      = {};
		this.front.prototype.being.basket.inside     = {};		
		this.front.prototype.being.basket.displayed  = {};
		this.front.prototype.being.basket.total      = '';
		this.front.prototype.being.basket.quote_by   = '';
		this.front.prototype.being.first_book_format = 
			'<div id="book_{(id)}" class="{(wrapper)}">'+
				'<div class="result_book_search">'+				
					'<span data-function-instructions="{\'id\':\'{(id)}\'}" data-function-to-call="front.prototype.open_book_popup" class="with-icon-info-for-book"></span>'+				
					'<img src="{(image)}" class="result_book_thumbnail_image">'+				
					'<article class="result_book_search_text">'+
						'<strong class="result_book_title">{(title)}</strong>'+
						'<div class="result_book_author">{(author)}</div>'+
						'<div class="result_book_price_wrap">'+
							'<span class="result_book_price_text">Sell for - </span>'+
							' <storng class="result_book_price">£{(price)}</storng>'+
						'</div>'+
					'</article>'+				
					'<div class="result_book_add_button_wrap">'+
						'<div class="result_book_inner_wrap">'+
							'<div class="result_book_add_button">'+
								'<span data-function-instructions="{\'id\':\'{(id)}\'}"data-function-to-call="front.prototype.add_to_basket" class="result_book_add_button_text">Add To Basket</span>'+
							'</div>'+
							'<div class="result_book_add_button_static">'+
								'<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'+
							'</div>'+
						'</div>'+						
					'</div>'+
				'</div>'+							
			'</div>';
		this.front.prototype.being.sell_again_buttons = 
			'<div class="result_book_extra_options_buttons">'+
				'<span class="result_book_added_book_sell_button">'+
					'<span class="with-icon-sell-now-arrow"></span>'+
					'Sell now?'+
				'</span>'+
				'<span data-function-instructions="{\'id\':\'{(id)}\'}"data-function-to-call="front.prototype.add_a_book_to_basket" class="result_book_added_book_add_again_button">'+
					'<span class="with-icon-add-again"></span>'+
					'Add again+'+
				'</span>'+
			'</div>';
		this.front.prototype.being.basket_book_format = 
			'<div class="store_basket_pop_up_content_item">'+
				'<div class="store_basket_pop_up_content_item_thumbnail"><img src="{(image)}"></div>'+
				'<div class="store_basket_pop_up_content_item_title">{(title)}</div>'+
				'<div class="store_basket_pop_up_content_item_author">{(author)}</div>'+
				'<div class="store_basket_pop_up_content_item_isbn_wrap">'+
					'<div class="store_basket_pop_up_content_item_isbn_highlight">ISBN: </div>'+
					'<div class="store_basket_pop_up_content_item_isbn">{(isbn)}</div>'+
				'</div>'+
				'<div class="store_basket_pop_up_content_item_sell_price_wrap">'+
					'<div class="store_basket_pop_up_content_item_sell_price_text">Sell for:</div>'+
					'<div class="store_basket_pop_up_content_item_sell_price">£{(price)}</div>'+
				'</div>'+
				'<div data-function-instructions="{\'id\' : \'{(id)}\'}" data-function-to-call="front.prototype.remove_item_from_basket" class="with-icon-x-for-store-basket-pop-up-content-item"></div>'+
			'</div>';		

		this.front.prototype.being.basket.watch( 'items', alpha.front.prototype.display_books );
		this.front.prototype.being.basket.watch( 'inside', alpha.front.prototype.reorder_basket );
		this.front.prototype.being.watch( 'on_page', alpha.front.prototype.page_changer );

		this.front.prototype.search_bar();
		this.recyclabus();
		this.front.prototype.initialize_basket();
		this.front.prototype.popup_book();
		this.front.prototype.being.on_page = 'homepage_body_wrap';
	};

	alpha.front.prototype.popup_book = function () { 

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
											}
										}
									}
								}
							}
						}
					}
				}				
			}
		};

		this.parts.book.popup = alpha.manifest({
			what_to_manifest : this.parts.book.popup,
			append_to_who : $('.wrap') 
		});

		this.parts.book.popup.wrap.self.css({ display : 'none' });
	};

	alpha.front.prototype.close_book_popup = function (wake) {

		alpha.front.prototype.parts.book.popup.wrap.self.animate({ top: '1000px' }, 400, function () { $(this).css({ display: 'block'}); });
	};

	alpha.front.prototype.add_to_basket_from_popup = function (wake) {
		
		var buttons = alpha.front.prototype.parts.book.popup.wrap.branch.branch.book.branch.branch.books_text.branch.branch.buttons;
			button  = buttons.branch.branch.inner_wrap.branch.branch;

		alpha.front.prototype.add_a_book_to_basket(wake,
		function () {
				
			if (wake.instructions.add_again === 'false') {
				button.add_again_button.self.css({ display :'block' });
				buttons.self.css({ height : button.add_button.self.height() +'px' });
				buttons.branch.branch.inner_wrap.self.css({ height: '100%', 'float':'left', position:'relative' }).animate({top: '-'+ button.add_button.self.height() +'px' }, 400);
			}
		});
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

	alpha.front.prototype.page_changer = function (property, old_page, page) {

		if ( old_page.length < 1 ) old_page = 'pages';

		if ( old_page !== page )
			$('.'+ old_page ).fadeOut(500, function () { $('.'+ page ).fadeIn(500); });		

		return page;
	};

	alpha.front.prototype.change_page = function (wake, callback) {

		callback = callback || false;

		alpha.front.prototype.being.on_page = wake.instructions.page;

		if (callback)
			callback(wake.instructions.page);	
	};

	alpha.front.prototype.reorder_basket = function (poperty, old_books, books) { 
		
		var prototype       = alpha.front.prototype,
			total_price     = 0,
			items_wrap      = prototype.parts.basket.popup.wrap.branch.branch.content.branch.branch.items.self,
			total_wrap      = prototype.parts.basket.popup.wrap.branch.branch.content.branch.branch.total.branch.number,
			string_of_books = '';

			if ( $.isEmptyObject(books) ) {
				items_wrap.fadeOut(400, function () { 
					$(this).empty().append('<div class="store_basket_pop_up_contet_empty_item">No items in your basket at the momment</div>').fadeIn(400); });
			}
			else {
				$.each(books,
				function (index, book) { 
					
					string_of_books += 
						alpha.replace_placeholders_with_values_in_text(
						{ 	
							image   : book.image,
							isbn    : book.ISBN,
							title   : book.title,
							author  : book.author,
							price   : book.price / 100,
							id      : index
						},
							alpha.front.prototype.being.basket_book_format
						);

					total_price += parseInt(book.price);
				});

				items_wrap.fadeOut(400, function () { 
					$(this).empty().append(string_of_books).fadeIn(400); });																				
			}

			prototype.parts.basket.self.wrap.branch.branch.basket_box.branch.branch.stats.branch.quote.text(books.keys().length);
			total_wrap.text('£'+ ( total_price / 100 ) );

			return books;
	};

	alpha.front.prototype.display_books = function (poperty, old_books, books) { 

		var string_of_books = '', 
			keeping_count   = 0, 
			wrap_names      = ['result_book_search_wrapper_left', 'result_book_search_wrapper', 'result_book_search_wrapper_right'];

			$.each(books,
			function (index, book) { 
				
				string_of_books += 
					alpha.replace_placeholders_with_values_in_text(
					{ 	
						wrapper : wrap_names[keeping_count],
						image   : book.image,
						title   : book.title.slice(0, 10) +'...',
						author  : book.author.slice(0, 18) +'...',
						price   : book.price / 100,
						id 	    : index
					},
						alpha.front.prototype.being.first_book_format
					);

				( keeping_count === 2? keeping_count = 0 : keeping_count++ );
				
			});

			$('.result_books').animate({ top : "800px" }, 1000, function () {
				$(this).empty().remove();
			});

			string_of_books = $('<div class="result_books"></div>').append(string_of_books);			
			string_of_books.css({ position : "relative", top : "1000px"}).appendTo('.body');
			$('.result_books').animate({ top : "0px" }, 1500);
			
			return books;
	};	

	alpha.front.prototype.remove_item_from_basket = function (wake) { 

		var basket = alpha.front.prototype.being.basket.inside;

			delete basket[wake.instructions.id];
			alpha.front.prototype.being.basket.inside = basket;
	};

	alpha.front.prototype.add_to_basket = function (wake) { 

		alpha.front.prototype.add_a_book_to_basket(wake, 
		function (book_id, id) {

			var the_book, sell_again_buttons

			the_book = $('#book_'+ wake.instructions.id);

			the_book.children().addClass('result_book_search_added').removeClass('result_book_search');			
			the_book.find('.result_book_add_button_text').removeAttr('data-function-to-call').removeAttr('data-function-instructions');
			the_book.find('.result_book_add_button_wrap').children().css({ position : "relative" }).animate({ top : "-45px" }, 400 );


			sell_again_buttons += alpha.replace_placeholders_with_values_in_text(
				{ id : id }, 
				alpha.front.prototype.being.sell_again_buttons );
			
			$(sell_again_buttons).css({ opacity : 0  }).appendTo(the_book);
			the_book.find('.result_book_extra_options_buttons').animate({ opacity : 1 }, 500 );

		});			
	};

	alpha.front.prototype.add_a_book_to_basket = function (wake, callback) {

		callback = callback || false;

		var value = alpha.front.prototype.being.basket.inside,
			key   = (value.keys().length + 1);

			value[key] = alpha.front.prototype.being.basket.items[wake.instructions.id];
			alpha.front.prototype.being.basket.inside = value;

		if (callback)
			callback(alpha.front.prototype.being.basket.items[wake.instructions.id], wake.instructions.id);
	};

	alpha.front.prototype.search_bar = function () { 

		var prototype = this;

		this.parts.search = {
			wrap : {
				self   : '<div class="input_for_bar"></div>',
				branch : {
					branch : {
						input : {
							self : '<div class="field_for_input"></div>',
							branch : {
								input_block : '<input type="text" class="input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">'
								}
							},
						button : {
							self : '<div class="button_for_input"></div>',
							branch : {
								icon : '<span data-function-instructions="{\'type\':\'bar\'}" data-function-to-call="front.prototype.search_though_amazon" class="with-icon-search"></div>'
								}}}
							}}};

		this.parts.search = alpha.manifest({
			what_to_manifest : this.parts.search,
			append_to_who : $('.bar') 
		});
	};

	alpha.front.prototype.get_the_search_value_from_blocks = function (wake) { 

		var blocks = wake.input.find(wake.block_class_name),
			search = new String;

			blocks.each(function (index, element) { 

				search += $.trim($(element).val());

				if ( blocks.length > 1 )
					search += ',';
			});

			return search;
	};

	alpha.front.prototype.search_though_amazon = function (wake) { 

		var search, search_by, input;

			input = ( wake.instructions.type == 'bar'? alpha.front.prototype.parts.search.wrap.branch.branch.input.self : $('.header_field_for_input') );
			
			search = alpha.front.prototype.get_the_search_value_from_blocks({ 
				input : input, 
				block_class_name : '.block_for_search'
			});
			search_by = (search.is_number()? 'isbn' : 'keywords' );
			
			alpha.amazon.prototype.get_books_from_amazon({
				typed     : search,
				search_by : search_by
			},
			function (books) { 

				books = alpha.amazon.prototype.clean_array(books);
				books = alpha.amazon.prototype.pick_which_details_to_get_out_of_the_book_properties(books, 
				{
					lowest_used_price : 'Amount',
					image             : 'URL',
					lowest_new_price  : 'Amount',
					price  			  : 'Amount',
					editorial_review  : 'EditorialReview'
				});
				books = alpha.amazon.prototype.remove_books_that_dont_have_given_properties(books, ['image', 'author', 'price']);

				alpha.front.prototype.being.basket.items = books;	
				alpha.front.prototype.being.on_page = 'body';			
			});
	};

	alpha.front.prototype.initialize_basket = function () { 

		this.parts.basket = {};

		this.parts.basket.self = {
			wrap : {
				self   : '<div class="search_books_description_title"></div>',
				branch : {
					branch : {
						icon : {
							self : '<span class="with-icon-description-title-thumbs-up"></span>'
						},
						promotional_text : {
							self : '<span class="search_books_description_title_text">Our price promise guaranteed</span>'
						},
						basket_box : {
							self   : '<div class="sell_and_buy_basket"></div>',
							branch : {
								branch : {
									stats : { 
										self   : '<div id="buy_basket" class="basket_stats"></div>',
										branch : {
											sell_text : '<span class="sell_basket_text">Sell : </span>',
											quote : '<span class="sell_basket_number">0</span>'
										}}}}
									}}}}};

		this.parts.basket.popup = { 
			wrap : {
				self   : '<div style="display: none;" class="store_basket_pop_up"></div>',
				branch : { 
					branch : {
						arrow : { 
							self : '<div class="with-icon-store-basket-pop-up-arrow"></div>'
						},
						content : {
							self   : '<div class="store_basket_pop_up_content"></div>',
							branch : {
								branch : {
									items : {
										self : '<div class="store_basket_pop_up_content_items_wrap"></div>'
									},
									total : { 
										self   : '<div class="store_basket_pop_up_content_total_wrap"></div>',
										branch : {
											text   : '<div class="store_basket_pop_up_content_total_text">Total:</div>',
											number : '<div class="store_basket_pop_up_content_total_number"></div>'
										}
									}									
								}
							}
						},
						buttons : { 
							self   : '<div class="store_basket_pop_up_button_wrap"></div>',
							branch : {
								// recyclabus_button : '<div class="store_basket_pop_up_button_second">Convert To Recyclabus Quote</div>',
								checkout : '<div class="store_basket_pop_up_button_first">Check And Continue</div>'
							}
						},
						popup_text : {
							self : '<div class="store_basket_pop_up_text">Currently showing freepost prices</div>'
						}}}
					}};			
										
		this.parts.basket.self = alpha.manifest({
			what_to_manifest : this.parts.basket.self,
			append_to_who : $('.body') 
		});

		this.parts.basket.popup = alpha.manifest({
			what_to_manifest : this.parts.basket.popup,
			append_to_who : $('.body') 
		});

		this.parts.basket.self.wrap.branch.branch.basket_box.self.toggle(
		function () { 
			alpha.front.prototype.parts.basket.popup.wrap.self.show();
		},
		function () {
			alpha.front.prototype.parts.basket.popup.wrap.self.hide();
		});

		this.being.basket.inside = {};	
	};

	return alpha;

})(alpha || {}, jQuery );	