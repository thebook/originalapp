var alpha = (function ( alpha, $ ) {

	alpha.check_books = function (current_click) { 

		var books = current_click.instructions;
			this.prototype.memory = this.prototype.sort_books_by_isbn(books);
			this.prototype.new_memory = {};
			this.prototype.parts = {};
			this.prototype.parts.current_ticket_box = current_click.element.closest('.ticket_box');
			this.prototype.parts.books		        = $('<div class="ticket_information_row"><div class="ticket_information_type">Unexpected Books</div><div class="ticket_information"></div></div>');
			this.prototype.parts.display_books      = $(this.prototype.get_books(books));
			this.prototype.parts.input              = 
				$('<div class="ticket_information_row">'+ 
					'<div class="ticket_information_type">Verify Books</div>'+
					'<div class="ticket_information">'+
						'<input class="ticket_input" id="verify_books_search" type="text" value="">'+
						'<div data-function-to-call="check_books.prototype.cross_out_book" class="ticket_button">'+
							'Submit'+
						'</div>'+
					'</div>'+
				'</div>');

			this.prototype.parts.current_ticket_box.css({ 'z-index' : '2', 'position' : 'relative' });

			$('<div class="ticket_box_add_on"></div>').css({
				'z-index'  : '0',
				'position' : 'relative'
			})
			.append(this.prototype.parts.display_books)
			.append(this.prototype.parts.input)
			.append(this.prototype.parts.books)
			.insertAfter(this.prototype.parts.current_ticket_box);
	};

	alpha.check_books.prototype.get_books = function (books) { 

		var books_element = 
			'<div class="ticket_information_row">'+
				'<div class="ticket_information_type">Books Expected</div>'+
				'<div class="ticket_information">';

			$.each(books,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label '+ book.isbn +'">'+
							book.isbn +
						'</div>'+
					'</div>';
			});
					
			return books_element += '</div></div>';
	};

	alpha.check_books.prototype.sort_books_by_isbn = function (books) { 

		var sorted_books = {};

			$.each(books,
			function (key, book) { 

				( sorted_books[book.isbn]? sorted_books[book.isbn].push(book) : sorted_books[book.isbn] = [book] );
			});

		return sorted_books
	};

	alpha.check_books.prototype.cross_out_book = function () {

		var klass = alpha.check_books.prototype,
			isbn  = klass.parts.input.find('input').val(),
			ticked_book = klass.parts.display_books.find('.'+ isbn );
			
			if ( alpha._is_number(isbn) && isbn.length === 10 ) {
				
				if ( ticked_book.length > 0 ) {

					( klass.memory[isbn].length > 1? klass.memory[isbn].pop() : delete klass.memory[isbn] );

					$(ticked_book[0]).css({ 'text-decoration' : 'line-through' }).removeClass(isbn);
				}
				else { 

					klass.parts.books.find('.ticket_information').append(
						'<div class="books_for_ticket_verifying books_for_ticket">'+
							'<div class="ticket_book_start_label">'+
								isbn+
							'</div>'+
						'</div>');

					( klass.new_memory[isbn]? klass.new_memory[isbn].push(isbn) : klass.new_memory[isbn] = [isbn] );

					console.log(klass.new_memory);
				}
			}
	};

	return alpha;

})(alpha || {}, jQuery );			