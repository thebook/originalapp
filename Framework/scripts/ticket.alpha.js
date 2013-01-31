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

					current_click.element
					.addClass('open_ticket')
					.text("Cancel Ticket")
					.after(response_text)
					.next().animate({ opacity : 1 }, 400 );

					alpha.search_though_amazon_for_a_book.prototype
					.basket({ basket : '.ticket_basket', holder : '.basket_hold', quote : '.quote' });
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

	alpha.search_though_amazon_for_a_book.prototype.display = function (books, book_wrap) { 

		var books_to_display = alpha.amazon.prototype.return_books(books),
			books            = this.endowment(books_to_display),
			book_wrap        = $(book_wrap);
	
			book_wrap.fadeOut(400,
			function () {
				
				$(this).empty();

					$.each(books_to_display, 
					function (index, book) {
						book.manifest(book_wrap);
					});

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
							'<span class="ticket_book_detail">Title: <strong>'+  this.title  +'</strong></span>'+
							'<span class="ticket_book_detail">Author: <strong>'+ this.author +'</strong></span>'+
							'<span class="ticket_book_detail">ISBN: <strong>'+   this.isbn   +'</strong></span>'+
							'<div class="ticket_quoted_ammount"><span class="we_quote">We Quote</span><span class="quote">£'+( this.lowest / 100 ) +'</span></div>'+
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

	alpha.search_though_amazon_for_a_book.prototype.basket = function (elements_of_the_basket) { 

		this.basket.prototype.store          = new Object;		
		this.basket.prototype.quote          = new Number;	
		this.basket.prototype.element 		 = new Object; 
		this.basket.prototype.element.basket = $( elements_of_the_basket.basket );
		this.basket.prototype.element.holder = this.basket.prototype.element.basket.find(elements_of_the_basket.holder);
		this.basket.prototype.element.quote  = this.basket.prototype.element.basket.find(elements_of_the_basket.quote);

		this.basket.prototype.complete_ticket = function () { 

			var the_basket = alpha.search_though_amazon_for_a_book.prototype.basket.prototype;

				var books = new Array;
					$.each(the_basket.store, 
						function (id, item) {

							books.push({  
								title  : item.title,
								author : item.author,
								quote  : item.lowest,
								isbn   : item.isbn
							});		
					});

				if ( the_basket.quote > 0 ) {
					
					$.post(
						ajaxurl,
						{ 
							action : 'complete_ticket', 
							quote  : the_basket.quote,
							books  : books
						},
						function () {},
						'json'
					);
				}
		};

		this.basket.prototype.update  = function (value_to_insert) { 

			var time = new Date().getTime();
			
				this.store[time] = value_to_insert;
				this.manifest(value_to_insert, time);
				this.update_quote();
		};

		this.basket.prototype.update_quote = function () { 

			var new_quote = 0; 

				$.each(
					this.store, 
				function (item_id, item) { 
					new_quote = new_quote + parseInt(item.lowest, 10); 
				}); 

				this.quote = new_quote;
				this.element.quote.text('£ '+ (this.quote / 100 ));
		};

		this.basket.prototype.remove_item  = function (paramaters) { 

			var basket = alpha.search_though_amazon_for_a_book.prototype.basket.prototype;
			
				delete( basket.store[paramaters.instructions.id]);
				basket.element.holder.find('#'+ paramaters.instructions.id ).fadeOut(400, function () { $(this).empty().remove(); } );
				basket.update_quote();
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

	return alpha;

})(alpha || {}, jQuery );	