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

		klass.basket('.ticket_basket');

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
						// book.insert_into_basket();
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

				var quote  = '21',
					klass  = this,
					string =
						'<div class="ticket_book_wrap">'+
						'<div class="ticket_book_thumbnail">'+
							'<img src="'+ this.image +'">'+
						'</div>'+
						'<div class="ticket_book_details">'+
							'<span class="ticket_book_detail">Title: <strong>'+  this.title  +'</strong></span>'+
							'<span class="ticket_book_detail">Author: <strong>'+ this.author +'</strong></span>'+
							'<span class="ticket_book_detail">ISBN: <strong>'+   this.isbn   +'</strong></span>'+
							'<div class="ticket_quoted_ammount"><span class="we_quote">We Quote</span><span class="quote">'+ quote +'</span></div>'+
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

	alpha.search_though_amazon_for_a_book.prototype.quote = function () { 
	};

	alpha.search_though_amazon_for_a_book.prototype.basket = function (element_to_be_basket) { 

		this.basket.prototype.element = $(element_to_be_basket);
		this.basket.prototype.store   = new Object;		
		this.basket.prototype.update  = function (value_to_insert) { 

			this.store[value_to_insert.isbn] = value_to_insert;
			this.manifest(value_to_insert);
			
		};
		this.basket.prototype.manifest = function (value_to_insert) { 

			this.element.append(
				'<div class="ticket_basket_book">'+
					'<span class="ticket_basket_book_name">Title: <strong>'+ value_to_insert.title +'</strong></span>'+
					'<span class="ticket_basket_book_name">ISBN: <strong>'+  value_to_insert.isbn  +'</strong></span>'+
					'<span class="ticket_basket_book_name">£: <strong>'+     value_to_insert.price +'</strong></span>'+
				'</div>'
			);
		};

	};

	return alpha;

})(alpha || {}, jQuery );	