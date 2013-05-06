var alpha = (function ( alpha, $ ) {

	alpha.amazon = function (wake) {

		var self = this;
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
				books = self.clean_array(books);
				books = self.pick_which_details_to_get_out_of_the_book_properties(books, 
				{
					lowest_used_price : 'Amount',
					image             : 'URL',
					lowest_new_price  : 'Amount',
					price  			  : 'Amount',
					editorial_review  : 'EditorialReview'
				});
				books = self.remove_books_that_dont_have_given_properties(books, ['image', 'author', 'lowest_used_price']);
				books = self.algorithm(books);
				wake.callback(books);
			},
			'json'
		);
	};

	// alpha.amazon.prototype.algorithm = function (books) { 
	// 	console.log(books);
	// 	var sorted = [];
	// 	for (var index = 0; index < books.length; index++) {

	// 		var price = parseInt( books[index]["lowest_used_price"] ),
	// 			// weight_prices = {
	// 			// 	"0"   : 0.9,
	// 			// 	"100" : 0.43,
	// 			// 	"250" : -0.12,
	// 			// 	"500" : -1,
	// 			// 	"750" : -3.5,
	// 			// 	"1000": -6,
	// 			// 	"1250": -7.64,
	// 			// 	"1500": -8.38,
	// 			// 	"1750": -9.01
	// 			// };
	// 			weight= 1250;

	// 		if ( books[index].dimensions && books[index].dimensions.Weight && books[index].dimensions.Weight !== 0 ) weight = books[index].dimensions.Weight;
	// 		if ( price > books[index]["lowest_new_price"] ) price = parseInt( books[index]["lowest_new_price"] ) - 200;
	// 		price /= 100;
	// 		price *= 0.85;
	// 		// for ( var price_weight in weight_prices ) {
	// 		// 	if ( weight > price_weight ) price += price_weight;
	// 		// }
	// 		price *= 0.75;
	// 		price -= 5/price;
	// 		price += 0.25;

	// 		if ( price < 0.20 ) price = 0;
	// 		price  = price.toFixed(2);
	// 		books[index].price = price;

	// 		if ( weight > 1999 ) console.log("weight is past capacity");
	// 		if ( price !== "0.00") sorted.push(books[index]);
	// 	};
	// 	return sorted;
	// };

	alpha.amazon.prototype.algorithm = function (books) { 
		var sorted = [];
		for (var index = 0; index < books.length; index++) {

			var price          = parseInt( books[index]["lowest_used_price"] ),
				starting_price = 0,
				weights        = [
					{
						range_one : 0,
						range_two : 100,
						price     : 0.9
					},
					{
						range_one : 99,
						range_two : 250,
						price     : 0.43
					},
					{
						range_one : 249,
						range_two : 500,
						price     : -0.12
					},
					{
						range_one : 499,
						range_two : 750,
						price     : -1
					},
					{
						range_one : 749,
						range_two : 1000,
						price     : -3.5
					},
					{
						range_one : 999,
						range_two : 1250,
						price     : -6
					},
					{
						range_one : 1249,
						range_two : 1500,
						price     : -7.64
					},
					{
						range_one : 1499,
						range_two : 1750,
						price     : -0.38
					},
					{
						range_one : 1749,
						range_two : 2000,
						price     : -9.01
					}
				],
				weight         = 1250;

			if ( price > books[index]["lowest_new_price"] ) price = parseInt( books[index]["lowest_new_price"] ) - 200;
			if ( books[index].dimensions && books[index].dimensions.Weight && books[index].dimensions.Weight !== 0 ) weight = books[index].dimensions.Weight;
			price /= 100;
			price *= 0.85;
			for (var i = 0; i < weights.length; i++) {
				if ( weight > weights[i].range_one && weight < weights[i].range_two ) {
					price += weights[i].price;
				}
			};
			starting_price = price;
			price *= 0.75;
			price -= 5/starting_price;
			price += 0.25;

			if ( price < 0.20 ) price = 0;
			price              = price.toFixed(2);
			books[index].price = price;
			
			if ( weight > 1999 ) console.log("weight is past capacity");
			if ( price !== "0.00") sorted.push(books[index]);			
		};
		return sorted;
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