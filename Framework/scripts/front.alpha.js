var alpha = (function ( alpha, $ ) {

	alpha.front = function () { 

		this.track_events_on_this('.bar', 'click');
		this.front.prototype.parts = {};

		this.front.prototype.being = {};		
		this.front.prototype.being.user_id      = '';
		this.front.prototype.being.user_info    = {};
		this.front.prototype.being.search       = {};
		this.front.prototype.being.listed_items = {};

		this.front.prototype.being.basket            = {};
		this.front.prototype.being.basket.items      = {};
		this.front.prototype.being.basket.displayed  = {};
		this.front.prototype.being.basket.total      = '';
		this.front.prototype.being.basket.quote_by   = '';
		// this.front.prototype.being.first_book_format = 
		// 	'<div class="result_book_search_wrapper_left">'+
		// 		'<div class="result_book_search_added">'+				
		// 			'<span class="with-icon-info-for-book"></span>'+				
		// 			'<img src="{image}" class="result_book_thumbnail_image">'+				
		// 			'<article class="result_book_search_text">'+
		// 				'<strong class="result_book_title">{title}</strong>'+
		// 				'<div class="result_book_author">{author}</div>'+
		// 				'<div class="result_book_price_wrap">'+
		// 					'<span class="result_book_price_text">Sell for -</span>'+
		// 					'<storng class="result_book_price">{price}</storng>'+
		// 				'</div>'+
		// 			'</article>'+				
		// 			'<div class="result_book_add_button">'+
		// 				'<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'+
		// 			'</div>'+
		// 		'</div>'+			
		// 		'<div class="result_book_extra_options_buttons">'+
		// 			'<span class="result_book_added_book_sell_button">'+
		// 				'<span class="with-icon-sell-now-arrow"></span> Sell now? </span>'+
		// 			'<span class="result_book_added_book_add_again_button">'+
		// 				'<span class="with-icon-add-again"></span>Add again+</span>'+
		// 		'</div>'+
		// 	'</div>';

		this.front.prototype.being.basket.watch( 'items', alpha.front.prototype.display_books );

		this.front.prototype.search_bar();
	};

	alpha.front.prototype.display_books = function (poperty, old_books, books) { 

		// $.each(books,
		// function () { 

		// });
		
		alpha.replace_placeholders_with_values_in_text(
			{ replacement : 'this part has been replaced'},
			'some stiff was here and {(replacement)}'
		);
	};

	alpha.replace_placeholders_with_values_in_text = function (placeholders_to_values_guide, text) { 

		text.replace(/(?<=\{\()[^\}]*(?=\)\})/, function (match) {
			return placeholders_to_values_guide[match];
		});
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
								input_block : '<input type="text" class="input_block_for_search">'
								}
							},
						button : {
							self : '<div class="button_for_input"></div>',
							branch : {
								icon : '<span data-function-to-call="front.prototype.search_though_amazon" class="with-icon-search"></div>'
								}
							}
						}
					}		
				}
			};

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

		var search = alpha.front.prototype.get_the_search_value_from_blocks({ 
				input : alpha.front.prototype.parts.search.wrap.branch.branch.input.self, 
				block_class_name : '.input_block_for_search'
			});
			
			alpha.amazon.prototype.get_books_from_amazon({
				typed     : search
			},
			function (books) { 
				
				books = alpha.amazon.prototype.clean_array(books);
				books = alpha.amazon.prototype.pick_which_details_to_get_out_of_the_book_properties(books, 
				{
					lowest_used_price : 'Amount',
					image             : 'URL',
					lowest_new_price  : 'Amount',
					price  			  : 'Amount'
				});

				alpha.front.prototype.being.basket.items = books;
			});
	};

	alpha.front.prototype.basket = function () { 

		var prototype = alpha.basket.prototype;
	};

	return alpha;

})(alpha || {}, jQuery );	