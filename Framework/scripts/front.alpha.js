var alpha = (function ( alpha, $ ) {

	if (alpha.front && alpha.front.constructor === Function ) var old_front_prototype = alpha.front.prototype;

	alpha.front = function () { 

		this.track_events_on_this('.wrap', 'click');

		this.front.prototype.parts = {};
		this.front.prototype.parts.book = {};

		this.front.prototype.being = {};		
		this.front.prototype.being.on_page      = '';
		this.front.prototype.being.first_search = false;
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
				'<span data-function-to-call="front.prototype.registration" class="result_book_added_book_sell_button">'+
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

		this.front.prototype.navigation();
		this.front.prototype.search_bar();
		this.front.prototype.recyclabus();
		this.front.prototype.initialize_basket();
		this.front.prototype.popup_book();
		this.front.prototype.being.on_page = 'homepage_body_wrap';
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

	alpha.front.prototype.remove_item_from_basket = function (wake) { 

		var basket = alpha.front.prototype.being.basket.inside;

			delete basket[wake.instructions.id];
			alpha.front.prototype.being.basket.inside = basket;
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

	$.extend(alpha.front.prototype, old_front_prototype);

	return alpha;

})(alpha || {}, jQuery );	