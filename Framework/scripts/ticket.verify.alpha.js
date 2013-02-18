var alpha = (function ( alpha, $ ) {

	alpha.check_books = function (current_click) { 

		var books, verify_ticket_thought;

			books = current_click.instructions.books;
			this.prototype.new_memory = {};
			this.prototype.parts = {};
			this.prototype.unexpected = {};
			this.prototype.original_quote = current_click.instructions.quote;
			this.prototype.ticket = current_click.instructions.ticket;
			this.prototype.memory = this.prototype.sort_books_by_isbn(books);
			this.prototype.parts.current_ticket_box = current_click.element.closest('.ticket_box_wrap');
			verify_ticket_thought = {
				wrap : {
					self   : '<div class="ticket_box"></div>',
					branch : {
						branch : {
							expected_row : {
								self   : '<div class="ticket_information_row"></div>',
								branch : {
									label    : '<div class="ticket_information_type">Books Expected</div>',
									contents : this.prototype.get_books(books)
								},
							},
							unexpected_books : { 
									self   : '<div class="ticket_information_row"></div>',
									branch : { 
										label    : '<div class="ticket_information_type">Unexpected Books</div>',
										contents : '<div class="ticket_information"></div>'
									}
							},
							verify_row : { 
									self   : '<div class="ticket_information_row"></div>',
									branch : {
										label  : '<div class="ticket_information_type">Verify Books</div>',						
										branch : { 
											search : {
												self   : '<div class="ticket_information"></div>', 
												branch : {
													input		  : '<input class="ticket_input" id="verify_books_search" type="text" value="">',
													search_button : '<div data-function-to-call="check_books.prototype.cross_out_book" class="ticket_button">Submit</div>'
												}
											}
										}
									}
							},
							buttons : {
									self   : '<div class="ticket_information_row"></div>',
									branch : {
										button_next_step     :'<div data-function-to-call="check_books.prototype.transitioning_to_check_condition" class="check_state button">Next</div>',
										button_cancel_ticket :'<div data-function-to-call="check_books.prototype.remove_ticket_verifyer" class="cancel_verify button">Cancel</div>'
									}
							}
						}						
					}
				}
			};
			
			this.prototype.parts.verify = this.prototype.manifest({
				what_to_manifest : verify_ticket_thought,
				append_to_who    : this.prototype.parts.current_ticket_box
			});

			this.prototype.parts.verify.wrap.self.prev().css({ 'z-index' : '2', 'position' : 'relative' });
			this.prototype.parts.verify.wrap.self.css({ 'z-index' : 0, 'position' : 'relative' });
	};

	alpha.check_books.prototype.get_books = function (books) { 

		var books_element = '<div class="ticket_information">';

			$.each(books,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label '+ book.isbn +'">'+
							book.isbn +
						'</div>'+
					'</div>';
			});
					
			return books_element += '</div>';
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
			isbn  = klass.parts.verify.wrap.branch.branch.verify_row.branch.branch.search.branch.input.attr('value'),
			ticked_book = klass.parts.verify.wrap.branch.branch.expected_row.branch.contents.find('.'+ isbn );

			if ( isbn.length === 10 ) {
				
				if ( ticked_book.length > 0 ) {

					var insert;

					if ( klass.memory[isbn].length > 1 ) {
					 	insert = klass.memory[isbn].pop(); 
					} 
					else {
						insert = klass.memory[isbn][0]; 
						delete klass.memory[isbn];
					}

					( klass.new_memory[isbn]? klass.new_memory[isbn].push(insert) : klass.new_memory[isbn] = [insert] );

					$(ticked_book[0]).css({ 'text-decoration' : 'line-through' }).removeClass(isbn);
				}
				else { 

					klass.parts.verify.wrap.branch.branch.unexpected_books.branch.contents.append(
						'<div class="books_for_ticket_verifying books_for_ticket">'+
							'<div class="ticket_book_start_label">'+
								isbn +
							'</div>'+
						'</div>');
					
					( klass.unexpected[isbn]? klass.unexpected[isbn].push(isbn) : klass.unexpected[isbn] = [isbn] );
				}
			}
	};	

	alpha.check_books.prototype.prepare_books_to_be_queried_in_amazon = function (books) { 

		var amazon = {}, 
		    book_details = {};
		   	amazon.search_text   = '';
		   	amazon.list_of_books = [];

		$.each( books,
		function (isbn, book) { 

			book_details = {};

			if ( book.constructor === Array && book[0].constructor === Object ) { 

				book_details.quote = book[0].quote;
				book_details.number_of_the_same_book = book.length;
				amazon.search_text += book[0].isbn +', ';

				amazon.list_of_books.push(book_details);
			}

			if ( book.constructor === Array && book[0].constructor === String ) {

				book_details.number_of_the_same_book = book.length;
				amazon.search_text += book[0] +', ';

				amazon.list_of_books.push(book_details);
			}
		});

		return amazon;
	};

	alpha.check_books.prototype.get_books_info_from_amazon = function (instructions) {

	 	var array_to_append = [],
	 		klass			= this,
	 		information     = this.prepare_books_to_be_queried_in_amazon(instructions.books);
	 		console.log(information);
		$.post(
			ajaxurl, 
			{ 
				action     : 'amazon', 
				paramaters : { 
					typed       : information.search_text, 
					search_by   : 'isbn', 
					search_for  : 'books',
					filter_name : 'tiny' 
				} 
			},
			function (amazon_books) { 

				$.each(amazon_books,
				function (index, book) { 
						
					var information_on_book           = information.list_of_books[index];
						book.lowest_used_price.Amount = (information_on_book.quote? information_on_book.quote : alpha.search_though_amazon_for_a_book.prototype.quote(book.lowest_used_price.Amount) );

						for (var i = 0; i < information_on_book.number_of_the_same_book; i++) {
							array_to_append.push(book);
						};
				});

				instructions.invoke.call(klass, alpha.amazon.prototype.return_books(array_to_append));
			},
		'json');
	};

	alpha.check_books.prototype.transitioning_to_check_condition = function () { 

		var klass = alpha.check_books.prototype;

		klass.get_books_info_from_amazon({ 
			books  : klass.new_memory, 
			invoke : function (promised_and_arrived_books) { 

				this.get_books_info_from_amazon({
					books  : this.unexpected, 
					invoke : function (unexpected_and_arrived_books) {

						this.new_memory = promised_and_arrived_books;
						this.unexpected = unexpected_and_arrived_books;
						this.check_condition();
				}});
		}});
	};

	alpha.check_books.prototype.flaten_to_array = function (object_to_flaten) {

		var return_array = [];

		$.each(object_to_flaten,
		function (key, member) { 

			if ( member.construct === Array ) { 

				$.each( member, function (index, value) { return_array.push(value); });
			}
			else { 

				return_array.push(member);
			}
		});

		return return_array;
	};

	alpha.check_books.prototype.manifest = function (passed) { 

		var prototype = this.manifest.prototype;
			
			prototype.manifestor = function (thoughts_of_what_to_manifest, append_to) { 

				$.each( thoughts_of_what_to_manifest,
					function (name, body) { 

						body.self = $(body.self);

						append_to.append(body.self);

						if ( body.branch ) { 
													
							$.each( body.branch,
							function (branch_name, branch_body) { 

								if ( branch_body.constructor === String ) {

									branch_body 			 = $(branch_body);
									body.branch[branch_name] = $(branch_body);							
									body.self.append(branch_body);
								}
							});

							if ( body.branch.branch ) { 
								
								prototype.manifestor(body.branch.branch, body.self);
							}
						}
					});

				return thoughts_of_what_to_manifest;				
			};

			return prototype.manifestor(passed.what_to_manifest, passed.append_to_who);
	};

	alpha.check_books.prototype.check_condition = function () { 

		var check_ticket_condition_thought = {	
			condition_row : { 
				self   : '<div class="ticket_information_row"></div>',
				branch : {
					label    : '<div class="ticket_information_type">Verify Books</div>',
					contents : this.sort_books_for_ticking(this.new_memory, 'new_memory')
				}
			},
			unexpected_condition_row : { 
				self   : '<div class="ticket_information_row"></div>',
				branch : {
					label    : '<div class="ticket_information_type">Tick Bad Unexpected Books</div>',
					contents : this.sort_books_for_ticking(this.unexpected, 'unexpected')
				}
			},
			unusable_row : { 
				self   : '<div class="ticket_information_row"></div>',
				branch : { 
					label    		   : '<div class="ticket_information_type">Bad Condition</div>',
					ticket_information : '<div class="ticket_information"></div>'
				}
			},
			option_row : { 
				self   : '<div class="ticket_information_row"></div>',
				branch : { 
					label           : '<div class="ticket_information_type">Options</div>',						
					button_complete : '<div data-function-to-call="check_books.prototype.complete_ticket" class="check_state button">Pay The Man!</div>',					
					button_cancel   : '<div data-function-to-call="check_books.prototype.remove_ticket_verifyer" class="cancel_verify button">Cancel</div>'
				}
			}
		};

		// Perhaps improve this with manifest object options 
		this.parts.verify.wrap.self.children().fadeOut(400, function () { $(this).empty().remove(); });
		this.memory    = this.flaten_to_array(this.memory);
		this.bad_goods = [];

		this.parts.condition = this.manifest({
			what_to_manifest : check_ticket_condition_thought,
		 	append_to_who    : this.parts.verify.wrap.self 
		});
	};

	alpha.check_books.prototype.cross_out_goods = function (current_click) { 

		var klass = alpha.check_books.prototype,
			index = current_click.element.attr('id'),
			unexpected_or_expected = current_click.element.attr('class');

			klass.bad_goods.push(klass[unexpected_or_expected][index]);
			
			current_click.element.parent().fadeOut(400, function () { $(this).empty().remove() });
			klass.parts.condition.unusable_row.branch.ticket_information.append(
				'<div class="books_for_ticket_verifying books_for_ticket">'+
					'<div class="ticket_book_start_label">'+ 
						klass[unexpected_or_expected][index].isbn + 
					'</div>'+
				'</div>');

			delete klass[unexpected_or_expected][index];
	};

	alpha.check_books.prototype.complete_ticket = function (current_click) { 

		var prototype, ticket_action;

		  	prototype     		 = alpha.check_books.prototype,
			prototype.memory     = prototype.convert_object_to_array(prototype.memory);
			prototype.bad_goods  = prototype.convert_object_to_array(prototype.bad_goods);
			prototype.unexpected = prototype.convert_object_to_array(prototype.unexpected);
			prototype.new_memory = prototype.convert_object_to_array(prototype.new_memory);
			ticket_action        = prototype.prepare_ticket_action();
						
		$.post(
			ajaxurl, 
			{ action      : 'update_ticket', information : ticket_action
			},
			function (response) { 
				$.jGrowl(response.message, { header : response.header, sticky : true });
				current_click.element.closest('.ticket_window').children('.reload_ticket').trigger('click');
			},
			'json');
	};	

	alpha.check_books.prototype.remove_ticket_verifyer = function () { 

		alpha.check_books.prototype.parts.verify.wrap.self.fadeOut(400, function () { $(this).empty().remove(); });
	};

	alpha.check_books.prototype.sort_books_for_ticking = function (which_books, unexpected_or_expected) { 

		var books_element = '<div class="ticket_information">';

			$.each(which_books,
			function (index, book) { 

				books_element += 
					'<div class="books_for_ticket_verifying books_for_ticket">'+
						'<div class="ticket_book_start_label">'+
							book.isbn +
						'</div>'+
						'<input data-function-to-call="check_books.prototype.cross_out_goods" id="'+ index +'" class="'+ unexpected_or_expected +'" type="checkbox" value="bad_condition">'+
					'</div>';
			});
					
		return books_element += '</div>';
	};

	alpha.check_books.prototype.convert_object_to_array = function (object) { 

		var array = [];			
			for ( var member in object ) { 
				array.push(object[member]);
			}
		return array;
	};

	alpha.check_books.prototype.prepare_ticket_action = function () { 
		
		var action = {};
			action.message = {}

			action.action = this.what_to_do_with_ticket();

											  action.message.ticket_id = this.ticket;
			if ( this.memory.length     > 0 ) action.message.promised_books = this.memory[0];
			if ( this.new_memory.length > 0 ) action.message.arrived_promised_books = this.new_memory;
			if ( this.bad_goods.length  > 0 ) action.message.bad_books = this.bad_goods;
			if ( this.unexpected.length > 0 ) action.message.unexpected_books = this.unexpected;

		return action;
	};

	alpha.check_books.prototype.what_to_do_with_ticket = function () { 

		// all books didint arrive 
		if ( this.memory.length > 0 && this.bad_goods.length === 0 && this.unexpected.length === 0 && this.new_memory.length === 0 ) {
			return "all_books_didint_arrive";
		}
		// some of the books did not arrive and the ones that did are all bad condition
		if ( this.memory.length > 0 && this.bad_goods.length > 0 && this.unexpected.length === 0 && this.new_memory.length === 0 ) {

			return "some_of_the_books_did_not_arrive_and_the_ones_that_did_are_all_bad_condition";
		}
		// some unexpected books arrived out of the batch that are ussable along with some that are in bad shape
		if ( this.memory.length > 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 && this.new_memory.length === 0 ) {
			return "some_unexpected_books_arrived_out_of_the_batch_that_are_useable_along_with_some_that_are_in_bad_shape";
		}
		// some books didint arrive but unexpected books arrived along with normal ones with some that are unisable
		if ( this.memory.length > 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 && this.new_memory.length > 0 ) {
			return "some_books_didint_arrive_but_unexpected_books_arrived_along_with_normal_ones_and_some_that_are_unusable";
		}
		// all books arrived along with some new books and some books are in bad shape
		if ( this.memory.length === 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 && this.new_memory.length > 0 ) {
			return "all_books_arrived_along_with_some_new_books_and_some_books_are_in_bad_shape";
		}
		// all books arrived with some unexpected ones and are all in good shape
		if ( this.memory.length === 0 && this.bad_goods.length === 0 && this.unexpected.length > 0 && this.new_memory.length > 0 ) {
			return "all_books_arrived_with_some_unexpected_ones_and_are_all_in_good_shape";
		}
		// all books arrrived and are all in perfect condition
		if ( this.memory.length === 0 && this.bad_goods.length === 0 && this.unexpected.length === 0 && this.new_memory.length > 0 ) {					
			return "all_books_arrrived_and_are_all_in_perfect_condition";
		}
		// *having evrything null is not possible since the books from new memory had to go somewehre 
		if ( this.memory.length === 0 && this.bad_goods.length === 0 && this.unexpected.length === 0 && this.new_memory.length === 0  ) {
			return false;
		}
		// all books arrived and are bad
		if ( this.memory.length === 0 && this.bad_goods.length > 0 && this.unexpected.length === 0 && this.new_memory.length === 0  ) {

			return "all_books_arrived_and_are_bad";
		}
		// *this one cancels itslef out
		if ( this.memory.length === 0 && this.bad_goods.length === 0 && this.unexpected.length > 0 && this.new_memory.length === 0  ) {
			return false;
		}
		// some books arrived along with some unexpected ones and are all in good condition 
		if ( this.memory.length > 0 && this.bad_goods.length === 0 && this.unexpected.length > 0 && this.new_memory.length > 0  ) {
			return "some_books_arrived_along_with_some_unexpected_ones_and_are_all_in_good_condition";
		}
		// all books arrived and some are in a unaceptable condition
		if ( this.memory.length === 0 && this.bad_goods.length > 0 && this.unexpected.length === 0 && this.new_memory.length > 0  ) {					
			return "all_books_arrived_and_some_are_in_a_unaceptable_condition";
		}
		// only unexpectede books arrived 
		if ( this.memory.length > 0 && this.bad_goods.length === 0 && this.unexpected.length > 0 && this.new_memory.length === 0  ) {
			return "only_unexpected_books_arrived";
		}
		// some books didint arrive and some that did are not in a good shape 
		if ( this.memory.length > 0 && this.bad_goods.length > 0 && this.unexpected.length === 0 && this.new_memory.length > 0  ) {
			return "some_books_didint_arrive_and_some_that_did_are_not_in_a_good_shape";
		}
		// all books arrived with some unexpected books and only some unexpected books are in good shape
		if ( this.memory.length === 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 && this.new_memory.length === 0  ) {
			return "all_books_arrived_with_some_unexpected_books_and_only_some_unexpected_books_are_in_good_shape";
		}
		// some books didint arrive but the ones that did are in a good condition 
		if ( this.memory.length > 0 && this.bad_goods.length === 0 && this.unexpected.length === 0 && this.new_memory.length > 0  ) {
			return "some_books_didint_arrive_but_the_ones_that_did_are_in_a_good_condition";
		}
		
		// if { 
		// 	return { 
		// 		action  : "some_books_are_in_bad_condition_and_some_missing",
		// 		message : {
		// 			ticket_id      : this.ticket,
		// 			bad_books      : this.bad_goods,
		// 			books 		   : this.new_memory,
		// 			promised_books : this.memory
		// 		}
		// 	}
		// }

		// if ( this.memory.length === 0 && this.bad_goods.length === 0 && this.unexpected.length > 0 ) {
		// 	return "unexpected_book"
		// }

		// if ( this.memory.length === 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 ) {
		// 	return "unexpected_books_and_some_are_bad_books";
		// }

		// if ( this.memory.length > 0 && this.bad_goods.length > 0 && this.unexpected.length > 0 ) {
		// 	return "some_books_missing_some_unexpected_and_some_in_bad_shape";
		// }
	};

	return alpha;

})(alpha || {}, jQuery );			