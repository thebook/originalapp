var alpha = (function ( alpha, $ ) {

	alpha.open_ticket_in_admin = function (current_click) { 

		current_click.element.text("Loading...");
		
		if( current_click.element.hasClass('open_ticket') ) {

			current_click.element.removeClass('open_ticket').text("Create Ticket").next().fadeOut(400, function () { $(this).empty().remove() } );
		}		
		else {

			$.ajax({
				url  : ajaxurl,
				data : { action: "ticket_admin_creation" },
				complete : function (response) { 

					var response_text = $(response.responseText).css({ opacity : 0 });

					current_click.element.addClass('open_ticket').text("Cancel Ticket").after(response_text).next().animate({ opacity : 1 }, 400 );

					alpha.search_though_amazon_for_a_book.prototype.intitialize({ 
						wrap     : '.ticket_create_ticket',
						basket   : '.ticket_basket', 
						holder   : '.basket_hold', 
						quote    : '.quote',
						book     : '.ticket_book',
						complete : '.complete'
					});
				},
				dataType : 'json'
			});
		}
	};

	alpha.search_though_amazon_for_a_book = function (current_click) { 
		
		var instructions = current_click.instructions,
			typed_value  = $(instructions.input).val().trim(),
			search_by    = (alpha._is_number(typed_value)? instructions.numerical_search : 'keywords' ),
			klass        = this.prototype;
		
			current_click.element.text('Searching...');

			$.post(
				ajaxurl,
				{ action : instructions.action, paramaters : { typed : typed_value, search_by : search_by, search_for : instructions.search_for, filter_name : instructions.filter_by }},
				function (response) { 
					klass.display(response, instructions.book_wrap);
					current_click.element.text('Search');
				},
				'json');
	};

	alpha.search_though_amazon_for_a_book.prototype.intitialize = function (passed) { 

		this.basket(passed);
		this.basket.prototype.hide_or_show_complete_button();
	};

	alpha.search_though_amazon_for_a_book.prototype.display = function (books, book_wrap) { 

		var books_to_display = alpha.amazon.prototype.return_books(books),
			books            = this.endowment(books_to_display),
			book_wrap        = $(book_wrap);
	
			book_wrap.fadeOut(400,
			function () {
				$(this).empty();
				$.each(books_to_display, function (index, book) { book.manifest(book_wrap); });
				$(this).fadeIn(400);
			});
	};	

	alpha.search_though_amazon_for_a_book.prototype.endowment = function (to_endow) { 

		var prototype = this;

		$.each(to_endow,
		function (index, endow) { 

			endow.insert_into_basket = function () { 

				prototype.basket.prototype.update(this);
			};

			endow.manifest = function (element_to_append_to) { 

					this.lowest = prototype.quote(this.lowest);
				var klass  = this,
					string =
						'<div class="ticket_book_wrap">'+
						'<div class="ticket_book_thumbnail">'+
							'<img src="'+ this.image +'">'+
						'</div>'+
						'<div class="ticket_book_details">'+
							'<span class="ticket_book_detail">Title: <strong>' + this.title  +'</strong></span>'+
							'<span class="ticket_book_detail">Author: <strong>'+ this.author +'</strong></span>'+
							'<span class="ticket_book_detail">ISBN: <strong>'  + this.isbn   +'</strong></span>'+
							'<div class="ticket_quoted_ammount"><span class="we_quote">We Quote</span><span class="quote">£'+ ( this.lowest / 100 ) +'</span></div>'+
						'</div>'+
						'</div>';

					var button = $('<div class="ticket_button">Add Book</div>').on('click', 
					function () { 
						klass.insert_into_basket(); 
					});

					$(string)
					.children('.ticket_book_details')
					.append(button)
					.parent()
					.prependTo(element_to_append_to);
					// element_to_append_to.prepend(string);
			};
		});

		return to_endow;
	};

	alpha.search_though_amazon_for_a_book.prototype.quote = function (price_to_cut) { 

		return price_to_cut;
	};

	alpha.search_though_amazon_for_a_book.prototype.basket = function (elements) { 

		this.basket.prototype.store            = new Object;		
		this.basket.prototype.quote            = new Number;	
		this.basket.prototype.element 		   = new Object; 
		this.basket.prototype.element.wrap     = $( elements.wrap ); 
		this.basket.prototype.element.basket   = this.basket.prototype.element.wrap.find(elements.basket);
		this.basket.prototype.element.holder   = this.basket.prototype.element.basket.find(elements.holder);
		this.basket.prototype.element.quote    = this.basket.prototype.element.basket.find(elements.quote);
		this.basket.prototype.element.book     = this.basket.prototype.element.wrap.find(elements.book); 
		this.basket.prototype.element.complete = this.basket.prototype.element.wrap.find(elements.complete); 


		this.basket.prototype.hide_or_show_complete_button = function () { 

			this.quote > 0? this.element.complete.fadeIn(400) : this.element.complete.fadeOut(400);
		};

		this.basket.prototype.complete_ticket_on_admin_side = function () { 

			var basket = alpha.search_though_amazon_for_a_book.prototype.basket.prototype,
				ticket = new Object;				

				$.get( 
					ajaxurl, 
					{ action : 'show_users_for_ticket' },
					function (users) {

						var select_user_box = basket.select_user(users);

						$(select_user_box)
						.append('<div data-function-to-call="search_though_amazon_for_a_book.prototype.basket.prototype.create_ticket_from_admin" id="use_user" class="button">Complete</div>')
						.appendTo(basket.element.wrap);
					}, 
					'json');
		};

		this.basket.prototype.create_ticket_from_admin = function (current_click) { 							

			var basket = alpha.search_though_amazon_for_a_book.prototype.basket.prototype,
				ticket = {
					books   : basket.prepare_books_for_ticket(basket.store),
					by_user : $('.ticket_user').val(),
					quote   : basket.quote,
					status  : $('.ticket_set_status').val()
				};
			
			current_click.element.parent().fadeOut(400, function () { $(this).empty().remove(); });

			$.post(
				ajaxurl,
				{ action : 'complete_ticket', ticket : ticket },
				function (response) {
					
					$.jGrowl(response.message, { header : response.header, speed: 400, sticky : true });
				},
				'json');
		};

		this.basket.prototype.prepare_books_for_ticket = function (basket_books) { 

			var books = new Array;

				$.each(basket_books, 
				function (id, item) {
					books.push({  
						title  : item.title,
						author : item.author,
						quote  : item.lowest,
						isbn   : item.isbn
					});		
				});

				return books;
		};

		this.basket.prototype.select_user = function (users) { 

			var select_box = 
					'<div class="ticket_select_user_box">'+ 
					'<span>Set Ticket Status</span>'+
					'<select class="ticket_set_status">'+
						'<option value="waiting_arrival">Waiting Arrival</option>'+
						'<option value="complete">Complete</option>'+
						'<option value="returned">Returned Books</option>'+
						'<option value="expired">Expired</option>'+	
						'<option value="awaiting_return">Awaiting Return</option>'+
						'<option value="awaiting_response">Awaiting Response</option>'+	
					'</select>'+
					'<span>Assign Ticket To User</span>'+
					'<select class="ticket_user">';

				$.each(users, 
				function (key, user) { 

					select_box += '<option value="'+ user.id +'"> User of id : '+ user.id +'</option>';						
				});

				return select_box += '</select></div>';
		};

		this.basket.prototype.update  = function (value_to_insert) { 

			var time = new Date().getTime();
			
				this.store[time] = value_to_insert;
				this.manifest(value_to_insert, time);
				this.update_quote();
				this.hide_or_show_complete_button();
		};
		
		this.basket.prototype.remove_item  = function (paramaters) { 

			var basket = alpha.search_though_amazon_for_a_book.prototype.basket.prototype;
			
				delete( basket.store[paramaters.instructions.id]);
				basket.element.holder.find('#'+ paramaters.instructions.id ).fadeOut(400, function () { $(this).empty().remove(); } );
				basket.update_quote();
				basket.hide_or_show_complete_button();
		};

		this.basket.prototype.update_quote = function () { 

			var new_quote = 0; 

				$.each( this.store, 
				function (item_id, item) { 
					new_quote = new_quote + parseInt(item.lowest, 10); 
				}); 

				this.quote = new_quote;
				this.element.quote.text('£ '+ (this.quote / 100 ));
		};


		this.basket.prototype.manifest = function (value_to_insert, id_of_item) { 

			$('<div id="'+ id_of_item +'" class="ticket_basket_book">'+
				'<span class="ticket_basket_book_name">Title: <strong>'+ value_to_insert.title +'</strong></span>'+
				'<span class="ticket_basket_book_name">ISBN: <strong>'+  value_to_insert.isbn  +'</strong></span>'+
				'<span class="ticket_basket_book_name">£: <strong>'+     ( value_to_insert.lowest / 100 ) +'</strong></span>'+
				'<span data-function-to-call="search_though_amazon_for_a_book.prototype.basket.prototype.remove_item" data-function-instructions="{\'id\':\''+ id_of_item +'\'}" class="ticket_basket_remove_button">Remove Book</span>'+
			'</div>').appendTo(this.element.holder);
		};
	};

	alpha.ticket_tab = function (current_click) { 

		var tickets_to_show = current_click.element.attr('id'),
			tab 			= $('.ticket_window');

		if ( !current_click.element.hasClass('tickets_loaded') ) {

			current_click.element.addClass('tickets_loaded');

			tab.css({ display : 'none' });

			this.prototype.load(current_click); 
		}
		else { 

			tab.css({ display : 'none' });
			$('#window_of_'+ tickets_to_show).css({ display : 'block' });
		}
	};

	alpha.ticket_tab.prototype.load = function (current_click) { 

		var tickets_to_show = current_click.element.attr('id'),
			old_text 	    = current_click.element.text();
			
			current_click.element.text("Loading...");

		$.get(
			ajaxurl,
			{ action: 'get_tickets', tickets_to_show : tickets_to_show },
			function (response) { 
				
				var parent = current_click.element.parent();

					current_click.element.text(old_text);
						parent.after(response);

					if ( parent.attr('id') === 'window_of_'+ tickets_to_show ) { 
												
						parent.empty().remove();	
					}																
			},
			'html');
	};

	alpha.get_ticket_user_info = function (current_click) { 

		if ( current_click.element.hasClass('loaded_user') ) {

			current_click.element.removeClass('loaded_user').next().fadeOut(400, function () { $(this).empty().remove(); } );
		}
		else { 
			
			current_click.element.addClass('loaded_user');

			$.get(
				ajaxurl,
				{ action : "get_user_info_for_ticket", id : current_click.instructions.user_id },
				function (response) { 

					$(response).css({ opacity : 0 }).insertAfter(current_click.element);
					current_click.element.next().animate({ opacity : 1 }, 400 );
				},
				'html');
		}
	};

	alpha.check_books = function (current_click) { 

		var books = current_click.instructions;
			this.prototype.memory = this.prototype.sort_books_by_isbn(books);
			this.prototype.parts = {};
			this.prototype.parts.current_ticket_box = current_click.element.closest('.ticket_box'),
			this.prototype.parts.display_books      = $(this.prototype.get_books(books)),
			this.prototype.parts.input              = $('<input id="verify_books_search" type="text" value=""><div data-function-to-call="check_books.prototype.cross_out_book" class="ticket_button">Submit</div>'),

			this.prototype.parts.current_ticket_box.css({ 'z-index' : '2', 'position' : 'relative' });

			$('<div class="ticket_box_add_on"></div>').css({
				'z-index'  : '0',
				'position' : 'relative'
			})
			.append(this.prototype.parts.display_books)
			.append(this.prototype.parts.input)
			.insertAfter(this.prototype.parts.current_ticket_box);
	};

	alpha.check_books.prototype.get_books = function (books) { 

		var books_element = 
			'<div class="ticket_information_row">'+
				'<div class="ticket_information_type">Books Expected</div>'+
				'<div class="ticket_information">';

			$.each(books,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label '+ book.isbn +'">'+
							book.isbn +
						'</div>'+
					'</div>';
			});
					
			return books_element += '</div></div>';
	};

	alpha.check_books.prototype.sort_books_by_isbn = function (books) { 

		var sorted_books = {};

			$.each(books,
			function (key, book) { 

				( sorted_books[book.isbn]? sorted_books[book.isbn].push(book) : sorted_books[book.isbn] = [book] );
			});

		return sorted_books
	};

	alpha.check_books.prototype.cross_out_book = function () { 

		var isbn  = $('#verify_books_search').val(),
			klass = alpha.check_books.prototype,
			ticked_book = klass.parts.display_books.find('.'+ isbn );
			
			if ( ticked_book.length > 0 ) {

				( klass.memory[isbn].length > 1? klass.memory[isbn].pop() : delete klass.memory[isbn] );
				
				$(ticked_book[0]).css({ 'text-decoration' : 'line-through' }).removeClass(isbn);
			}
	};

	return alpha;

})(alpha || {}, jQuery );	