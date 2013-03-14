var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.initialize_basket = function () { 

		this.parts = this.parts || {};

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
	
	return alpha;

})(alpha || {}, jQuery );