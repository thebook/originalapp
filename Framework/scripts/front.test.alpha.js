var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.test = function () { 

		alpha.front.prototype.being.user_info.fields  = {
			e_mail      : "aleksandar.andjelkovich@gmail.com",
			first_name  : "Aleksandar",
			second_name : "Andjelkovich"
		};

		alpha.front.prototype.being.basket.total = 5000;

		alpha.front.prototype.being.basket.inside = {
				"1" : {
					ASIN       : "1780873697",
					ISBN       : "1780873697",
					author     : "Paul Glendinning",
					binding    : "Paperback",
					dimensions : {
						Height : "496",
						Length : "0",
						Weight : "0",
						Width  : "520"
					},
					image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
					item_links : {},
					lowest_new_price   : "208",
					lowest_used_price  : "385",
					number_in_stock    : "1",
					package_dimensions : {
						Height: "126",
						Length: "504",	
						Weight: "66",	
						Width : "496"
					},
					pages: "416",
					price: "699",	
					title: "Maths in Minutes: 200 K...Explained in an Instant"
				},
				"2" : {
					ASIN       : "1780873697",
					ISBN       : "1780873697",
					author     : "Paul Glendinning",
					binding    : "Paperback",
					dimensions : {
						Height : "496",
						Length : "0",
						Weight : "0",
						Width  : "520"
					},
					image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
					item_links : {},
					lowest_new_price   : "208",
					lowest_used_price  : "385",
					number_in_stock    : "1",
					package_dimensions : {
						Height: "126",
						Length: "504",	
						Weight: "66",	
						Width : "496"
					},
					pages: "416",
					price: "699",	
					title: "Maths in Minutes: 200 K...Explained in an Instant"
				},
				"3" : {
					ASIN       : "1780873697",
					ISBN       : "1780873697",
					author     : "Paul Glendinning",
					binding    : "Paperback",
					dimensions : {
						Height : "496",
						Length : "0",
						Weight : "0",
						Width  : "520"
					},
					image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
					item_links : {},
					lowest_new_price   : "208",
					lowest_used_price  : "385",
					number_in_stock    : "1",
					package_dimensions : {
						Height: "126",
						Length: "504",	
						Weight: "66",	
						Width : "496"
					},
					pages: "416",
					price: "699",	
					title: "Maths in Minutes: 200 K...Explained in an Instant"
				}
			};

		alpha.front.prototype.send_email("ticket",
			function (message) { 
				
				var new_message = "<p>Expected Books:</p><ul>";

					$.each(alpha.front.prototype.being.basket.inside, function (index, book ) {
						new_message += 
							"<li>"+
								"<p>"+ book.title  +"</p>"+
								"<p>"+ book.author +"</p>"+
								"<p>"+ book.isbn   +"</p>"+
							"</li>";
					});

					new_message += "</ul>";
					new_message += "<p>Your Quote : £"+ alpha.front.prototype.being.basket.total/100 +"</p>";
					new_message += message;
										
					return new_message;
			});

		// alpha.amazon.prototype.get_books_from_amazon({
		// 	typed     : "math",
		// 	search_by : "keywords"
		// },
		// function (books) { 

		// 	books = alpha.amazon.prototype.clean_array(books);
		// 	books = alpha.amazon.prototype.pick_which_details_to_get_out_of_the_book_properties(books, 
		// 	{
		// 		lowest_used_price : 'Amount',
		// 		image             : 'URL',
		// 		lowest_new_price  : 'Amount',
		// 		price  			  : 'Amount',
		// 		editorial_review  : 'EditorialReview'
		// 	});
		// 	books = alpha.amazon.prototype.remove_books_that_dont_have_given_properties(books, ['image', 'author', 'price']);

		// 	alpha.front.prototype.being.basket.items = books;
		// 	alpha.front.prototype.being.on_page = 'body';	

		// 	alpha.front.prototype.being.basket.inside = {
		// 		"1" : {
		// 			ASIN       : "1780873697",
		// 			ISBN       : "1780873697",
		// 			author     : "Paul Glendinning",
		// 			binding    : "Paperback",
		// 			dimensions : {
		// 				Height : "496",
		// 				Length : "0",
		// 				Weight : "0",
		// 				Width  : "520"
		// 			},
		// 			image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
		// 			item_links : {},
		// 			lowest_new_price   : "208",
		// 			lowest_used_price  : "385",
		// 			number_in_stock    : "1",
		// 			package_dimensions : {
		// 				Height: "126",
		// 				Length: "504",	
		// 				Weight: "66",	
		// 				Width : "496"
		// 			},
		// 			pages: "416",
		// 			price: "699",	
		// 			title: "Maths in Minutes: 200 K...Explained in an Instant"
		// 		},
		// 		"2" : {
		// 			ASIN       : "1780873697",
		// 			ISBN       : "1780873697",
		// 			author     : "Paul Glendinning",
		// 			binding    : "Paperback",
		// 			dimensions : {
		// 				Height : "496",
		// 				Length : "0",
		// 				Weight : "0",
		// 				Width  : "520"
		// 			},
		// 			image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
		// 			item_links : {},
		// 			lowest_new_price   : "208",
		// 			lowest_used_price  : "385",
		// 			number_in_stock    : "1",
		// 			package_dimensions : {
		// 				Height: "126",
		// 				Length: "504",	
		// 				Weight: "66",	
		// 				Width : "496"
		// 			},
		// 			pages: "416",
		// 			price: "699",	
		// 			title: "Maths in Minutes: 200 K...Explained in an Instant"
		// 		},
		// 		"3" : {
		// 			ASIN       : "1780873697",
		// 			ISBN       : "1780873697",
		// 			author     : "Paul Glendinning",
		// 			binding    : "Paperback",
		// 			dimensions : {
		// 				Height : "496",
		// 				Length : "0",
		// 				Weight : "0",
		// 				Width  : "520"
		// 			},
		// 			image      : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
		// 			item_links : {},
		// 			lowest_new_price   : "208",
		// 			lowest_used_price  : "385",
		// 			number_in_stock    : "1",
		// 			package_dimensions : {
		// 				Height: "126",
		// 				Length: "504",	
		// 				Weight: "66",	
		// 				Width : "496"
		// 			},
		// 			pages: "416",
		// 			price: "699",	
		// 			title: "Maths in Minutes: 200 K...Explained in an Instant"
		// 		}
		// 	};
		// 	alpha.front.prototype.calculate_total_quote_for_sold_books();

		// 	setTimeout( alpha.front.prototype.registration, 1500 );
		// 	setTimeout( alpha.front.prototype.account, 2000 );
		// 	setTimeout( function () {
		// 		alpha.front.prototype.being.user_info.fields = {
		// 			address 	 : "Some Street",
		// 			address_area : "Some Place",
		// 			address_town : "Cardiff",
		// 			e_mail 		 : "email@second_email",
		// 			first_name   : "Gee ",
		// 			password     : "password",
		// 			post_code    : "CF52LK",
		// 			recieve_newsletters : true,
		// 			second_name  : "Mgee"
		// 		};
		// 	}, 2500 );
		// 	setTimeout( alpha.front.prototype.confirm, 3000);
		// 	// setTimeout( alpha.front.prototype.thank_you, 3500 );

		// });

		

	};

	return alpha;

})(alpha || {}, jQuery );