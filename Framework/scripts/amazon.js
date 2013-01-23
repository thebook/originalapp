var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (current_click) { 
		
		var typed_value = $('#'+ current_click.instructions.input_id).val().trim(),
			search_by   = (alpha._is_number(typed_value)? current_click.instructions.numerical_search : 'keywords' ),
			klass       = this.prototype;

		$('.book_display_hold').fadeOut(400, function () {$(this).empty().remove()});

		$.post(
			ajaxurl,
			{ 
				action     : 'amazon', 
				paramaters : { 
					typed       : typed_value, 
					search_by   : search_by, 
					search_for  : current_click.instructions.search_for, 
					filter_name : current_click.instructions.filter_by  
			}},
			function (response) { 
				klass.display_books(response, current_click.element, current_click.instructions.id);
			},
			'json'
		);
	};

	alpha.amazon.prototype.display_books = function (items_to_display, element, post_id) { 

		var books_to_display = this.return_books(items_to_display),
			klass = this;

			$('<div class="book_display_hold"></div>').css({ opacity : 0 }).insertAfter(element);

			$.each(books_to_display, 
			function (book_key, book) { 

				klass.display_book(book, post_id); 
			});

			$('.book_display_hold').animate({ opacity : 1 }, 400);
	};

	alpha.amazon.prototype.display_book = function (book, post_id) { 

		var book_json_data, displayed_book;

		book_json_data  = '{\'id\' : \''+ post_id +'\', \'title\' : \''+ book.title +'\', \'author\' : \''+ book.author +'\', \'binding\' : \''+ book.binding +'\', \'lowest\' : \''+ book.lowest +'\', \'price\' : \''+ book.price +'\', \'isbn\' : \''+ book.isbn +'\', \'weight\' : \''+ book.weight +'\', \'dimensions\' : \''+ book.dimensions +'\', \'image\' : \''+ book.image +'\'}';
		book.image      = (book.image !== undefined? '<div class="book_display_image"><img src="'+ book.image +'"></div>' : '');
		book.lowest     = book.lowest/100;
		book.price      = book.price/100;
		book.dimensions = ( book.length !== undefined? '<div class="book_display_dimensions"> Dimensions : '+ book.length  +'x'+ book.width +'x'+ book.height +'</div>' : '');
		
		displayed_book =
			'<div class="book_display_cover">'+                    book.image +
			'<div class="book_display_details_cover">'+
			'<div class="book_display_title">'+                    book.title   +'</div>'+
			'<div class="book_display_author">'+                   book.author  +'</div>'+
			'<div class="book_display_binding">'+                  book.binding +'</div>'+
			'<div class="book_display_lowest"> Lowest Price : £'+  book.lowest  +'</div>'+
			'<div class="book_display_rrp"> Retail Price : £'   +  book.price   +'</div>'+
			'<div class="book_display_isbn"> ISBN : '+             book.isbn    +'</div>'+
			'<div class="book_display_weight"> Weight : '+         book.weight  +'g</div>'+
																   book.dimensions +
			'<div data-function-to-call="add_book_to_database" data-function-instructions="'+ book_json_data +'" class="book_display_add_button button">Model After This Book</div>'+
			'</div></div>';
					
		$('.book_display_hold').prepend(displayed_book);
	};

	alpha.add_book_to_database = function (current_click) { 

		$.post(
			ajaxurl,
			{ action : 'add_book', book: current_click.instructions },
			function (response) { 
				$('.book_display_hold').fadeOut(400, function () {$(this).empty().remove()});
				location.reload(true);
			},
			'json'
		);
	};

	alpha.amazon.prototype.return_books = function (books) { 

		var return_object = new Object;

		$.each(books, 
		function (book_key, item ) { 

			var book = new Object;
				book.title   = item.title[0]    || undefined;
				book.author  = item.author[0]   || undefined;
				book.isbn    = item.ISBN[0]     || undefined;
				book.image   = item.image.URL   || undefined;
				book.binding = item.binding[0]  || undefined;
				book.pages   = item.pages[0]    || undefined;
				book.weight  = (item.dimensions? item.dimensions.Weight : undefined );
				book.height  = (item.dimensions? item.dimensions.Height : undefined );
				book.width   = (item.dimensions? item.dimensions.Width  : undefined );
				book.length  = (item.dimensions? item.dimensions.Length : undefined );				
				book.price   = (item.price? item.price.Amount : undefined );
				book.lowest  = (item.lowest_used_price? item.lowest_used_price.Amount : undefined );
				
				if ( book.lowest !== undefined && book.price !== undefined && book.title !== undefined ) { 

					return_object[book_key] = book;
				}
			});
		return return_object
	};

	return alpha;

})(alpha || {}, jQuery );	