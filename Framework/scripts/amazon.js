var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (current_click) { 
		
		var typed_value = $('#'+ current_click.instructions.input_id).val().trim(),
			search_by   = (alpha._is_number(typed_value)? current_click.instructions.numerical_search : 'keywords' ),
			klass       = this.prototype;

		current_click.element.val('Searching...');
		$('.book_display_hold').fadeOut(400, function () {$(this).empty().remove()});

		$.post(
			ajaxurl,
			{ action : 'amazon', paramaters : { typed : typed_value, search_by : search_by, search_for : current_click.instructions.search_for, filter_name : current_click.instructions.filter_by }},
			function (response) { 
				klass.display_books(response, current_click.element, current_click.instructions.id);
				current_click.element.val('Search');
			},
			'json');
	};	

	alpha.amazon.prototype.display_books = function (items_to_display, element, post_id) { 

		var books_to_display = this.return_books(items_to_display),
			prototype = this;

			$('<div class="book_display_hold"></div>').css({ opacity : 0 }).insertAfter(element);
			$.each(books_to_display, 
			function (book_key, book) { 
				prototype.display_book(book, post_id); 
			});

			$('.book_display_hold').animate({ opacity : 1 }, 400);
	};

	alpha.amazon.prototype.display_book = function (book, post_id) { 

		var button, book_string = new String, prototype = this;

			book_string += '<div class="book_display_cover">';
			book_string += (book.image !== undefined? '<div class="book_display_image"><img src="'+ book.image +'"></div>' : '');
			book_string += '<div class="book_display_details_cover">';
			book_string += '<div class="book_display_title">'+   book.title +'</div>';
			book_string += '<div class="book_display_author">'+  book.author +'</div>';
			book_string += '<div class="book_display_binding">'+ book.binding +'</div>';
			book_string += '<div class="book_display_lowest"> Lowest Price : £'+ (book.lowest/100) +'</div>';
			book_string += '<div class="book_display_rrp"> Retail Price : £'+ (book.price/100) +'</div>';
			book_string += '<div class="book_display_isbn"> ISBN : '+ book.isbn +'</div>';
			book_string += '<div class="book_display_weight"> Weight : '+ book.weight +'g</div>';
			book_string += ( book.length !== undefined? '<div class="book_display_dimensions"> Dimensions : '+ book.length  +'x'+ book.width +'x'+ book.height +'</div>' : '');
			book_string += '</div></div>';

			button = 
			$('<div class="book_display_add_button button">Model On This Book</div>')
			.bind('click', 
			function () { 
				console.log(book);
				book.id = post_id;
				prototype.add_book(book);
			});
			
			$(book_string)
			.children('.book_display_details_cover')
			.append(button)
			.parent()
			.appendTo('.book_display_hold');
	};

	alpha.amazon.prototype.add_book = function (book) { 

		$.post(
			ajaxurl,
			{ action : 'add_book', book: book },
			function (response) { 
				$('.book_display_hold').fadeOut(400, function () {$(this).empty().remove()});
				location.reload(true);
			},
			'json'
		);
	};

	alpha.amazon.prototype.get_books_from_amazon = function (paramaters, callback) { 

		paramaters.search_by   = paramaters.search_by   || 'keywords';
		paramaters.search_for  = paramaters.search_for  || 'books';
		paramaters.filter_name = paramaters.filter_name || 'tiny';

		$.post( ajaxurl, { action : 'amazon', paramaters : paramaters }, callback, 'json');
	};

	alpha.amazon.prototype.clean_array = function (books) { 

		books = $.map(books, 
		function (book, key) {

			var filter_book = {};
			$.each(book, function (key, property) {

				if (property)
					if ( property[0] !== undefined && property[1] === undefined ) {
						filter_book[key] = property[0];
					}
					else if ( !$.isEmptyObject(property) ) {
						filter_book[key] = property;
					}
			});

			return filter_book;
		});

		return books;
	};

	alpha.amazon.prototype.pick_which_details_to_get_out_of_the_book_properties = function (books, details_to_get) { 

		books = $.map(books, 
		function (book, key) { 

			var filter_book = {};
			$.each(book, function (key, property) {
				
				filter_book[key] = (details_to_get[key]? property[details_to_get[key]] : property );
			});

			return filter_book;
		});

		return books;
	};

	alpha.amazon.prototype.remove_books_that_dont_have_given_properties = function (books, details_to_have) { 

		books = $.map(books,
		function (book, index) { 

			var cross_out_details = new Array;
				cross_out_details.push.apply(cross_out_details, details_to_have);
				
			$.each(book, function (key, property) {

				var does_it_contain_the_detail = $.inArray(key, cross_out_details);
					if ( does_it_contain_the_detail !== -1 )
						cross_out_details.splice(does_it_contain_the_detail, 1);
			});

			if ( cross_out_details.length === 0 )
				return book;
		});

		return books;
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