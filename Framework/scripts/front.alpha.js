var alpha = (function ( alpha, $ ) {

	if (alpha.front && alpha.front.constructor === Function ) var old_front_prototype = alpha.front.prototype;

	alpha.front = function () { 

		this.track_events_on_this('.wrap', 'click');

		this.front.prototype.parts = {};
		this.front.prototype.parts.book = {};

		this.front.prototype.being = {};		
		this.front.prototype.being.on_page      	 = '';
		this.front.prototype.being.first_search 	 = false;
		this.front.prototype.being.user_info    	 = {};
		this.front.prototype.being.user_info.id    	 = false;
		this.front.prototype.being.user_info.fields  = {};
		this.front.prototype.being.user_info.signed_in = false;
		this.front.prototype.being.search       	 = {};
		this.front.prototype.being.listed_items 	 = {};

		this.front.prototype.being.format            = {};
		this.front.prototype.being.basket            = {};
		this.front.prototype.being.basket.items      = {};
		this.front.prototype.being.basket.inside     = {};		
		this.front.prototype.being.basket.displayed  = {};
		this.front.prototype.being.basket.total      = 0;
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
								'<span data-function-instructions="{\'id\':\'{(id)}\'}"data-function-to-call="front.prototype.add_to_basket" class="result_book_add_button_text">Add To Sell Basket</span>'+
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
		this.front.prototype.being.basket_book_format_tick = 
			'<div id="notification_{(index)}" class="legend_mark_x_symbol">'+
				'<span class="with-icon-x-for-legend"></span>{(message)}'+
			'</div>';

		this.front.prototype.being.email				  = {};
		this.front.prototype.being.email.address          = "noreply@recyclabook.co.uk";
		this.front.prototype.being.email.name             = "Recyclabook";
		this.front.prototype.being.email.templates		  = {};
		this.front.prototype.being.email.templates.ticket         = {};
		this.front.prototype.being.email.templates.ticket.subject = "We are awaiting your books";
		this.front.prototype.being.email.templates.ticket.message = "<p>Hello, thank you very much for using recyclabook, your cheque is waiting for you and will be sent as soon as we get your books, until then we will keep a lookout.</p><p>All the best</p><p>The Recyclabook Team</p>";
		this.front.prototype.being.email.templates.created_user         = {};
		this.front.prototype.being.email.templates.created_user.subject = "Welcome To Recyclabook";
		this.front.prototype.being.email.templates.created_user.message = "<p>Hello and thank you for joining Recyclabook, now that you have an account you can track tickets on your account, edit your settings and keep an eye out on various other things, we hope that the time you spend using our services will be a pleasant one</p><p>All the best</p><p>The Recyclabook Team</p>";


		this.front.prototype.being.text = {};
		this.front.prototype.being.text.registration = "This will not only create your profile hub that will let you track payments, check book orders and edit details but makes sure we make the payment out to the right person and send the freepost pack to the correct address.";
		this.front.prototype.being.text.confirmation = "Better be safe than sorry, Just check the books and address are correct and edit any mistakes if need be, then chose which type of freepost you prefer and confirm your sale. Shazam!";
		this.front.prototype.parts.registration_wrap = $('.account_wrap');

		this.front.prototype.being.basket.watch( 'items', alpha.front.prototype.display_books );

		this.front.prototype.being.basket.watch( 'inside', function (property_name, old_books, books) {

			alpha.front.prototype.reorder_basket(property_name, old_books, books);
			alpha.front.prototype.calculate_total_quote_for_sold_books(property_name, old_books, books);
			
			if (alpha.front.prototype.parts.confirm !== undefined ) { 
				alpha.front.prototype.confirm.prototype.display_basket(alpha.front.prototype.confirm.prototype.update_sidebar);
				alpha.front.prototype.parts.confirm.wrap.branch.branch.confirmation_overview.branch.branch.basket_overview.branch.branch.edit.self.click();
			}

			return books;
		});

		this.front.prototype.being.basket.watch('total', function (property_name, old_total, total ) {

			if (alpha.front.prototype.parts.confirm    !== undefined ) alpha.front.prototype.confirm.prototype.update_total();
			if ( alpha.front.prototype.parts.thank_you !== undefined ) alpha.front.prototype.parts.thank_you.banner.branch.branch.inner_banner.branch.branch.summary.branch.quote.text('£'+ alpha.front.prototype.being.basket.total/100 );
			return total;
		});

		this.front.prototype.being.watch( 'on_page', alpha.front.prototype.page_changer );

		this.front.prototype.navigation();
		this.front.prototype.search_bar();
		this.front.prototype.recyclabus();
		this.front.prototype.initialize_basket();
		this.front.prototype.popup_book();
		this.front.prototype.being.on_page = 'homepage_body_wrap';
	};

	alpha.front.prototype.calculate_total_quote_for_sold_books = function (property_name, old_books, books) { 

		var total = 0;

		if (books) $.each(books, function (index, book) { total += parseInt(book.price); });

		alpha.front.prototype.being.basket.total = total;

		return books;
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

	alpha.front.prototype.create_user = function (information_to_commit, callback) {

		$.post(
			ajaxurl,
			{
				action : 'create_user',
				user   : information_to_commit
			},
			function (the_data_of_the_user) {
				alpha.front.prototype.sign_in_user(the_data_of_the_user);				 
				if ( callback && callback.constructor === Function ) callback(the_data_of_the_user);
			},
			'json'
		);
	};	

	alpha.front.prototype.create_ticket = function (callback) { 

		$.post(
			ajaxurl,
			{
				action : 'complete_ticket',
				ticket : {
					status : 'waiting_arrival',
					quote  : alpha.front.prototype.being.basket.total,
					books  : alpha.front.prototype.being.basket.inside,
					by_user: alpha.front.prototype.being.user_info.id
				}
			},
			function (ticket) {
				if ( callback && callback.constructor === Function ) callback(ticket);
			},
			'json'
		);
	};

	alpha.front.prototype.sign_in_user = function (user) {

		alpha.front.prototype.being.user_info.id = user.id;
	};

	alpha.front.prototype.complete_book_selling = function (callback) { 

		callback = callback || false;

		if (!alpha.front.prototype.being.user_info.signed_in) {

			alpha.front.prototype.create_user(alpha.front.prototype.being.user_info.fields,
			function (user) {
				alpha.front.prototype.being.user_info.signed_in = true;
				alpha.front.prototype.create_ticket(callback);
				alpha.front.prototype.send_email("created_user");
			});
		}
		else { 
			alpha.front.prototype.create_ticket(callback);
			alpha.front.prototype.send_email("ticket",
			function (message) { 
				
				var new_message = "<p>Expected Books:</p><ul>";

					$.each(alpha.front.prototype.being.basket.inside, function (index, book ) {
						new_message += 
							"<li>"+
								"<p>"+ book.title  +"</p>"+
								"<p>by "+ book.author +"</p>"+
								"<p>ISBN : "+ book.isbn   +"</p>"+
							"</li>";
					});

					new_message += "</ul>";
					new_message += "<p>Your Quote : £"+ alpha.front.prototype.being.basket.total/100 +"</p>";
					new_message += message;

					return new_message;
			});
		}
	};


	alpha.front.prototype.go_back_to_shopping = function () {
		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.self.animate({ top:'0px' }, 300);
		alpha.front.prototype.registration.prototype.progress_to_icon();
		alpha.front.prototype.parts.bar.wrap.branch.branch.navigation.branch.branch.wrap.branch.branch.progress.branch.branch.back.self.css({ display : 'none', opacity : 0 });
		$('.result_books').animate({ top : "0px" }, 1000);
		alpha.front.prototype.being.on_page = 'body';
	};

	alpha.front.prototype.send_email = function (state, message_callback, callback) {

		var email   = alpha.front.prototype.being.email,
			user    = alpha.front.prototype.being.user_info,
			message = email.templates[state].message;

			if ( message_callback && message_callback.constructor === Function ) message = message_callback(message);

			$.post(ajaxurl, { 
				action : "email", 
				email  : { 
					from_email : email.address,
					from_name  : email.name, 
					to_email   : user.fields.e_mail, 
					to_person  : user.fields.first_name +" "+ user.fields.second_name, 
					subject    : email.templates[state].subject, 
					message    : message
				}
			}, 
			function (response) { 
				if ( callback && callbac.constructor === Function ) callback(response);
			}, 
			'json');
	};
	

	$.extend(alpha.front.prototype, old_front_prototype);

	return alpha;

})(alpha || {}, jQuery );	