define({

	weight : {
		bus : [
			{
				range_one : 0,
				range_two : 100,
				price     : 0
			},
			{
				range_one : 99,
				range_two : 250,
				price     : 0
			},
			{
				range_one : 249,
				range_two : 500,
				price     : 0
			},
			{
				range_one : 499,
				range_two : 750,
				price     : -0.80
			},
			{
				range_one : 749,
				range_two : 1000,
				price     : -1.5
			},
			{
				range_one : 999,
				range_two : 2000,
				price     : -3.5
			},
			{
				range_one : 1999,
				range_two : 100000,
				price     : -8
			}
		],
		post: [
			{
				range_one : 0,
				range_two : 100,
				price     : -5
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
		]
	},

	run : function (on) {

		var final_books, processed, filtered

		final_books = []

		for (var index = 0; index < on.books.length; index++) {
			processed  = this[on.algorithm](on.books[index])
			
			if ( on.filter ) {
				if ( this.filter[on.filter](processed))
					final_books.push(processed)
			} else {
				final_books.push(processed)
			}
		}

		return final_books
	},

	filter : {
		bellow_one : function (book) {
			return ( parseFloat( book.standard_price ) < 1 ? false : true )
		}
	},
	
	recalculate : function (book) {

		var weight, price;

		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = ( book.condition_type === "11" && book.prices.newest ? parseFloat(book.prices.newest) : parseFloat( book.standard_price) );
		price                    -= 0.01;
		price                     = ( price > 0 ? price : 1 );
		book.standard_price       = price.toFixed(2);
		if ( price < 1 && weight > 75 ) book.refused = true;
		return book;
	},

	bus : function (book) {

		var starting_price, price, weight;
		
		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = parseFloat( book.standard_price);
		price                    *= 0.7;
		price                    += this.get_price_for_weight("bus", weight);
		starting_price            = price;
		price                    *= 0.75;
		if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
		if ( price < 0.20 ) price = 0;
		price                    *= 1.2;
		price                     = price.toFixed(2);
		book.standard_price       = price;
		
		return book;
	},

	post : function (book) {

		var starting_price, price, weight;

		weight                    = parseInt( book.package_weight );
		weight                    = (weight/100) * 453;
		price                     = parseFloat( book.standard_price);
		price                    *= 0.7;
		price                    += this.get_price_for_weight("post", weight);
		starting_price            = price;
		price                    *= 0.75;
		if ( price > 0 )    price = ( price - ( 5/starting_price ) ) + 0.25;
		if ( price < 0.20 ) price = 0;
		price                     = price.toFixed(2);
		book.standard_price       = price;
		
		return book;
	},

	get_price_for_weight : function (type, weight) {

		var weights, price, index;

		index   = 0;
		weights = this.weight[type];
		price   = 0;
		for (; index < weights.length; index++) {
			if ( weight > weights[index].range_one && weight < weights[index].range_two ) {
				price = weights[index].price;
			}
		};
		return price;
	}

});