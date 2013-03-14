var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.search_bar = function () { 

		$('.block_for_search').on('keypress', function (event) { 

			if ( event.keyCode === 13 ) {
				var wake = {
					instructions : {
						type : ($(this).hasClass('header_input_block_for_search')? 'header' : 'bar' )
					}
				};
				alpha.front.prototype.search_though_amazon(wake);
			}
		});
	};

	alpha.front.prototype.search_though_amazon = function (wake) { 

		var search, search_by, input;

			input = ( wake.instructions.type == 'bar'? alpha.front.prototype.parts.search.wrap.branch.branch.input.self : $('.header_field_for_input') );
			
			search = alpha.front.prototype.get_the_search_value_from_blocks({ 
				input : input, 
				block_class_name : '.block_for_search'
			});
			search_by = (search.is_number()? 'isbn' : 'keywords' );
			
			alpha.amazon.prototype.get_books_from_amazon({
				typed     : search,
				search_by : search_by
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

				alpha.front.prototype.being.basket.items = books;	
				alpha.front.prototype.being.on_page = 'body';			
			});
	};

	return alpha;

})(alpha || {}, jQuery );