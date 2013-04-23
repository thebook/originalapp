var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (wake) {

		wake.search_by   = wake.search_by   || 'keywords';
		wake.search_for  = wake.search_for  || 'books';
		wake.filter_name = wake.filter_name || 'tiny';
		wake.callback    = wake.callback    || false;

		$.post( 
			ajaxurl, 
			{ 
				action     : 'amazon', 
				paramaters : wake
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
				wake.callback(books);
			},
			'json'
		);
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

	return alpha;

})( alpha || {}, jQuery );