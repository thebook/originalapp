var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.display_books = function (poperty, old_books, books) { 

		var string_of_books = '', 
			keeping_count   = 0, 
			wrap_names      = ['result_book_search_wrapper_left', 'result_book_search_wrapper', 'result_book_search_wrapper_right'];

			$.each(books,
			function (index, book) { 
				
				string_of_books += 
					alpha.replace_placeholders_with_values_in_text(
					{ 	
						wrapper : wrap_names[keeping_count],
						image   : book.image,
						title   : book.title.slice(0, 10) +'...',
						author  : book.author.slice(0, 18) +'...',
						price   : book.price / 100,
						id 	    : index
					},
						alpha.front.prototype.being.first_book_format
					);

				( keeping_count === 2? keeping_count = 0 : keeping_count++ );
				
			});

			$('.result_books').animate({ top : "800px" }, 1000, function () {
				$(this).empty().remove();
			});

			string_of_books = $('<div class="result_books"></div>').append(string_of_books);			
			string_of_books.css({ position : "relative", top : "1000px"}).appendTo('.body');
			$('.result_books').animate({ top : "0px" }, 1500);

			if (!alpha.front.prototype.being.first_search) {

			 	alpha.front.prototype.display_search_navigation();
			 	alpha.front.prototype.being.first_search = true;
			 }
			
			return books;
	};	

	alpha.front.prototype.display_search_navigation = function () { 

		$('<div id="navigation_for_body" class="with-icon-for-navigation-text-for-bar-active" data-function-to-call="front.prototype.change_page" data-function-instructions="{\'page\' : \'body\'}">Search Books</div>').css({opacity : 0 }).insertAfter('#navigation_for_recyclabus');
		$('#navigation_for_body').animate({ opacity : 1 }, 500);
	};

	return alpha;

})(alpha || {}, jQuery );