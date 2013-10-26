define({

	make : function (alpha, $, frameworkuri, url, append_to ) {

			ajaxurl   = url
			var book  = {};
				book.results = [];
				book.basket  = [];
			var animate = {};
				animate.load  = false;
				animate.state = false;
				animate.scroll= false;
				animate.page  = "home";
				animate.popup = false;
				animate.pop   = {};
				animate.pop.outside = false;

			var preset = {
				account : {
					credit 	           : "0.00",
					donate 	           : "0.00",
					last_withdraw      : "0000/00/00",
					first_name         : "",
					second_name        : "",
					price_promise      : [],
					history            : [],
					unaccepted_book    : [],
					email              : "",
					year               : "",
					university         : "",
					password           : "",
					recieve_newsletter : 1
				}
			}

			var state = {};
				state.viewed_item  = {};
				state.viewed_item.book   = {};
				state.viewed_item.parts  = {};
				state.viewed_item.show   = false;
				state.viewed_item.parts.external_product_id = "";
				state.viewed_item.parts.item_name           = "";
				state.viewed_item.parts.author              = "";
				state.viewed_item.parts.standard_price      = "";
				state.viewed_item.parts.main_image_url      = "";

				state.email = {};
				state.email.freepost = "";

				state.quote = "post";

				state.register_account    = false;
				state.password_remind     = false;
				state.give_freepost       = false;
				state.give_price_promise  = false;
				state.give_print_your_own = false;

				state.confirm           = {};
				state.confirm.tab       = 0;
				state.confirm.postage   = false;

				state.begin        = false;
				state.save_account = false;
				state.save_address = false;
				state.edit_account = false;

				state.edit = {};
				state.edit.confirm  = false;
				state.edit.withdraw = {};
				state.edit.withdraw.first_name = false;
				state.edit.withdraw.address    = false;

				state.notification = {};
				state.notification.reset = {};
				state.notification.reset.notify = false;
				state.notification.reset.text   = "";

				state.text = {};
				state.text.search = "";
				state.next_route  = "";

				state.process = {};
				state.process.search   = false;
				state.process.register = false;
				state.process.update   = false;
				state.process.log_in   = false;
				state.process.log_out  = false;
				state.process.bus_search     = false;
				state.process.false_register = false;
				state.process.donate         = false;
				state.process.add_book       = false;
				state.process.get_freepost   = false;

				state.password         = {};
				state.password.mistake = false;

				state.withdraw  = 0.00;
				state.signed    = false;
				state.addresses = [{}];
				state.account = {
					credit 	           : "0.00",
					donate 	           : "0.00",
					last_withdraw      : "0000/00/00",
					first_name         : "",
					second_name        : "",
					price_promise      : [],
					history            : [],
					unaccepted_book    : [],
					email              : "",
					year               : "",
					university         : "",
					password           : "",
					recieve_newsletter : 1
				};
				state.registration = {
					first_name : false,
					last_name  : false,
					post_code  : false,
					town       : false,
					area 	   : false,
					address    : false,
					email 	   : {
						size  : false,
						text  : false,
						unique: false,
						match : false
					},
					password   : {
						size : false,
						match: false 
					}
				};

				state.donate = {};
				state.donate.university = null;
				state.invisible_popup      = {};
				state.invisible_popup.open = false;
				state.invisible_popup.box  = false;

				state.stock = {};
				state.stock.page = false;
				state.stock.user = {
					notification : "",
					loged_in : false,
					name     : "",
					password : ""
				};

				state.stock.bus  = {
					search       : false,
					searching    : false,
					found        : false,
					search_query : "",
					add_book     : false,
					submit_expenses    : false,
					submiting_expenses : false,
					expenses_submited  : false,
					expenses     : [],
					add          : false,
					adding       : false,
					adding_books : [],
					added_books  : false,
					submit       : false,
					print        : false,
					books        : [],
					total        : 0,
					final_total  : 0,
					cheque_spell : 0,
					reset        : false,
					send_email   : false,
					sending_email: false,
					sent_email   : false
				};

				state.stock.post = {
					finished            : false,
					search_user_query   : "",
					search_user         : false,
					searching_user      : false,
					found_user          : false,
					user                : {},
					search_book_query   : "",
					search_book         : false,
					searching_book      : false,
					found_book          : false,
					books               : [],
					add_book            : false,
					price_promise_match : [],
					total               : 0,
					error               : "",
					submit_credit       : false,
					submiting_credit    : false,
					submited_credit     : false,
					submit_book         : false,
					submiting_book      : false,
					submited_book       : false,
					send_email          : false,
					sending_email       : false,
					sent_email          : false
				}

				state.stock.book = {
					recalculate_string   : "",
					begin_recalculation  : false,
					finish_recalculation : false,
					number_of_books      : {
						recalculated     : 0,
						uploaded         : 0,
						to_recalculate   : 0,
						to_upload        : 0
					},
					books                : {
						refused : [],
					},
					inventory_books_by   : {
						asin  : [],
						index : []
					},
					recalculate_again    : [],
					erronious_books      : [],
					table_wiped          : false,
					export_table         : false,
					table_exported       : false,
					exported_table_link  : ""
				};
				state.stock.book.add = {
					isbn      : "",
					condition : "",
					search    : false,
					searching : false,
					found     : false,
					add       : false,
					addding   : false,
					added     : false,
					book_added: {}
				};
				state.stock.book.list = {
					get_book : {
						get     : false,
						getting : false,
						done    : false
					}
				};

			var router = new alpha.route({
				on  : function () {
					world.wrap.branch.home_wrap.self.css({ display : "block" }).animate({ opacity : 1 });
					animate.state = false;
					animate.page  = "home";
				},
				off : function () {
					world.wrap.branch.home_wrap.self.css({ display : "none", opacity : 0 });
				},
				recyclabus : {
					on : function () {
						world.wrap.branch.bus.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.page  = "recyclabus";
					},
					off: function () { 
						world.wrap.branch.bus.self.css({ display : "none", opacity : 0 });
					}
				},
				sell: {
					on : function () {
						world.wrap.branch.sell.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.page  = "sell";
					},
					off: function () {
						world.wrap.branch.sell.self.css({ display : "none", opacity : 0 });
					}
				},
				hub : {
					on : function () {
						world.wrap.branch.hub.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = false;
						animate.scroll= "hub";
					},
					off: function () {
						world.wrap.branch.hub.self.css({ display : "none", opacity : 0  });
					}
				},
				confirm_sign_in : {
					on : function () {
						world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.self.css({ display : "block" }).animate({ opacity : 1 }, 700);
						animate.state = "welcome";
					},
					off: function () {
						world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.self.css({ display : "none", opacity : 0 });
					}	
				},
				register : {
					on : function () {
						world.wrap.branch.registration.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.state = "register";	
					},
					off: function () {
						world.wrap.branch.registration.self.css({ display : "none", opacity : 0  });					
					}
				},
				confirm : {
					on : function () {
						animate.state = "confirm";
						world.wrap.branch.confirm.self.css({ display : "block" }).animate({ opacity : 1 });
						animate.scroll= "confirm";
					},
					off: function () {
						world.wrap.branch.confirm.self.css({ display : "none", opacity : 0  });
					}
				}, 
				done : {
					on : function () { 
						animate.state = "done";
						world.wrap.branch.thank_you.self.css({ display : "block" }).animate({ opacity : 1 });
					},
					off: function () { 
						world.wrap.branch.thank_you.self.css({ display : "none", opacity : 0  });
					}
				},
				stock : {
					on : function () {
						world.wrap.branch.stock.self.css({ display : "block" });
						state.stock.page         = "bus";
						state.process.sign_out   = true;
						$('body').css({ overflow : "hidden" });
					},
					off : function () {
						world.wrap.branch.stock.self.css({ display : "none" });
						state.stock.page         = false;
						$('body').css({ overflow : "auto" });
					}
				}
			});
			
			var world = new alpha.thought;
			world.thought = {
				wrap : {
					instructions : {
						email : function (wake) {

							$.post(ajaxurl, wake, function () {}, "json");
						},
						observers : [
							{
								who      : state.process,
								property : "log_out",
								call     : function (change) {
									if ( !change.new ) return;
									state.signed          = false;
									state.process.log_out = false;
									router.change_url("/");
									for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
									for ( var part in state.account ) state.account[part] = preset.account[part];
								}
							},
							{
								who      : state.process,
								property : "log_in",
								call     : function (change) {
									if ( change.new === false || state.signed ) return;

									$.get(ajaxurl, {
										action : "get_account",
										method : "account",
										paramaters : {
											email : state.account.email
										}
									}, function (account) {
										if ( account.return ) {
											if ( state.account.password === account.return.password ) {
												$.get(ajaxurl, {
													action : "get_account",
													method : "address",
													paramaters : {
														email : state.account.email
													}
												}, function (address) { 
														
													for ( var part in state.account )    state.account[part]      = account.return[part];
													for ( var part in address.return[0]) state.addresses[0][part] = address.return[0][part];
													state.signed         = true;
													state.process.log_in = false;
													router.change_url(state.next_route);

												}, "json");
											} else {
												state.password.mistake = "Wrong password";
											}
										} 	
										else { 
											state.password.mistake = "Username "+ state.account.email +" does not exist";
										}
									}, 
									"json");
									
								}
							},
							{
								who      : state.process,
								property : "register",
								call     : function (change) { 
									if ( !change.new ) return;
									if (
										   state.registration.first_name  
										&& state.registration.last_name
										&& state.registration.post_code
										&& state.registration.town
										&& state.registration.area  
										&& state.registration.address
										&& state.registration.email.size  
										&& state.registration.email.unique
										&& state.registration.email.match    === state.account.email
										&& state.registration.password.size
										&& state.registration.password.match === state.account.password
									) {
										$.post( ajaxurl, { 
											action      : "set_account",
											method      : "new_account",
											paramaters  : {
												account : state.account
											}
										}, function () {

											state.addresses[0].user = state.account.email;

											$.post( ajaxurl, {
												action : "set_account",
												method : "new_address",
												paramaters : {
													address : state.addresses[0]
												}
											}, function () {
												state.signed           = true;
												state.process.register = false;
												router.change_url(state.next_route);
											},"json");
										},"json");
									} else {
										state.process.register = false;
									}
								}
							},
							{
								who      : state.process,
								property : "false_register",
								call     : function (change) {
									if ( !change.new ) return;
									state.addresses[0].address   = "none";
									state.addresses[0].town      = "none";
									state.addresses[0].area      = "none";
									state.addresses[0].post_code = "AAAAAAA";
									state.account.first_name     = ( state.account.first_name.length > 0? state.account.first_name : "none" );
									state.account.second_name    = ( state.account.second_name.length > 0? state.account.second_name : "none" );
									state.account.password       = state.account.password || Math.random().toFixed(7).slice(2);
									
									$.post( ajaxurl, { 
										action      : "set_account",
										method      : "new_account",
										paramaters  : {
											account : state.account
										}
									}, function () {

										state.addresses[0].user = state.account.email;
										$.post( ajaxurl, {
											action : "set_account",
											method : "new_address",
											paramaters : {
												address : state.addresses[0]
											}
										}, function () {
											state.signed                 = true;
											state.process.false_register = false;
										},"json");
									},"json");
								}
							},
							{ 
								who      : state, 
								property : "save_account",
								call     : function (change) { 

									if ( change.new ) { 
										$.post(ajaxurl,
										{ 
											action     : "set_account",
											method     : "account",
											paramaters : {
												account : state.account
											}
										}, function (response) {
											state.save_account = false;
										}, "json");
									}
								}
							},
							{ 
								who      : state, 
								property : "save_address",
								call     : function (change) { 

									var submit = state.addresses[0];
										submit.user = state.account.email;
									if ( change.new ) { 
										$.post(ajaxurl,
										{ 
											action     : "set_account",
											method     : "address",
											paramaters : {
												address : submit
											}
										}, function (response) {
											state.save_address = false;
										}, "json");
									}
								}
							},
							{
								who      : state,
								property : "give_price_promise",
								call     : function (change) {
									if ( !change.new ) return;

									var price_promise, added_books, email_text;
									
									if ( state.account.price_promise === null ) state.account.price_promise = [];
									price_promise = state.account.price_promise.concat(book.basket);
									state.account.price_promise = price_promise;
									added_books   = "<ul>";
									for (var index = 0; index < book.basket.length; index++) {
										added_books += "<li>"+ book.basket[index].title +"</li>";
									};
									added_books             += "</ul>";
									book.basket              = [];
									state.save_account       = true;
									state.give_price_promise = false;

									email = "<p>Hi "+ state.account.first_name +"</p>"+
									"<p>You have added the following books to your price promise basket.</p>"+ 
										added_books +
									"<p>"+
										"The the prices of books and quotes we give can change,"+
										"the price promise basket: is our way of promising that"+
										"we will give you the price quoted on that day for your books,"+ 
										"so you don't have to worry"+
									"</p>"+
									"<p> Your Price Promise Expires In Two Weeks.</p>"+
									"<p>"+
										"To check on your price promise basket, and add any new books, visit"+
										"<a href=\"www.recyclabook.com\">Recyclabook</a>,"+
										"where you can log in and monitor what is going on with your books though your account hub."+
									"</p>";
								}
							},
							{ 
								who      : state,
								property : "give_freepost",
								call     : function (change) {
									if ( !change.new ) return;

									var date = new Date();
									$.post(ajaxurl,
									{
										action : "set_ticket",
										method : "freepost",
										paramaters : {
											array : {
												email       : state.account.email,
												first_name  : state.account.first_name,
												second_name : state.account.second_name,
												address     : state.addresses[0].address,
												post_code   : state.addresses[0].post_code,
												town        : state.addresses[0].town,
												area        : state.addresses[0].area,
												date        : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate(),
											}
										}
									}, function () {}, "json");

									world.wrap.instructions.email({
										action     : "set_email",
										method     : "send_email",
										paramaters : {
											type    : "pack",
											user_id : state.account.email,
										},
									});
									state.give_freepost = false;
								}
							},
							{ 
								who      : state,
								property : "give_print_your_own",
								call     : function (change) {
									if ( !change.new ) return;

									$.get(ajaxurl, {
										action : "get_account",
										method : "account_value",
										paramaters : {
											email : state.account.email,
											get   : "id" 
										}
									}, function (response) { 
										state.account.id = response.return;
										state.give_print_your_own = false;
										world.wrap.instructions.email({
											action     : "set_email",
											method     : "send_email",
											paramaters : {
												type    : "print",
												user_id : state.account.email,
											},
										});
									}, "json");

								}
							},
							{ 
								who      : state,
								property : "add_account",
								call     : function (change) {
									if ( !change.new ) return;

									state.add_account = false;
								}
							},
							{ 
								who      : state,
								property : "quote",
								call     : function (change) {
									var labels = $('.result_book_price'),
										basket = $('.store_basket_pop_up_content_item_sell_price');

									for (var index = 0; index < labels.length; index++) {
										var price       = {};
											price.label = $(labels[index]);
											price.quote = parseFloat(price.label.text().trim());
											if ( change.new === "post" ) {
												price.quote/= 1.2;
											} else {
												price.quote*= 1.2;
											}
											price.quote = price.quote.toFixed(2)
											price.label.text(price.quote);
									};
								}
							},
							{
								who      : state.process,
								property : "search",
								call     : function (change) {
									if ( !change.new ) return;

									var display_book, prices, algorithm, search_query;

									algorithm    = new alpha.algorithm;
									prices       = [];
									search_query = state.text.search.replace(/[-\s]+/g, "");

									new alpha.pure_amazon_search({
										typed       : search_query,
										search_by   : "ISBN",
										filter_name : "sort"
									}, function (books) {

										books = books.return

										if ( books.length > 0 ) {
											for (var index = 0; index < books.length; index++) {
												books[index] = algorithm.bus(books[index]);
												prices.push(books[index].standard_price);
											}

											display_book                = books[0];
											display_book.standard_price = Math.min.apply(Math, prices);
											display_book                = [display_book];
										} else {
											display_book = [];
										}

										state.quote                 = "post";
										book.results                = display_book;
										state.process.search        = false;

										if ( router.get_route() !== "/sell" ) router.change_url("sell");
									});
								}
							},
							{
								who      : state.process,
								property : "donate",
								call     : function (change) {

									if ( state.withdraw === 0 || state.withdraw === "0.00" ) return;

									var date = new Date();
									$.post(ajaxurl, {
										action : "set_ticket",
										method : "rag_donate",
										paramaters : {
											array : {
												email      : state.account.email,
												first_name : state.account.first_name,
												second_name: state.account.second_name,
												university : state.donate.university,
												amount     : state.withdraw,
												date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
											}
										}
									}, function (response) {}, "json");

									state.account.credit = parseFloat( state.account.credit ) - state.withdraw;
									state.account.credit = state.account.credit.toFixed(2);
									state.withdraw       = "0.00";
									state.save_account   = true;
								}
							},
							{
								who      : state.process,
								property : "bus_search",
								call     : function (change) {
									if ( !change.new ) return;
									new alpha.amazon({
										typed         : state.stock.bus.search,
										bus_algorithm : true,
										callback      : function (books) { 
											if ( books !== undefined ) {
												var basket = [],
													part   = {};

												if ( books.length === 0 ) {
													part.isbn  = state.stock.bus.search;
													part.title = "Book can not be accapted";
													part.price = "0.00";
													part.id    = "remove";
												} else { 
													if ( books.length > 1 ) books.splice(1,1);
													books[0].price  = parseFloat( books[0].price );
													books[0].price *= 1.2;
													books[0].price  = books[0].price.toFixed(2);
													part.price  = books[0].price;
													part.title  = books[0].title;
													part.isbn   = books[0].isbn;
													part.id     = state.stock.bus.basket.length;
												}

												basket                 = state.stock.bus.basket.concat(books)
												state.stock.bus.basket = basket;

												$('<div class="bus_control_item">'+
													'<div class="bus_control_item_isbn">'+   part.isbn  +'</div>'+
													'<div class="bus_control_item_title">'+  part.title +'</div>'+
													'<div class="bus_control_item_total">£'+ part.price +'</div>'+
													'<div class="bus_control_remove" id="'+  part.id  +'">Remove</div>'+
												'</div>').appendTo(world.wrap.branch.stock.branch.bus.branch.input.branch.items.self);
											}
										}
									});
								}
							},
							{
								who      : state.process,
								property : "add_book",
								call     : function (change) {
									if ( !change.new ) return;

									var basket = [];

									for (var index = 0; index < state.stock.bus.basket.length; index++) {										
										var book     = state.stock.bus.basket[index],
											new_book = {};	

											new_book.external_product_id      = book.isbn;
											new_book.external_product_id_type = "ISBN";
											new_book.item_name                = book.title.substring(0, 97);
											new_book.author                   = book.author;
											new_book.binding                  = book.binding;
											new_book.publication_date         = "2013/01/01";
											new_book.standard_price           = book.price;
											new_book.quantaty                 = 1;
											new_book.condition_type           = 3;
											new_book.product_description      = "";
											new_book.main_image_url           = book.image;
											basket.push(new_book);
									}

									$.post(ajaxurl, {
										action     : "set_book",
										method     : "book",
										paramaters : {
											books : basket
										}
									}, function () {}, "json");
								}
							}
						]
					},
					self   : '<div class="wrap"></div>',
					branch : {
						load : {
							instructions : {
								observers : [
									{
										who      : state.password,
										property : "mistake",
										call     : function (change) {

											animate.load     = change.new;
											setTimeout(function () {
												animate.load = false;
											}, 2000 );
										}
									},
									{
										who      : state.process,
										property : "search",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Searching for "+ state.text.search;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : state.process,
										property : "log_in",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Logging you in as "+ state.account.email;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : state.process,
										property : "register",
										call     : function (change) {
											if ( change.new ) {
												animate.load = "Registering you as "+ state.account.email;
											} else { 
												animate.load = false;
											}
										}
									},
									{
										who      : animate,
										property : "load",
										call     : function (change) { 
											var load = world.wrap.branch.load.self;
											if ( change.new === false ) {
												load.animate({ opacity : 0 }, 500, function () {
													load.css({ display : "none" });
												});
											} else { 
												load.text(change.new).css({ display : "block"}).animate({ opacity : 1 }, 200);
											}
										}
									}
								]
							},
							self : '<div class="load"></div>'
						},
						header : { 
							self   : '<section class="header"></section>',
							branch : {
								wrap : {
									self   : '<div class="header_wrap"></div>',
									branch : {
										invisible_box : {
											self   : '<div class="header_invisible_box"></div>',
											branch : {
												logo : {
													self : '<a href="/"><img src="'+frameworkuri+'/CSS/Includes/works/header_logo.png" alt="" class="header_invisible_box_image_title"></a>',
												},
												text : {
													self : '<div class="header_invisible_box_text_wrap"></div>',
													last_branch : { 
														title : '<div class="header_invisible_box_text_title">What We Do</div>',
														paragraph : '<div class="header_invisible_box_text">Recyclabook accepts over a million different titles, you can easily sell your book and get paid quickly and safely.</div>'
													}
												}
											}	
										},
										search_box : {
											self   : '<div class="header_text_box"></div>',
											branch : {
												title  : {
													self : '<div class="header_text_box_title">How <span class="header_text_box_title_highlight">much</span> is <br/><span class="header_text_box_title_highlight">your</span> book <span class="header_text_box_title_highlight">worth?</span></div>'
												},
												search : { 
													self   : '<div class="header_text_box_input"></div>',
													branch : {
														input_wrap : {
															self   : '<div class="header_field_for_input"></div>',
															branch : {
																input : {
																	instructions : {
																		on_events : [
																			{
																				the_event : "keyup",
																				is_asslep : false,
																				call      : function (change) {
																					state.text.search = change.self.val();
																				}
																			},
																			{
																				the_event : "keypress",
																				is_asslep : false,
																				call      : function (change) {
																					if ( change.event.keyCode === 13 ) state.process.search = true;
																				}
																			}
																		]
																	},
																	self  : '<input type="text" class="header_input_block_for_search block_for_search" placeholder="please enter your ISBN here">',
																}
															}
														},
														search_button : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.process.search = true;
																	}
																}
															},
															self : '<span class="with-icon-header-search"></span>'
														}
													}
												}
											}
										},
										search_box_arrow : { 
											self : '<div class="with-icon-header-text-box-arrow"></div>' ,
										}
									}
								},
								header_image_wrap : {
									self : '<div class="header_image_wrap"></div>',
									last_branch : { 
										image : '<img src="'+ frameworkuri +'/CSS/Includes/works/jhonc.png" class="header_image">'
									}
								}
							}
						},
						navigation : {
							self : '<section class="bar_outer_wrap"></section>',
							branch : {
								wrap : {
									self   : '<div class="bar"></div>',
									branch : {
										arrow : {
											instructions : {
												observe : {
													who      : animate,
													property : "state",
													call     : function (change) {
														var arrow = world.wrap.branch.navigation.branch.wrap.branch.arrow.self;
														if ( change.new === false || change.new === "done" ) arrow.css({ display : "none" });
														if ( change.new !== false && change.new !== "done" ) arrow.css({ display : "block" });
														if ( change.new === "welcome" )  arrow.animate({ left : "68px" });
														if ( change.new === "register" ) arrow.animate({ left : "152px" });
														if ( change.new === "confirm"  ) arrow.animate({ left : "234px" });
													}
												}
											},
											self : '<span class="with-icon-progress-pop-up-arrow"></span>'
										},
										navigation : {
											self   : '<div class="navigation_wrap"></div>',
											branch : {
												wrap : {
													instructions : { 
														observe : {
															who : animate,
															property : "state",
															call : function (change) {
																var progress = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.self;
																	if ( change.new !== false ) progress.animate({ top : "-52px" });
																	if ( change.new === false ) progress.animate({ top : "0px" });
															}
														}
													},
													self   : '<div class="navigation_inner_wrap"></div>',
													branch : {
														navigation : {
															self   : '<div class="navigation"></div>',
															branch : {
																how_it_works : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.how_it_works.self;
																				if ( change.new === "home" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "home" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="/" id="homepage_navigation" class="with-icon-for-navigation-text-for-bar-active">How It Works</a>'
																},
																sell_books : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.sell_books.self;
																				if ( change.new === "sell" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "sell" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="sell" class="navigation_text_for_bar">Sell Books</a>'
																}
															}
														},
														progress : {															
															self   : '<div class="progress_icons_for_bar_wrap"></div>',
															branch : {								
																welcome : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.welcome.self;
																					if ( change.new === "welcome") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.welcome.branch.circle.self;
																							if ( change.new === "welcome" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},		
																			self   : '<div class="progress_icon_circle_doing"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-welcome-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Welcome</span>'
																		}
																	}
																},
																account : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.account.self;
																					if ( change.new === "welcome" || change.new === "register") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.account.branch.circle.self;
																							if ( change.new === "welcome" ) {
																								circle.attr("class", "progress_icon_circle");
																							} else if ( change.new === "register" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-account-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Account</span>'
																		}
																	}
																},
																confirm : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "state",
																			call     : function (change) {
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.confirm.self;
																					if ( change.new === "welcome" || change.new === "register" || change.new === "confirm") {
																						icon.attr("class", "progress_icon_for_bar");
																					} else {
																						icon.attr("class", "progress_icon_for_bar_done");
																					}
																			}
																		}
																	},
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.confirm.branch.circle.self;
																							if ( change.new === "welcome" || change.new === "register" ) {
																								circle.attr("class", "progress_icon_circle");
																							} else if ( change.new === "confirm" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else { 
																								circle.attr("class", "progress_icon_circle_done");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-confirm-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Confirm</span>'
																		}
																	}
																},
																thank_you : {
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			instructions : {
																				observe : {
																					who      : animate,
																					property : "state",
																					call     : function (change) {
																						var circle = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.progress.branch.thank_you.branch.circle.self;
																							if ( change.new === "done" ) {
																								circle.attr("class", "progress_icon_circle_doing");
																							} else {
																								circle.attr("class", "progress_icon_circle");
																							}
																					}
																				}
																			},	
																			self   : '<div class="progress_icon_circle"></div>',
																			last_branch : {
																				icon : '<span class="with-icon-thank-you-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Thank You</span>'
																		}
																	}
																},
																back : {
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
																			self   : '<a href="sell" class="progress_icon_circle"></a>',
																			last_branch : {
																				icon : '<span data-function-to-call="front.prototype.go_back_to_shopping" class="with-icon-back-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Go Back</span>'
																		}
																	}
																}
															}
														}										
													}
												}
											}
										},
										progress_popup : {
											instructions : { 
												observe : {
													who : animate,
													property : "state",
													call : function (change) {
														var box = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self;
															if ( change.new === "register" || change.new === "confirm" ) {
																box.css({ display : "block" });
															} else { 
																box.css({ display : "none" });
															}
													}
												}
											},
											self   : '<div class="progress_pop_up"></div>',
											branch : {
												title : {
													self   : '<div class="progress_pop_up_title"></div>',
													branch : {
														text : {
															instructions : {
																observe : {
																	who : animate,
																	property : "state",
																	call : function (change) { 
																		var title = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.title.branch.text.self;
																			if ( change.new === "register" )  title.text("Create Account");
																			if ( change.new === "confirm"  )  title.text("Confirm Basket");
																	}
																}
															},
															self : '<span class="progress_pop_up_title_text"></span>'
														},
														icon : {
															self   : '<span class="progress_pop_up_title_icon"></span>',
															branch : {
																icon : {
																	instructions : {
																		observe : {
																			who : animate,
																			property : "state",
																			call : function (change) { 
																				var icon = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.title.branch.icon.branch.icon.self;
																					if ( change.new === "register" )  icon.attr("class", "with-icon-account-progress-bar");
																					if ( change.new === "confirm"  )  icon.attr("class", "with-icon-confirm-progress-bar");
																			}
																		}
																	},
																	self : '<span class="with-icon-welcome-progress-bar"></span>'
																}
															}
														}
													}
												},
												text : {
													instructions : {
														observe : {
															who : animate,
															property : "state",
															call : function (change) { 
																var text = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.branch.text.self;
																	if ( change.new === "register" )  text.text("This will allow us to send the payment to the correct address, as well as allowing you to track these payments, check book orders and edit details.");
																	if ( change.new === "confirm"  )  text.text("Better be safe than sorry, Just check the books and address are correct and edit any mistakes if need be, then chose which type of freepost you prefer and confirm your sale. Shazam!");
															}
														}
													},
													self : '<p class="progress_pop_up_text"></p>'
												}
											}
										},						
										welcome_popup : {
											self   : '<div class="progress_welcome_pop_up"></div>',
											branch : {
												placeholder : {
													instructions : {
														observe : {
															who      : state,
															property : "signed",
															call     : function (change) {
																var holder = world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.branch.placeholder.self;
																	if ( change.new ) {
																		holder.animate({ top : "0px", marginBottom : "20px" });
																	} else {
																		holder.animate({ top : "-220px", marginBottom : "-220px" });
																	}
															}
														}
													},
													self : '<div class="progress_welcome_pop_up_placeholder"></div>',
													branch : {
														text : {
															self : '<div class="progress_welcome_pop_up_placeholder_text">You are signed in...</div>'
														},
														sign_out : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () { 
																		state.signed    = false;
																		for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
																		for ( var part in state.account )      state.account[part]      = preset.account[part];
																	}
																}
															},
															self : '<div class="progress_welcome_pop_up_placeholder_link">sign out?</div>'
														}
													}
												},
												sign_in : {
													self   : '<div class="progress_welcome_sign_in_box"></div>',
													branch : {
														title    : {
															self : '<div class="progress_welcome_sign_in_box_title">Sign In</div>'
														},
														email    : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val();
																	}
																}
															},
															self : '<input type="text" class="progress_welcome_sign_in_box_input" placeholder="Email Address" value="">'
														},
														password : {
															instructions : {
																on : {
																	the_event : "keypress",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.keyCode === 13 ) {
																			state.account.password  = change.self.val();
																			state.process.log_in    = true;
																			state.next_route        = "confirm";
																		}	
																	}
																}
															},
															self : '<input type="password" class="progress_welcome_sign_in_box_password" placeholder="Password" value="">'
														},
														enter : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.account.password = this.password.self.val();
																		state.process.log_in   = true;
																		state.next_route       = "confirm";
																	}
																}
															},
															self : '<div alt="Log in" class="with-icon-enter-for-welcome-box"></div>'
														},
														forgoten : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "forgotten";
																	}
																}
															},
															self : '<span class="progress_welcome_sign_in_box_forgot_password">Forgoten Password?</span>'
														}
													}
												},
												register : {
													self   : '<div class="progress_welcome_register_box"></div>',
													branch : {
														text   : {
															self : '<div class="progress_welcome_register_box_text">New To Recyclabook >>></div>'
														},
														button : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.next_route = "confirm";
																	}
																}
															},
															self : '<a href="register" class="progress_welcome_register_box_button">Sign Up</a>'
														}
													}
												}
											}
										},
										user_button : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.invisible_popup.open = true;
														state.invisible_popup.box  = "sign";
													}
												}
											},
											self   : '<div class="button_for_user"></div>',
											last_branch : {
												icon  : '<span class="with-icon-user"></span>',
												arrow : '<span class="with-icon-user-arrow"></span>'
											}
										},
										user_button_text : {
											self : '<span class="button_text_for_user">Log In</span>'
										},						
									}
								}
							}
						},
						invisible_popup : {
							instructions : {
								on : {
									the_event : "click",
									is_asslep : false,
									call      : function (change) {
										if ( change.event.target.className === "invisible_popup_lightbox" ) {
											state.invisible_popup.open = false;
											state.invisible_popup.box  = false;
										}
									}
								},
								observe : {
									who      : state.invisible_popup,
									property : "open",
									call     : function (change) {
										height = $('.wrap').height();
										if ( change.new ) {
											this.self.css({ display : "block", height : height });
										} else {
											this.self.css({ display : "none" });
										}
									}
								}
							},
							self : '<div class="invisible_popup_lightbox"></div>',
							branch : {
								wrap : {
									self : '<div class="sign_popup_box_wrap"></div>',
									branch : {
										user_popup_box : {	
											instructions : {
												observe : {
													who      : state.invisible_popup,
													property : "box",
													call     : function (change) {
														( change.new === "sign" )? this.self.css({ display : "block" }) : this.self.css({ display : "none" });
													}
												}
											},										
											self   :  '<div class="sign_popup_box"></div>',
											branch : {
												popup_arrow : {
													self : '<span class="with-icon-user-pop-up-box-arrow"></span>' 
												},
												settings : {
													instructions : {
														observe : {
															who : state,
															property : "signed",
															call : function (change) { 
																if ( change.new ) {
																	this.self.css({ display : "block" });
																} else {
																	this.self.css({ display : "none" });
																}
															}
														}
													},
													self   : "<div class=\"sign_popup_settings_wrap\"></div>",
													branch : {
														title : {
															instructions : {
																observe : {
																	who      : state.account,
																	property : "first_name",
																	call     : function (change) {
																		this.self.text("Hi, "+ change.new );
																	}
																}
															},
															self : '<div class="sign_popup_title"></div>' 
														},
														edit_option : {
															self : '<a href="hub" class="sign_popup_option">View Account</a>'
														},
														sign_out : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		state.process.log_out = true;
																	}
																}
															},
															self : '<div class="sign_popup_option">Sign Out</div>'
														}
													}
												},
												sign_in : {
													instructions : {
														observe : {
															who : state,
															property : "signed",
															call : function (change) {
																if ( change.new ) {
																	this.self.css({ display : "none" });
																} else {
																	this.self.css({ display : "block" });
																}
															}
														}
													},
													self   : "<div class=\"sign_popup_sign_in_wrap\"></div>",
													branch : {
														sign_in_wrap : {
															self   : '<div class="sign_popup_title_white">Sign in </div>',
															branch : {
																register : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				state.next_route = "hub";
																			}
																		}
																	},
																	self : '<a href="register" class="sign_popup_title_highlight">Register</a>'
																}
															}
														},
														email : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val();
																	}
																}
															},
															self : '<input type="text" class="sign_popup_option_input" placeholder="Email">'
														},
														password : {
															instructions : {
																on : {
																	the_event : "keypress",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.keyCode === 13 ) {
																			state.account.password  = change.self.val();
																			state.process.log_in    = true;
																			state.next_route        = "hub";
																		}	
																	}
																}
															},
															self : '<input type="password" class="sign_popup_password_input" placeholder="Password">'
														},
														enter : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.account.password  = this.password.self.val();
																		state.process.log_in    = true;
																		state.next_route        = "hub";
																	}
																}
															},
															self : "<div title=\"log in\" class=\"with-icon-enter-for-user-popup\"></div>"
														},
														forgotten_password : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "forgotten";
																	}
																}
															},
															self : '<div class="sign_popup_options_forgot_password">forgottten password?</div>' 
														}
													}
												}																							
											}
										},
										basket_popup : {
											instructions : {
												observe : {
													who      : state.invisible_popup,
													property : "box",
													call     : function (change) {
														( change.new === "basket" )? this.self.css({ display : "block", opacity : 1 }) : this.self.css({ display : "none" });
													}
												}
											},	
											self   : '<div class="store_basket_pop_up"></div>',
											branch : { 
												arrow : { 
													self : '<div class="with-icon-store-basket-pop-up-arrow"></div>'
												},
												items : {
													self   : '<div class="store_basket_pop_up_content"></div>',
													branch : {
														items : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.target.className === "with-icon-x-for-store-basket-pop-up-content-item" ) {
																			var basket, index;
																				index  = change.event.target.getAttribute("data-type-book");
																			 	basket = book.basket;
																				basket.splice((index-1), 1);
																				book.basket = basket;
																		}
																	}
																},
																observe : {
																	who : book,
																	property : "basket",
																	call : function (change) {
																		var book_string, index, current_book;

																		book_string = "";

																		for (index = 0; index < book.basket.length; index++) {

																			current_book = book.basket[index];
																			book_string += 
																				'<div class="store_basket_pop_up_content_item">'+
																					'<div class="store_basket_pop_up_content_item_thumbnail">'+
																						'<img src="'+ current_book.main_image_url +'">'+
																					'</div>'+
																					'<div class="store_basket_pop_up_content_item_title">'+  current_book.item_name +'</div>'+
																					'<div class="store_basket_pop_up_content_item_author">'+ current_book.author    +'</div>'+
																					'<div class="store_basket_pop_up_content_item_isbn_wrap">'+
																						'<div class="store_basket_pop_up_content_item_isbn_highlight">ISBN: </div>'+
																						'<div class="store_basket_pop_up_content_item_isbn">'+ current_book.external_product_id +'</div>'+
																					'</div>'+
																					'<div class="store_basket_pop_up_content_item_sell_price_wrap">'+
																						'<div class="store_basket_pop_up_content_item_sell_price_text">Sell for:</div>'+
																						'<div class="store_basket_pop_up_content_item_sell_price">'+ current_book.standard_price + '</div>'+
																					'</div>'+
																					'<div data-type-book="'+ ( index + 1 ) +'" class="with-icon-x-for-store-basket-pop-up-content-item"></div>'+
																				'</div>';

																		};
																		this.self.empty();
																		this.self[0].insertAdjacentHTML("afterbegin", book_string );
																	}
																}
															},
															self : '<div class="store_basket_pop_up_content_items_wrap"></div>'
														},
														total : { 
															self   : '<div class="store_basket_pop_up_content_total_wrap"></div>',
															branch : {
																text   : {
																	self : '<div class="store_basket_pop_up_content_total_text">Total:</div>'
																},
																number : {
																	instructions : {
																		observe : {
																			who      : book,
																			property : "basket",
																			call     : function (change) { 
																				var quote = 0;
																				for (var index = 0; index < change.new.length; index++) quote += parseFloat( change.new[index].standard_price );
																				this.self.text("£ "+ quote.toFixed(2));
																			}
																		}
																	},
																	self : '<div class="store_basket_pop_up_content_total_number">£ 0.00</div>'
																}
															}
														}									
													}
												},
												buttons : { 
													self   : '<div class="store_basket_pop_up_button_wrap"></div>',
													branch : {
														checkout : {
															instructions : {
																on : { 
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( book.basket.length === 0 ) return;
																		(state.signed)? router.change_url("confirm") : router.change_url("confirm_sign_in");
																		state.invisible_popup.open = false;
																	}
																}
															},
															self : '<div class="store_basket_pop_up_button_first">Check And Continue</div>'
														}
													}
												},
												popup_text : {
													self : '<div class="store_basket_pop_up_text">Currently showing freepost prices</div>'
												}
											}
										},
									}
								}
							}
						},
						popup : {
							instructions : {
								observe : {
									who      : animate.pop,
									property : "outside",
									call     : function (change) { 
										var box = world.wrap.branch.popup.self;
										if ( change.new !== false ) {
											$('body').css({ overflow : "hidden"});
											box.css({ display : "block" }).animate({ opacity : 1 });
										} else {
											box.animate({ opacity : 0 }, 500, function () {
												$('body').css({ overflow : "auto"});
												box.css({ display :"none" });
											});
										}
									}
								},
								on : {
									the_event : "click",
									is_asslep : false,
									call      : function (change) {
										if ( change.event.target.className === "popup_lightbox" ) animate.pop.outside = false;
									}
								}
							},
							self : '<div class="popup_lightbox"></div>',
							branch : {
								box : {
									instructions : {
										observe : {
											who      : animate.pop,
											property : "outside",
											call     : function (change) { 
												var box    = world.wrap.branch.popup.branch.box.self,
													screen_height = window.screen.availHeight;

												if ( change.new !== false ) {
													box.css({ top : screen_height+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : screen_height+"px" }, 200);
												}
											}
										}
									},
									self : '<div class="popup_box"></div>',
									branch : {
										close : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = false;
													}
												}
											},
											self : '<div class="with-icon-outside-popup-close"></div>'
										},
										forgotten_password   : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.forgotten_password.self;
														if ( change.new === "forgotten" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														}
													}
												}
											},
											self : '<div class="popup_forgotten"></div>',
											branch : {
												title : {
													self : '<div class="popup_forgotten_title">Forgot Your Password?</div>'
												},
												text  : {
													self : '<div class="popup_forgotten_description">Well\' send you an email with a password reminder</div>'
												},
												input : {
													instructions : {
														on : {
															the_event : "keyup",
															is_asslep : false,
															call      : function (change) { 
																state.account.email = change.self.val();
															}
														}
													},
													self : '<input type="text" class="popup_forgotten_input" placeholder="Email">'
												},
												send : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																if ( state.account.email.trim() === "" ) return;
																change.self.text("Checking...");
																$.get(ajaxurl, {
																	action     : "get_account",
																	method     : "account",
																	paramaters : {
																		email : state.account.email.trim(),
																		}
																	}, function (response) {
																		if ( !response.return ) { 
																			change.self.text("Account not found, try again?");
																		} else {
																			$.post(ajaxurl, {
																				action     : "set_email",
																				method     : "send_email",
																				paramaters : {
																					type    : "password",
																					user_id : state.account.email,
																				}
																			}, function () {
																				change.self.text("Email sent");
																			}, "json");
																		}
																	}, "json");
															}
														}
													},
													self : '<div class="popup_forgotten_send">Recover My Password</div>'
												}
											}
										},
									}
								}
							}
						},
						home_wrap : {
							self   : '<section class="homepage_body_wrap pages"></section>',
							branch : { 
								home : { 
									self   :'<div class="homepage_body_inner_wrap"></div>',
									branch : {
										info_title : { 
											self   : '<div class="homepage_how_it_works_option_title_wrap"></div>',
											branch : {
												title : {
													self   : '<div class="homepage_how_it_works_option_title"></div>',
													last_branch : {
														part_one : '<span class="homepage_how_it_works_option_title_part_one">Free</span>',
														part_two : '<span class="homepage_how_it_works_option_title_part_two">post</span>',
													}
												}
											}
										},
										info_numbers : {
											self   : '<div class="homepage_how_it_works_boxes_numbers_wrap"></div>',
											last_branch : {
												one : '<div class="with-icon-homepage-how-it-works-box-number-one"></div>',
												two : '<div class="with-icon-homepage-how-it-works-box-number-two"></div>',
												three : '<div class="with-icon-homepage-how-it-works-box-number-three"></div>'
											}
										},
										info_boxes : {
											self   : '<div class="homepage_how_it_works_boxes_wrap"></div>',
											branch : {
												first : {
													self   : '<div class="homepage_how_it_works_box_wrap_first"></div>',
													branch : {
														content : {
															self   : '<div class="homepage_how_it_works_box homepage_how_it_works_box_first"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title">Find Your Books</div>',
																		text  :'<div class="homepage_how_it_works_text">find your books and add them to your sell basket</div>'
																	}
																},
																image : {
																	self : '<img src="'+ frameworkuri +'/CSS/Includes/works/type.png" class="homepage_how_it_works_box_first_image">'
																}
															}
														},
														arrows : {
															self   : '<div class="homepage_arrows_warp"></div>',
															last_branch : {
																part_one   : '<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>',
																part_two   : '<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>',
																part_three : '<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>'
															}
														}
													}
												},
												second : {
													self   : '<div class="homepage_how_it_works_box_wrap_second"></div>',
													branch : {
														content : {
															self   :'<div class="homepage_how_it_works_box_second"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title">Freepost<br/>Your Books</div>',
																		text  :'<div class="homepage_how_it_works_text">we send you a freepost pack and you send us your books</div>'
																	}
																},
																image : {
																	self : '<img  src="'+frameworkuri+'/CSS/Includes/works/letter.png" class="homepage_how_it_works_box_second_image">'
																}
															}
														},
														arrows : {
															self   : '<div class="homepage_arrows_warp"></div>',
															last_branch : {
																part_one   : '<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>',
																part_two   : '<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>',
																part_three : '<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>'
															}
														}
													}
												},
												third : {
													self   : '<div class="homepage_how_it_works_box_wrap_last"></div>',
													branch : {
														content : {
															self   : '<div class="homepage_how_it_works_box homepage_how_it_works_box_last"></div>',
															branch : {
																text : {
																	self   : '<div class="homepage_how_it_works_box_text_wrap"></div>',
																	last_branch : {
																		title : '<div class="homepage_how_it_works_box_title"><br/>Get Paid</div>',
																		text  :'<div class="homepage_how_it_works_text">we send you a cheque the same day we receive your books</div>'
																	}
																},
																image : {
																	self : '<img src="'+frameworkuri+'/CSS/Includes/works/check.png" class="homepage_how_it_works_box_third_image">'
																}
															}
														}
													}
												}
											}
										},
										info_buttons : {
											self   : '<div class="homepage_how_it_works_boxes_buttons_wrap"></div>',
											branch : { 	
												button_one : {
													self   :  '<div class="homepage_how_it_works_box_first_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div id="where_is_my_isbn_trigger" class="homepage_how_it_works_box_button">Where is My ISBN </div>',
															last_branch : {
																arrow :  '<span id="where_is_my_isbn_trigger" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="where_is_my_isbn_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																image :  '<img src="'+frameworkuri+'/CSS/Includes/works/where_is_my_isbn.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">',
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text">Just look at the back of your book and find the 13 or 9 digit number bellow.</div>'
															}
														}
													}
												},
												button_two : {
													self   :  '<div class="homepage_how_it_works_box_second_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">Freepost Options</div>',
															last_branch : {
																arrow :  '<span id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="freepost_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph_one   :  '<div class="homepage_how_it_works_box_button_expanded_text">We\'ll send you a postage pack. You\'ll get a <strong>mailing bag</strong> with our freepost address sticker attached, so you won’t pay a penny to post your books to Recyclabook.</div>',
																paragraph_two   :  '<div class="homepage_how_it_works_box_button_expanded_text_highlight">or</div>',
																paragraph_three :  '<div class="homepage_how_it_works_box_button_expanded_text">If you have your own <strong>packaging</strong>, you can print off our own packaging label from this website. <strong>This will reduce the turnaround time of the order to give you peace of mind, while ensuring you get your payment even faster!</strong></div>',
																image           :  '<img src="'+frameworkuri+'/CSS/Includes/works/freepost_options.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">'				
															}
														}
													}
												},
												button_three : {
													self   :  '<div class="homepage_how_it_works_box_third_button_wrap"></div>',
													branch : { 
														trigger : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( this.trigger.instructions.open ) {
																			this.trigger.instructions.open = false;
																			this.text_box.self.css({ display : "none" });
																		} else { 
																			this.trigger.instructions.open = true;
																			this.text_box.self.css({ display : "block" });
																		}
																	}
																}
															},
															self :  '<div  id="paid_trigger" class="homepage_how_it_works_last_box_button">How Am I Being Paid?</div>',
															last_branch : {
																arrow : '<span id="paid_trigger" class="with-icon-down-arrow-for-how-it-works-button"></span>' 
															}
														},
														text_box  : {
															self :  '<div id="paid_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text"><strong>Don’t</strong> worry about filling in your bank details. We\'ll send you a cheque on the same day we receive your books.</div>'
															}
														}
													}
												}
											}
										},
									}
								}
							}
						},
						sell : {
							self : '<section class="body pages"></section>',
							branch : {	
								basket : {
									self   : '<div class="search_books_description_title"></div>',
									branch : {
										icon : {
											self : '<span class="with-icon-description-title-thumbs-up"></span>'
										},
										promotional_text : {
											self : '<span class="search_books_description_title_text">Our price promise guaranteed</span>'
										},
										basket_box : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.invisible_popup.open = true;
														state.invisible_popup.box  = "basket";
													}
												}
											},
											self   : '<div class="sell_and_buy_basket"></div>',
											branch : {
												stats : { 
													self   : '<div id="buy_basket" class="basket_stats"></div>',
													branch : {
														pig : {
															self : '<span class="with-icon-sell-basket-piggy"> Basket :</span>'
														},
														quote : {
															instructions : {
																observe : {
																	who      : book,
																	property : "basket",
																	call     : function (change) { 
																		this.self.text(change.new.length);
																	}
																}
															},
															self : '<span class="with-icon-sell-basket-number"> 0</span>'
														}
													}
												}
											}
										}
									}
								},
								items : {
									instructions : {
										on : {
											the_event : "click",
											is_asslep : false,
											call      : function (change) {

												var current_book, part, id, promises;

												if ( change.event.target.className === "with-icon-info-for-book" ) {
													id                     = change.event.target.getAttribute("data-type-book");
													current_book           = book.results[id-1];
													for ( part in state.viewed_item.parts ) state.viewed_item.parts[part] = current_book[part];
													state.viewed_item.book = current_book;
													state.viewed_item.show = true;
												}

												if ( change.event.target.className === "result_book_add_button_text" || 
													 change.event.target.className === "result_book_added_book_add_again_button" ) {		
													id                     = change.event.target.getAttribute("data-type-book");
													current_book           = book.results[id-1];
													promises               = book.basket;
													promises.push(current_book);
													book.basket            = promises;
												}

												if ( change.event.target.className === "result_book_added_book_add_again_button" ) {

													var button, button_wrap, number_of_buttons, move_top_by, last_child_class, used_class

													button_wrap       = $('.result_book_inner_wrap')
													number_of_buttons = $('.result_book_inner_wrap').children().length
													last_child_class  = button_wrap.children().last().attr("class")
													used_class        = ( last_child_class === "result_book_add_button_static" ? "result_book_add_button_static_again" : "result_book_add_button_static" )
													move_top_by       = number_of_buttons * 45
													button            = '<div class="'+ used_class +'">'
													button           += '<span class="with-icon-added-to-sell-basket-tick">Added Again</span>'
													button           += '</div>'
													button_wrap.append(button)
													button_wrap.animate({ top : "-"+ move_top_by +"px" }, 400)
												}

												if ( change.event.target.className === "result_book_added_book_sell_button" ) {
													if ( book.basket.length === 0 ) return;
													(state.signed)? router.change_url("confirm") : router.change_url("confirm_sign_in");
												}

												if (  change.event.target.className === "result_book_add_button_text"  ) {
													$(change.event.target).closest('.result_book_inner_wrap').css({ position : "relative" }).animate({ top : "-45px" }, 400 );
													$(change.event.target).closest('.result_book_search').next().animate({ opacity : 1 }, 500);
												}
											}
										},
										observers : [
											{
												who      : book,
												property : "basket",
												call     : function (change) { 

													var is_gone = true 

													for (var index = 0; index < change.new.length; index++) { 
														if ( change.new[index].external_product_id === book.results[0].external_product_id ) {
															is_gone = false
														}
													}

													if ( is_gone === false ) return

													$('.result_book_inner_wrap').animate({ top : "0px" }, 400 )
													$('.result_book_search').next().animate({ opacity : 0 }, 500);

												}
											},
											{
												who      : book,
												property : "results",
												call     : function (change) {
													var wraps, book_string;

													wraps = {};
													wraps.on_wrap = 0;
													wraps.classes = [
														"result_book_search_wrapper_left", 
														"result_book_search_wrapper", 
														"result_book_search_wrapper_right"
													];
													book_string = "";
														

													for (index = 0; index < book.results.length; index++) {

														book_string +=
															'<div class="'+ wraps.classes[wraps.on_wrap] +'">'+
																'<div class="result_book_search">';
														if ( book.results[index].standard_price ) book_string += 
																	'<span data-type-book="'+ ( index + 1 ) +'" class="with-icon-info-for-book">'+'</span>';
														book_string +=
																	'<img src="'+ book.results[index].main_image_url +'" class="result_book_thumbnail_image">'+
																	'<article class="result_book_search_text">'+ 				
																		'<strong class="result_book_title">'+ book.results[index].item_name.slice(0, 10) +'...</strong>'+
																		'<div class="result_book_author">'+   book.results[index].author.slice(0, 18)    +'...</div>'+
																		'<div class="result_book_price_wrap">'+
																			'<span class="result_book_price_text">Sell for </span>'+
																			'<storng class="result_book_price">'+ book.results[index].standard_price +'</storng>'+
																		'</div>'+
																	'</article>';
														if ( book.results[index].standard_price ) book_string += 
																	'<div class="result_book_add_button_wrap">'+
																		'<div class="result_book_inner_wrap">'+
																			'<div class="result_book_add_button">'+
																				'<span data-type-book="'+ ( index + 1 ) +'" class="result_book_add_button_text">Add To Sell Basket</span>'+
																			'</div>'+
																			'<div class="result_book_add_button_static">'+
																				'<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'+
																			'</div>'+
																		'</div>'+
																	'</div>';
														if ( ! book.results[index].standard_price ) book_string += 
																	'<div class="result_book_add_button_wrap">'+
																		'<div class="result_book_inner_wrap">'+
																			'<div class="result_book_add_button_static">'+
																				'<span class="result_book_refused_button">We dont accept this book</span>'+
																			'</div>'+
																		'</div>'+
																	'</div>';
														book_string += 
																'</div>';
														if ( book.results[index].standard_price ) book_string += 
																'<div class="result_book_extra_options_buttons">'+
																	'<span class="result_book_added_book_sell_button">'+
																		'<span class="with-icon-sell-now-arrow"></span>'+ 
																			'Sell now?'+
																		'</span>'+
																	'<span data-type-book="'+ ( index + 1 ) +'" class="result_book_added_book_add_again_button">'+
																		'<span class="with-icon-add-again"></span>'+
																			'Add again'+ 
																		'</span>'+
																'</div>';
														book_string += 
															'</div>';
														( wraps.on_wrap === 2? wraps.on_wrap = 0 : wraps.on_wrap++ );
													};

													if (change.new.length === 0) book_string = "<div class=\"reslt_not_found\">Sorry we dont accept this book</div>";
													this.self.empty();
													this.self[0].insertAdjacentHTML("afterbegin", book_string);
													this.self.css({ top : "800px"});
													this.self.animate({ top : "0px" }, 900);
												}
											}
										]
									},
									self : '<div class="result_books"></div>',
								}
							}			
						},
						item : {
							instructions : {
								observe : {
									who      : state.viewed_item,
									property : "show",
									call     : function (change) { 
										var self = world.wrap.branch.item.self;

											if ( change.new ) {
												self.css({ display : "block" }).animate({ opacity : 1 }, 200 );
											} else { 
												self.animate({ opacity : 0 }, 300, function () {
													self.css({ display : "none" });
												});
											}
									}
								}
							},
							self   : ' <div class="search_books_expanded_book_wrap"></div>',
							branch : {
								book : {
									instructions : {
										observe : {
											who      : state.viewed_item,
											property : "show",
											call     : function (change) { 
												var self = world.wrap.branch.item.branch.book.self;
													if ( change.new ) {
														self.animate({ top : "50px" }, 300);
													} else { 
														self.animate({ top : "-"+window.screen.availHeight+"px" }, 200);
													}
											}
										}
									},
									self   : '<div class="search_books_expanded_book"></div>',
									branch : {
										close : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														state.viewed_item.show = false;
													}
												}
											} ,
											self : '<span class="with-icon-info-close"></span>'
										},
										image_wrap : {
											self   : '<div class="search_books_expanded_image_wrap"></div>',
											branch : {
												image : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "main_image_url",
															call     : function (change) {
																this.self.attr("src", change.new);
															}
														}
													},
													self : '<img src="" class="search_books_expanded_image">'
												}
											}
										},
										books_text : {
											self   : '<div class="search_books_expanded_text"></div>',
											branch : {
												title : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "item_name",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="search_books_expanded_title"></div>'
												},
												author : { 
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "author",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self : '<div class="search_books_expanded_author"></div>'
												},
												isbn : { 
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "external_product_id",
															call     : function (change) { 
																this.self.text(change.new);
															}
														}
													},
													self   : '<div class="search_books_expanded_isbn"></div>'
												},
												quote : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "standard_price",
															call     : function (change) {
																this.self.text("£"+change.new);
															}
														}
													},
													self   : '<div class="search_books_expanded_book_price"></div>'
												},
												buttons : {
													self   : '<div class="search_books_expanded_book_add_to_sell_basket_wrap"></div>',
													branch : {
														inner : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		var promise = book.basket;
																			promise.push(state.viewed_item.book);
																			book.basket = promise;
																	}
																}
															},
															self   : '<div class="search_books_expanded_book_add_to_sell_basket_inner_wrap"></div>',
															branch : {
																add : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				change.self.animate({ top : "-49px", marginBottom : "-49px" }, 300);
																			}
																		},
																		observe : {
																			who      : state.viewed_item,
																			property : "show",
																			call     : function (change) { 
																				if ( !change.new ) this.self.css({ top : "0px", marginBottom : "0px" });
																			}
																		}
																	},
																	self   : '<div class="search_books_expanded_book_add_to_sell_basket_button"></div>',
																	branch : {
																		text : {
																			self : '<span class="search_books_expanded_book_add_to_sell_basket_button_text">Add To Basket</span>'
																		}
																	}
																},
																add_again : {
																	self   : '<div class="search_books_expanded_book_add_to_sell_basket_add_again_button"></div>',
																	branch : {
																		text : {
																			self : '<span class="with-icon-added-to-sell-basket-expanded-tick">Add Again?</span>'
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						},
						registration : {
							self   : '<section class="pages input_box_body_wrap account"></section>',
							branch : {
								wrap   : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.registration.branch.wrap.self,
													box    = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self,
													offset = box.height() + 20;
													if ( change.new === "register" ) wrap.animate({ top : offset+"px" });
													if ( change.new !== "register" ) wrap.css({ top : "800px" });
											}
										}
									},
									self   : '<div class="account_wrap"></div>',
									branch : {	
										placeholder : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.name_and_address.self;
														if ( change.new ) {
															self.css({ display : "block" });
														} else { 
															self.css({ display : "none" });
														}
													}
												}
											},
											self : '<div class="account_placeholder">You have been registered</div>'
										},									
										legend : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.legend.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="legend_wrap"></div>',
											branch : {
												green    : {
													self : '<div class="legend_mark_green">all fields required</div>'
												},
												incorrect : {
													self : '<div class="legend_mark_x_wrap"></div>',
													branch : {
														first_name : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>First Name is empty</span>'
																}
															}
														},
														last_name : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Second Name is empty</span>'
																}
															}
														},
														address : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Address is empty</span>'
																}
															}
														},
														post_code : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Post Code is empty</span>'
																}
															}
														},
														town : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Town is empty</span>'
																}
															}
														},
														area : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Area is empty</span>'
																}
															}
														},
														
														email : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Email is empty</span>'
																}
															}
														},
														password : {
															self : '<div id="" class="legend_mark_x_symbol"></div>',
															branch : {
																x    : 	{
																	self : '<span class="with-icon-x-for-legend"></span>'
																},
																text : 	{
																	self : '<span>Password is empty</span>'
																}
															}
														},
													}
												}
											}
										},
										name_and_address : { 
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.name_and_address.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="field_box_wrap"></div>',
											branch : {
												title : {
													self   : '<div class="field_box_title_wrap"></div>',
													last_branch : {
														icon  : '<div class="with-icon-leaf-one"></div>',
														title : '<div class="field_box_title">Adress Details.</div>'
													}
												},
												name : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title           : {
															self : '<div class="field_box_input_title">First Name and Last Name</div>'
														},
														name_input      : {
															instructions : {
																observers : [
																	{
																		who      : state.account,
																		property : "first_name",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.first_name = "First name too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.first_name = "First name empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.first_name = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "first_name",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.first_name;
																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.first_name = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="22" type="text" class="field_box_input" placeholder="First Name">'
														},
														not_valid       : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														last_name_input : {
															instructions : {
																observers : [
																	{
																		who      : state.account,
																		property : "second_name",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.last_name = "Last name too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.last_name = "Last name empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.last_name = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "last_name",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.last_name;
																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.second_name = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="22" type="text" class="field_box_input" placeholder="Second Name">'
														}
													}
												},
												address : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title  			 : {
															self : '<div class="field_box_input_title">Where shall we send your freepost pack?</div>'
														},
														address_input    : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "address",
																		call     : function (change) {
																			if ( change.new.length < 3 ) {
																				state.registration.address = "Address too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.address = "Address is empty";
																			}
																			if ( change.new.length > 2 ) {
																				state.registration.address = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "address",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.address;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].address = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="200" type="text" class="field_box_input" placeholder="House name or number">'
														},
														town_input       : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "town",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.town = "Town too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.town = "Town is empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.town = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "town",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.town;																				
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].town = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Town/City">'
														},
														area_input       : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "area",
																		call     : function (change) {
																			if ( change.new.length < 2 ) {
																				state.registration.area = "County too short";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.area = "County is empty";
																			}
																			if ( change.new.length > 1 ) {
																				state.registration.area = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "area",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.area;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].area = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="50" type="text" class="field_box_input" placeholder="County">'
														},
														post_code_input  : {
															instructions : {
																observers : [
																	{
																		who      : state.addresses[0],
																		property : "post_code",
																		call     : function (change) {
																			if ( change.new.length === 0 ) {
																				state.registration.post_code = "Post Code is empty";
																			}
																			if ( ( change.new.length < 6 || change.new.length > 7 ) && change.new.length !== 0 ) {
																				state.registration.post_code = "Invalid Post Code";
																			}
																			if (  change.new.length > 5 && change.new.length < 8 ) {
																				state.registration.post_code = true;
																			}
																		}
																	},
																	{
																		who      : state.registration,
																		property : "post_code",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.post_code;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].post_code = change.self.val().replace(/\s+/g, '');;
																	}
																}
															},
															self : '<input maxlength="8" type="text" class="field_box_input" placeholder="Post Code">'
														}
													}
												}
											}
										},
										password : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.password.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="field_box_wrap_left"></div>',
											branch : {
												title : {
													self   : '<div class="field_box_title_wrap"></div>',
													last_branch : {
														icon  : '<div class="with-icon-leaf-two"></div>',
														title : '<div class="field_box_title">Login Details.*</div>'
													}
												},
												email : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title 				: {
															self : '<div class="field_box_input_title">Email address</div>'
														},
														emai_input          : {
															instructions : {
																observers : [
																	{
																		who      : state.registration.email,
																		property : "match",
																		call     : function (change) {

																			if ( change.new !== state.account.email ) {
																				state.registration.email.text = "Emails do not match";
																			} else { 
																				$.get(ajaxurl,{ 
																					action     : "get_account",
																					method     : "is_email_in_use",
																					paramaters : {
																						email : state.account.email,
																					}
																				}, function (response) { 
																					if ( response.return ) {
																						state.registration.email.unique = false;
																						state.registration.email.text   = "Email is in use";
																					} else { 
																						state.registration.email.unique = true;
																						state.registration.email.text   = true;
																					}
																				}, "json");
																			}
																		}
																	},
																	{
																		who      : state.account,
																		property : "email",
																		call     : function (change) {

																			if ( change.new.length === 0 ) {
																				state.registration.email.size = false;
																				state.registration.email.text = "Email is empty";
																			}
																			if ( change.new.length < 5 || change.new.search("@") === -1 ) { 
																				state.registration.email.size = false;
																				state.registration.email.text = "Invalid Email";
																			}
																			if ( change.new.length > 4 && change.new.search("@") !== -1 ) {
																				state.registration.email.size = true;
																			}
																		}
																	},
																	{
																		who      : state.registration.email,
																		property : "text",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.email;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Email address">'
														},
														not_valid           : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														confirm_email_input : {
															instructions : {
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.email.match = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="text" class="field_box_input" placeholder="Confrim">'
														}
													}						
												},
												password : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title          		   : {
															self : '<div class="field_box_input_title">Password</div>'
														},
														password 		       : {
															instructions : {
																observers : [
																	{
																		who      : state.registration.password,
																		property : "match",
																		call     : function (change) {

																			if ( change.new !== state.account.password ) {
																				state.registration.password.text = "Passwords do not match";
																			} else { 
																				state.registration.password.text = true;
																			}
																		}
																	},
																	{
																		who      : state.account,
																		property : "password",
																		call     : function (change) {

																			if ( change.new.length < 6 ) {
																				state.registration.password.size = false;
																				state.registration.password.text = "Password must be over five characters";
																			}
																			if ( change.new.length === 0 ) {
																				state.registration.password.size = false;
																				state.registration.password.text = "Password is empty";
																			}
																			if ( change.new.length > 6 ) {
																				state.registration.password.size = true;
																			}
																		}
																	},
																	{
																		who      : state.registration.password,
																		property : "text",
																		call     : function (change) {
																			var label = world.wrap.branch.registration.branch.wrap.branch.legend.branch.incorrect.branch.password;
																				( change.new === true )? label.self.css({ display : "none" }) : label.self.css({ display : "block" });
																				label.branch.text.self.text(change.new);
																		}
																	}
																],
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.password = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="password" class="field_box_input" placeholder="Password">'
														},
														not_valid      		   : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														password_input_confirm : {
															instructions : {
																on : {
																	the_event : "blur",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.password.match = change.self.val().trim();
																	}
																}
															},
															self : '<input maxlength="30" type="password" class="field_box_input" placeholder="Confirm">'
														}
													}
												}
											}
										},
										disclaimer : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var self = world.wrap.branch.registration.branch.wrap.branch.disclaimer.self;
														if ( change.new ) {
															self.css({ display : "none" });
														} else { 
															self.css({ display : "block" });
														}
													}
												}
											},
											self   : '<div class="input_box_disclaimer"></div>',
											branch : {
												tick : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																if ( state.account.recieve_newsletter === 1 ) {
																	state.account.recieve_newsletter = 0;
																	this.tick.branch.tick.self.css({ display : "none" });
																} else {
																	state.account.recieve_newsletter = 1;
																	this.tick.branch.tick.self.css({ display : "inline" });
																}
															}
														}
													},
													self   : '<div class="input_box_disclaimer_box"></div>',
													branch : {
														tick : {					
															self : '<span class="with-icon-input-box-disclaimer-tick"></span>'
														}
													}
												},
												text_wrap : {
													self   : '<div class="input_box_disclaimer_text_wrap"></div>',
													branch : {
														text_one : {
															self : '<div class="input_box_disclaimer_text">If you don\'t want to receive emails with exclusive offers and competitions from Recyclabook and our friends then untick this</div>'
														},
														text_two : {
															self : '<div class="input_box_disclaimer_small">by pressing continue you agree to</div>'
														},
														link     : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		animate.pop.outside = "legal";
																	}
																}
															},
															self : '<div class="input_box_disclaimer_highlight">terms & conditions</div>'
														}
													}
												},
												continue_button : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 
																state.process.register = true;
															}
														}
													},
													self : '<div class="input_box_button">Continue</div>'
												}
											}
										}
									}
								}								
							}
						},
						confirm : {
							self : '<section class="checkout pages"></section>',
							branch : {
								wrap : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.confirm.branch.wrap.self,
													box    = world.wrap.branch.navigation.branch.wrap.branch.progress_popup.self,
													offset = box.height() + 50;
													if ( change.new === "confirm" ) wrap.animate({ top : offset+"px" }).css({ marginBottom : offset+"px" });
													if ( change.new !== "confirm" ) wrap.css({ top : "800px" });
											}
										}
									},
									self   : '<div class="checkout_wrap"></div>',
									branch : {
										confirmation_overview : {
											self   : '<div class="confirmation_overview"></div>',
											branch : {
												basket_overview : {
													self   : '<div class="basket_overview_outer_wrap"></div>',
													branch : {
														basket : {
															self   : '<div class="basket_overview_wrap"></div>',
															branch : {
																title : {
																	self : '<div class="basket_overview_title">Basket Overview</div>'
																},
																basket : {
																	instructions : {
																		scroll : false,
																		observe: {
																			who      : animate,
																			property : "scroll",
																			call     : function (change) { 
																				var basket = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.basket.branch.basket;
																				if ( change.new !== "confirm" ) return;
																				if ( !basket.instructions.scroll ) {
																					basket.self               = basket.self[0];
																					basket.branch.scroll.self = basket.branch.scroll.self[0];
																					basket.branch.scroll.branch.handle.self = basket.branch.scroll.branch.handle.self[0];
																					basket.branch.holder.self = basket.branch.holder.self[0];
																					basket.branch.holder.branch.inner.self  = basket.branch.holder.branch.inner.self[0];
																					basket.instructions.scroll = new alpha.scroll_bar({
																						self   : basket,
																						height : 182
																					});
																				} else { 
																					basket.instructions.scroll.calculate_scroll_data();
																				}
																			}
																		},
																	},
																	self   : '<div class="basket_overview_basket"></div>',
																	branch : {
																		holder : {
																			self : '<div class="basket_overview_items"></div>', 
																			branch : {
																			 	inner : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								if ( change.event.target.className === "with-icon-x-for-overview-item confirm_basket_remove" ) {
																									var basket, index;
																									index       = change.event.target.getAttribute("data-type-book");
																								 	basket      = book.basket;
																									basket.splice((index-1), 1);
																									book.basket = basket;
																								}
																							}
																						},
																						observers : [
																							{
																								who      : book,
																								property : "basket",
																								call     : function (change) { 
																									
																									var book_string, index, current_book;

																									book_string = "";

																									for ( index = 0; index < book.basket.length; index++ ) {
																										current_book  = book.basket[index];
																										book_string  += 
																											'<div class="basket_overview_item">'+
																												'<div data-type-book="'+ ( index + 1 )  +'" style="display:block;" class="with-icon-x-for-overview-item confirm_basket_remove"></div>'+
																												'<img class="basket_overview_item_thumbnail" src="'+  current_book.main_image_url +'">'+
																												'<div class="basket_overview_item_text_wrap">'+
																													'<div class="basket_overview_item_text_title"> '+ current_book.item_name        +'</div>'+
																													'<div class="basket_overview_item_text_author">'+ current_book.author           +'</div>'+
																													'<div class="basket_overview_item_isbn">       '+ current_book.external_product_id +'</div>'+
																												'</div>'+
																												'<div class="basket_overview_item_price_wrap">'+
																													'<div class="basket_overview_item_price_text">Sell for</div>'+
																													'<div class="basket_overview_item_price">'+ current_book.standard_price +'</div>'+
																												'</div>'+
																											'</div>';
																									};
																									this.self.empty();
																									this.self[0].insertAdjacentHTML("afterbegin", book_string );
																								}
																							}
																						],
																					},
																			 		self : '<div class="basket_overview_items_wrap"></div>'
																			 	}
																			}
																		},
																		scroll : {
																			self   : '<div class="basket_overview_bar"></div>',
																			branch : {
																				handle : {
																					self : '<div class="basket_overview_bar_block"></div>'
																				}
																			}
																		}	
																	}
																},
															}
														},
														total : {
															self  : '<div class="basket_overview_total_wrap"></div>',
															branch : {
																total : {
																	instructions : {
																		observe : {
																			who      : book,
																			property : "basket",
																			call     : function (change) { 
																				var quote = 0;
																				for (var index = 0; index < change.new.length; index++) quote += parseFloat( change.new[index].standard_price );
																				this.self.text("£"+ quote.toFixed(2));
																			}
																		}
																	},
																	self : '<div class="basket_overview_total"></div>'
																},
																text  : {
																	self : '<div class="basket_overview_total_text">Total Sale: </div>'
																}
															}
														}
													}
												},
												address_overview : {
													self   : '<div class="address_overview_wrap_outer"></div>',
													branch : { 
														address : {
															self   : '<div class="address_overview_wrap"></div>',
															branch : {
																title : {
																	self : '<div class="address_overview_title">Address Confirmation</div>'
																},
																inputs : {
																	self   : '<div class="address_overview_inputs"></div>',
																	branch : {
																		address  : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].address = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "address",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.address.self;
																								input.val(change.new);
																								console.log(input);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.address.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Address">'
																		},
																		town     : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].town = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "town",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.town.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.town.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Town">'
																		},
																		area     : {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].area = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "area",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.area.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.area.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input" value="Area">'
																		},
																		post_code: {
																			instructions : {
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].post_code = change.self.val();
																					}
																				},
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "post_code",
																						call    : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.post_code.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state.edit,
																						property : "confirm",
																						call     : function (change) {
																							var input = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.address_overview.branch.address.branch.inputs.branch.post_code.self;
																								input.attr("readonly", (!state.edit.confirm));
																						}
																					}
																				],
																			},
																			self : '<input readonly class="address_overview_input_small" value="Post Code">'
																		}
																	}
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		if ( state.edit.confirm ) {
																			state.save_address = true;
																			change.self.text("Edit Address");
																			state.edit.confirm = false;
																		} else { 
																			change.self.text("Save Edit");
																			state.edit.confirm = true;
																		}
																	}
																}
															},
															self : '<div class="address_overview_edit">Edit Address</div>'
														}
													}
												}
											}
										},
										choice_wrap : {
											self   : '<div class="how_would_you_like_wrap"></div>',
											branch : {
												title : {
													self : '<div class="how_would_you_like_title">How would you like to send your books?</div>'
												},
												titles_tab : {
													self   : '<div class="how_would_you_like_titles_wrap"></div>',
													branch : {
														tab_one : {
															instructions : {
																observe : {
																	who      : animate,
																	property : "state",
																	call     : function (change) { 
																		if ( change.new === "confirm" ) {
																			state.confirm.tab     = 0;
																			state.confirm.postage = "letter";
																		}
																	}
																},
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.confirm.tab = 0;
																	}
																}
															},
															self : '<div class="how_would_you_like_tab_title_active">We send you a freepost pack</div>'
														},
														tab_two : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) {
																		state.confirm.tab = 1;	
																	}
																}
															},
															self : '<div class="how_would_you_like_tab_title">Use your own postage with freepost code</div>'
														}
													}
												},
												tabs : {
													self   : '<div class="how_would_you_like_tab_wrap"></div>',
													branch : {
														tab_one : {
															instructions : {
																observe : {
																	who      : state.confirm,
																	property : "tab",
																	call     : function (change) {
																		var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_one.self;
																		if ( change.new === 0 ) {
																			self.css({ display : "block" });
																		} else {
																			self.css({ display : "none" });
																		}
																	}
																}
															},
															self   : '<div class="how_would_you_like_we_send_dark_tab"></div>',
															branch : {
																image : {
																	self : '<img class="we_send_freepost_tab_image" src="'+ frameworkuri +'/CSS/Includes/works/freepost_send.png">'
																},
																text : {
																	self   : '<div class="we_send_freepost_tab_text_wrap"></div>',
																	branch : {
																		text : {
																			self   : '<ul class="we_send_freepost_tab_text"></ul>',
																			last_branch : {
																				paragraph_one   : '<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>',
																				paragraph_two   : '<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>',
																				paragraph_three : '<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>'
																			}
																		},
																		check : {
																			self   : '<div class="we_send_freepost_tab_tick_button"></div>',
																			branch : {
																				tick : {
																					instructions : {
																						observe : {
																							who     : state.confirm,
																							property: "postage",
																							call    : function (change) {
																								if ( !change.new ) return;
																								
																								var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_one.branch.text.branch.check.branch.tick.self;
																									if ( change.new === "letter" ) {
																										self.attr("class", "with-icon-we-checkout-tick" );
																									} else {
																										self.attr("class", "with-icon-we-checkout-tick-unticked" );
																									}
																							}
																						},
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								state.confirm.postage = "letter";
																							}
																						}
																					},
																					self : '<div class="with-icon-we-checkout-tick"></div>'
																				},
																				text : {
																					self : '<div class="we_send_freepost_tab_tick_button_text">I want this option</div>'
																				}
																			}
																		}
																	}
																}														
															}													
														},
														tab_two : {
															instructions : {
																observe : {
																	who      : state.confirm,
																	property : "tab",
																	call     : function (change) {
																		var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_two.self;
																		if ( change.new === 1 ) {
																			self.css({ display : "block" });
																		} else {
																			self.css({ display : "none" });
																		}
																	}
																}
															},
															self   : '<div class="how_would_you_like_we_send_light_tab"></div>',
															branch : {
																image : {
																	self : '<img class="we_send_freepost_tab_image" src="'+ frameworkuri +'/CSS/Includes/works/print.png">'
																},
																text : {
																	self   : '<div class="we_send_freepost_tab_text_wrap"></div>',
																	branch : {
																		text : {
																			self   : '<ul class="we_send_freepost_tab_text"></ul>',
																			last_branch : {
																				paragraph_one   : '<li class="we_send_freepost_tab_paragraph">Select this option if your are using your own packaging material or if you already have a Recyclabook freepost envelope.</li>',
																				paragraph_two   : '<li class="we_send_freepost_tab_paragraph">If you are using your own packaging material, <strong>print the freepost label</strong>,<strong>stick it on the package</strong>, then <strong>post your books</strong></li>',
																				paragraph_three : '<li class="we_send_freepost_tab_paragraph">If you are using a Recyclabook Freepost Envelope, write your user id in space provided (send via email once you have pressed continue) and then post your books.</li>'
																			}
																		},
																		check : {
																			self   : '<div class="we_send_freepost_tab_tick_button"></div>',
																			branch : {
																				tick : {
																					instructions : {
																						observe : {
																							who     : state.confirm,
																							property: "postage",
																							call    : function (change) {
																								if ( !change.new ) return;
																								
																								var self = world.wrap.branch.confirm.branch.wrap.branch.choice_wrap.branch.tabs.branch.tab_two.branch.text.branch.check.branch.tick.self;
																									if ( change.new === "own" ) {
																										self.attr("class", "with-icon-we-checkout-dark-tick" );
																									} else {
																										self.attr("class", "with-icon-we-checkout-dark-tick-unticked" );
																									}
																							}
																						},
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								state.confirm.postage = "own";
																							}
																						}
																					},
																					self : '<div class="with-icon-we-checkout-dark-tick-unticked"></div>'
																				},
																				text : {
																					self : '<div class="we_send_freepost_tab_tick_button_text">I want this option</div>'
																				}
																			}
																		}
																	}
																}														
															}													
														}
													}
												},
												button : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 
																if ( state.confirm.postage === "letter" ) {
 																	state.give_freepost = true;
																} else { 
 																	state.give_print_your_own = true;
 																}
																state.give_price_promise = true;
 																router.change_url("done");
															}
														}
													},
													self : '<div class="checkout_button">Confirm & Complete</div>'
												}
											}
										}
									}
								}
							}	
						},
						thank_you : {
							self   : '<section class="thank_you pages"></section>',
							branch : {
								banner : {
									instructions : { 
										observe : {
											who : animate,
											property : "state",
											call : function (change) {
												var wrap   = world.wrap.branch.thank_you.branch.banner.self;
													if ( change.new === "done" ) {
														setTimeout( function () {
															wrap.css({ display : "block" }).animate({ top : "0px" }, 1000);
														}, 500 );
													} else {
														if ( change.new !== "done" ) wrap.css({ top : "-410px", display : "none" });
													}
											}
										}
									},
									self   : '<div class="thank_you_banner_wrap"></div>',
									branch : {					
										inner_banner : {
											self   : '<div class="thank_you_banner"></div>',
											branch : {
												leaf : { 
													self : '<div class="with-icon-thank-you-icon-leaf"></div>'
												},
												title_one : {
													self :'<div class="thank_you_banner_title_one">Thank you </div>'
												},
												title_two : {
													self : '<div class="thank_you_banner_title_two">For using recyclabook</div>'
												},
												print_your_own : {
													instructions : {
														observe : {
															who     : state.confirm,
															property: "postage",
															call    : function (change) {
																if ( !change.new ) return;
																
																var self = world.wrap.branch.thank_you.branch.banner.branch.inner_banner.branch.print_your_own.self;
																	if ( change.new === "own" ) {
																		self.css({ display : "block" });
																	} else {
																		self.css({ display : "none" });
																	}
															}
														}
													},
													self : '<div style="display:none" class="thank_you_banner_paragraph">You have chosen to send your books to us using your own packaging, <a class="thank_you_banner_paragraph_link" target="blank" data-dont-route="true" href="http://www.recyclabook.co.uk/packaging_label.pdf">here is a link</a> to the label which you need to print out.</div>'
												},
												paragraph : {
													self : '<div class="thank_you_banner_paragraph">We\'ll be waiting for your books to arrive, in the meantime, <a class="thank_you_banner_paragraph_link" href="hub">you have an account now</a>. You can login and track the books and payments anytime and request more freepost packs.</div>'
												}
											}
										},
										bottom : {
											self : '<div class="with-icon-thank-you-bottom-arrow"></div>'
										}
									}
								},
								circle : {
									self   :'<div class="thank_you_circle_wrap"></div>',
									branch : {
										corn : {
											self :'<div class="with-icon-thank-you-corn"></div>'
										},
										text : {
											self   : '<div class="thank_you_circle_text_wrap"></div>',
											last_branch : {
												header : '<div class="thank_you_circle_text_header">RAG</div>',
												text   : '<div class="thank_you_circle_text">we also make it easy for you to donate directly to your University\'s RAG</div>		'
											}
										}
									}
								},
								icon : {
									self : '<div class="with-icon-your-account"></div>'
								}
							}
						},
						hub : {
							self : '<section class="profile_hub pages"></section>',
							branch : { 
								wrap : {
									self : '<div class="profile_hub_inner_wrap"></div>',
									branch : {
										header : { 
											self : '<div class="profile_hub_header"></div>',
											last_branch : {
												title : '<div class="profile_hub_header_title">Profile Hub</div>',
												text  : '<div class="profile_hub_header_text">For withdrawals, tracking, order history and editing account details</div>'
											}
										},
										left_boxes : {
											self : '<div class="profile_hub_left_boxes_wrap"></div>',
											branch : {
												account : {
													self : '<div class="profile_hub_account profile_hub_box"></div>',
													branch : {
														bar : {
															self : '<div class="profile_hub_account_bar"></div>',
															branch : {
																icon : {
																	self : '<div class="with-icon-profile-hub-account"></div>'
																},
																greeting : {
																	instructions : {
																		observe : {
																			who     : state.account,
																			property: "first_name",
																			call    : function (change) {
																				if ( state.edit_account ) return;
																					var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.bar.branch.greeting.self;
																					input.text("Hi, "+ change.new);
																			}
																		}
																	},
																	self : '<div class="profile_hub_account_bar_greeting"></div>'
																},
																text : {
																	self : '<div class="profile_hub_account_bar_text">Account Details</div>'
																}
															}
														},
														body : {
															self : '<div class="profile_hub_account_body"></div>',
															branch : {
																main_details : {
																	self : '<div class="profile_hub_account_main_details"></div>',
																	branch : {
																		first_name : {
																			instructions : {
																				observers : [
																					{
																						who     : state.account,
																						property: "first_name",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.first_name.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.first_name.self;
																								input.attr("readonly", (!state.edit_account));

																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.account.first_name = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		second_name: {
																			instructions : {
																				observers : [
																					{
																						who     : state.account,
																						property: "second_name",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.second_name.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.second_name.self;
																								input.attr("readonly", (!state.edit_account));

																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.account.second_name = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		address : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "address",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.address.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.address.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].address = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_large_input" readonly>'
																		},
																		town : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "town",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.town.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.town.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].town = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		area : {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "area",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.area.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.area.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].area = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		},
																		post_code: {
																			instructions : {
																				observers : [
																					{
																						who     : state.addresses[0],
																						property: "post_code",
																						call    : function (change) {
																							if ( state.edit_account ) return;
																								var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.post_code.self;
																								input.val(change.new);
																						}
																					},
																					{
																						who      : state,
																						property : "edit_account",
																						call     : function (change) {
																							var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.main_details.branch.post_code.self;
																								input.attr("readonly", (!state.edit_account));
																						}
																					}
																				],
																				on : {
																					the_event : "keyup",
																					is_asslep : false,
																					call      : function (change) {
																						state.addresses[0].post_code = change.self.val();
																					}
																				}
																			},
																			self : '<input type="text" class="profile_hub_account_main_details_small_input" readonly>'
																		}
																	}
																},
																extra_details : {
																	self : '<div class="profile_hub_account_extra_details"></div>',
																	branch : {
																		email : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Registered email</div>'
																				},
																				input : {
																					instructions : {
																						observe : {
																							who     : state.account,
																							property: "email",
																							call    : function (change) {
																								if ( state.edit_account ) return;
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.email.branch.input.self;
																									input.val(change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		password : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Password</div>'
																				},
																				input : {
																					instructions : {
																						observe : {
																							who     : state.account,
																							property: "password",
																							call    : function (change) {
																								if ( state.edit_account ) return;
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.password.branch.input.self;
																									input.val(change.new);
																							}
																						}
																					},
																					self : '<input type="password" class="profile_hub_account_extra_details_input" readonly>'
																				},
																				edit : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "reset";
																							}
																						}
																					},
																					self : "<div class=\"profile_hub_account_extra_details_edit\">change</div>"
																				}
																			}
																		},
																		university : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">University</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "university",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.university.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.university.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.university = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		year : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Year</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "year",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.year.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.year.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.year = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},
																		subject : {
																			self : "<div class=\"profile_hub_account_detail_wrap\"></div>",
																			branch : {
																				label : {
																					self : '<div class="profile_hub_account_extra_details_title">Subject</div>'
																				},
																				input : {
																					instructions : {
																						observers : [
																							{
																								who     : state.account,
																								property: "subject",
																								call    : function (change) {
																									if ( state.edit_account ) return;
																										var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.subject.branch.input.self;
																										input.val(change.new);
																								}
																							},
																							{
																								who      : state,
																								property : "edit_account",
																								call     : function (change) {
																									var input = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.branch.subject.branch.input.self;
																										input.attr("readonly", (!state.edit_account));

																								}
																							}
																						],
																						on : {
																							the_event : "keyup",
																							is_asslep : false,
																							call      : function (change) {
																								state.account.subject = change.self.val();
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_account_extra_details_input" readonly>'
																				}
																			}
																		},

																	}
																},
																buttons : {
																	self   : '<div class="profile_hub_account_extra_buttons"></div>',
																	branch : { 
																		more_fields : {
																			instructions : {
																				open : false,
																				on : { 
																					the_event : "click", 
																					is_asslep : false,
																					call      : function (change) {
																						var details = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.self;
																							if ( this.more_fields.instructions.open ) {
																								details.css({ display : "none" });
																								this.more_fields.branch.icon.self.attr("class", "with-icon-plus-for-profile-hub-account-extra-buttons");
																								this.more_fields.instructions.open = false;
																							}
																							else { 
																								details.css({ display : "block" });
																								this.more_fields.branch.icon.self.attr("class", "with-icon-minus-for-profile-hub-account-extra-buttons");
																								this.more_fields.instructions.open = true;
																							}
																					}
																				}
																			},
																			self : '<div class="profile_hub_account_extra_buttons_small_button"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-plus-for-profile-hub-account-extra-buttons"></div>'
																				}
																			}
																		},
																		edit : {
																			instructions : {
																				on : {
																					the_event : "click",
																					is_asslep : false,
																					call      : function (change) { 
																						var details = world.wrap.branch.hub.branch.wrap.branch.left_boxes.branch.account.branch.body.branch.extra_details.self;
																							if ( state.edit_account ) { 
																								change.self.text("Edit Account Details");
																								state.edit_account = false;
																								state.save_account = true;
																							} else { 
																								change.self.text("Save Account Details");
																								state.edit_account = true;
																								state.save_account = false;
																							}
																					}
																				}
																			},
																			self : '<div class="profile_hub_account_extra_buttons_large_button">Edit Account Details</div>'
																		}
																	}
																}
															}
														}
													}
												},
												// history : {
												// 	self : '<div class="profile_hub_history profile_hub_box"></div>',
												// 	branch : {
												// 		bar : {
												// 			self : '<div class="profile_hub_history_bar"></div>',
												// 			last_branch : {
												// 				icon : '<div class="with-icon-for-profile-hub-history"></div>',
												// 				greeting : '<div class="profile_hub_history_bar_greeting">Order History</div>',
												// 				notification : '<div class="profile_hub_history_notification"></div>'
												// 			}
												// 		},
												// 		body : {
												// 			self : '<div class="profile_hub_history_body"></div>',
												// 			branch : {
												// 				inner : {
												// 					self : '<div class="profile_hub_history_inner_body"></div>',
												// 					branch : {
												// 						sroll : {
												// 							self : '<div class="profile_hub_history_scroll"></div>',
												// 							last_branch : {
												// 								handle : '<div class="profile_hub_history_scroll_handle"></div>'
												// 							}
												// 						},
												// 						items : {
												// 							self :'<div class="profile_hub_history_items"></div>'
												// 						}
												// 					}
												// 				}
												// 			}
												// 		}
												// 	}
												// }
											}				
										},
										right_boxes : {
											self : '<div class="profile_hub_right_boxes_wrap"></div>',
											branch : {
												// bank : {
												// 	self : '<div class="profile_hub_bank profile_hub_box_right"></div>',
												// 	branch : {
												// 		bar : {
												// 			self : '<div class="profile_hub_bank_bar"></div>',
												// 			branch : {
												// 				icon : { 
												// 					instructions : {
												// 						open : false,
												// 						on : {
												// 							the_event : "click",
												// 							is_asslep : false,
												// 							call      : function () {
												// 								var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
												// 								if ( this.icon.instructions.open ) {
												// 									popup.css({ display : "none" });
												// 									this.icon.instructions.open = false;
												// 								} else { 
												// 									popup.css({ display : "block" });
												// 									this.icon.instructions.open = true;
												// 								}																				
												// 							}
												// 						}
												// 					},
												// 					self : '<div class="with-icon-for-profile-hub-bank"></div>'
												// 				},
												// 				greeting : {
												// 					self : '<div class="profile_hub_bank_greeting">RecyclaBank</div>'
												// 				}
												// 			}
												// 		},
												// 		information_box : {
												// 			self : '<div class="profile_hub_bank_info"></div>',
												// 			branch : {
												// 				title :    { 
												// 					self : '<div class="profile_hub_bank_info_title">Recyclabank</div>'
												// 				},
												// 				text :     { 
												// 					self : '<div class="profile_hub_bank_info_text">All money made from your book sales is conviniently stored in your bank, ready to be withdrawn at any time. Simply select withdraw funds, confirm the name and address of the cheque and we\'ll send it your way. You can also donate a portion of all your balance to your university RAG campagin.</div>'
												// 				},
												// 				close :    { 
												// 					instructions : {
												// 						on : {
												// 							the_event : "click", 
												// 							is_asslep : false,
												// 							call      : function (change) { 
												// 								var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
												// 								if ( world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open ) {
												// 									popup.css({ display : "none" });
												// 									world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = false;
												// 								} else { 
												// 									popup.css({ display : "block" });
												// 									world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = true;
												// 								}
												// 							}	
												// 						}
												// 					},
												// 					self : '<div class="with-icon-for-profile-hub-recyclabank-close"></div>'
												// 				}
												// 			}
												// 		},
												// 		body : {
												// 			self : '<div class="profile_hub_bank_body"></div>',
												// 			branch : {
												// 				stats : {
												// 					self : '<div class="profile_hub_bank_status"></div>',
												// 					branch : {
												// 						balance : {
												// 							self : '<div class="profile_hub_bank_stats_first"></div>',
												// 							branch : {
												// 								icon :  {
												// 									self : '<div class="with-icon-pig-for-account-balance"></div>'
												// 								},
												// 								label : {
												// 									self : '<div class="profile_hub_bank_stats_label">Account balance</div>'
												// 								},
												// 								input : {
												// 									instructions : { 
												// 										observe : { 
												// 											who      : state.account,
												// 											property : "credit",
												// 											call     : function (change) {	
												// 												var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.balance.branch.input.self;
												// 													self.val("£"+ change.new);
												// 											}
												// 										}
												// 									},
												// 									self : '<input type="text" class="profile_hub_bank_stats_input" value="£0.00" readonly>'
												// 								}
												// 							}
												// 						},
												// 						withdrawal : {
												// 							self   : '<div class="profile_hub_bank_stats_middle"></div>',
												// 							branch : {
												// 								icon : {
												// 									self : '<div class="with-icon-clock-for-account-withdrawal"></div>'
												// 								},
												// 								label: { 
												// 									self : '<div class="profile_hub_bank_stats_label">Last withdrawal</div>'
												// 								},
												// 								input: { 
												// 									instructions : { 
												// 										observe : { 
												// 											who      : state.account,
												// 											property : "last_withdraw",
												// 											call     : function (change) {	
												// 												var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.withdrawal.branch.input.self;
												// 												if ( change.new === "0000-00-00") {
												// 													self.val("never");
												// 												} else { 
												// 													self.val(change.new);
												// 												}
												// 											}
												// 										}
												// 									},
												// 									self : '<input type="text" class="profile_hub_bank_stats_input" value="never" readonly>'
												// 								}
												// 							}
												// 						},
												// 						donation : {
												// 							self   : '<div class="profile_hub_bank_stats_last"></div>',
												// 							branch : {
												// 								icon : {
												// 									self : '<div class="with-icon-hand-for-account-donation"></div>'
												// 								},
												// 								label: {
												// 									self : '<div class="profile_hub_bank_stats_label">Total Donations</div>'
												// 								},
												// 								input: {
												// 									instructions : { 
												// 										observe : { 
												// 											who      : state.account,
												// 											property : "donate",
												// 											call     : function (change) {	
												// 												var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.donation.branch.input.self;
												// 													self.val("£"+ change.new);
												// 											}
												// 										}
												// 									},
												// 									self : '<input type="text" class="profile_hub_bank_stats_input" value="£0.00" readonly>'
												// 								}
												// 							}
												// 						},
												// 						button : {
												// 							self : '<div class="profile_hub_bank_buttons"></div>',
												// 							branch : {
												// 								withdraw : {
												// 									instructions : {
												// 										on : {
												// 											the_event : "click",
												// 											is_asslep : false,
												// 											call      : function () { 
												// 												animate.popup = "withdraw";
												// 											}
												// 										}
												// 									},
												// 									self : '<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>'
												// 								},
												// 								donate : {
												// 									instructions : {
												// 										on : {
												// 											the_event : "click",
												// 											is_asslep : false,
												// 											call      : function () { 
												// 												animate.popup = "donate";
												// 											}
												// 										}
												// 									},
												// 									self : '<div class="with-icon-for-bank-donate">Donate to RAG</div>'
												// 								}
												// 							}
												// 						}
												// 					}
												// 				}
												// 			}
												// 		}
												// 	}
												// },
												tracking : {
													self : '<div class="profile_hub_tracking profile_hub_box_right"></div>',
													branch : {
														bar : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () { 
																		state.account.price_promise = test;
																	}
																}
															},
															self : '<div class="profile_hub_tracking_bar"></div>',
															branch : {
																icon : {
																	self : '<div class="with-icon-for-profile-hub-tracking"></div>'
																},
																title : {
																	self : '<div class="profile_hub_tracking_bar_title">Book Tracking</div>'
																},
																sort : {
																	self : '<div class="profile_hub_tracking_bar_sort"></div>',
																	branch : {
																		drop : {
																			self : '<div class="profile_hub_tracking_bar_sort_drop"></div>',
																			last_branch : {
																				drop_arrow : '<div class="with-icon-for-profile-hub-tracking-drop-arrow"></div>',
																				order_by   : '<div class="profile_hub_tracking_bar_sort_drop_item">Order By</div>'
																			},
																		}
																	},
																	eye_icon : {
																		self : '<div class="with-icon-eye-for-profile-hub-tracking"></div>'
																	},
																	arrow : {
																		self : '<div class="with-icon-down-arrow-for-profile-hub-drop"></div>'
																	}
																}
															}
														},
														body : {
															self : '<div class="profile_hub_tracking_body"></div>',
															branch : {
																show_bar : {
																	self : '<div class="profile_hub_tracking_show_bar"></div>',
																	branch : {
																		text : {
																			self : '<div class="profile_hub_tracking_show_bar_text">Showing all</div>'
																		},
																		send_freepost : {
																			self : '<div class="with-icon-for-profile-hub-tracking-envelope"></div>'
																		}
																	}
																},
																wrap : {
																	instructions : {
																		scroll : false,
																		observers : [
																			{
																				who      : animate,
																				property : "scroll",
																				call     : function (change) { 
																					if ( change.new !== "hub" ) return;
																					var basket = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.tracking.branch.body.branch.wrap;
																					if ( !basket.instructions.scroll ) {
																						basket.self               = basket.self[0];
																						basket.branch.scroll.self = basket.branch.scroll.self[0];
																						basket.branch.scroll.branch.handle.self = basket.branch.scroll.branch.handle.self[0];
																						basket.branch.holder.self = basket.branch.holder.self[0];
																						basket.branch.holder.branch.inner.self  = basket.branch.holder.branch.inner.self[0];
																					
																						basket.instructions.scroll = new alpha.scroll_bar({
																							self   : basket,
																							height : 300
																						});
																					} else { 
																						basket.instructions.scroll.calculate_scroll_data();
																					}
																				}
																			}
																		]
																	},
																	self : '<div class="profile_hub_tracking_inner_body"></div>',
																	branch : {
																		scroll : {
																			self : '<div class="profile_hub_tracking_sroll"></div>',
																			branch : {
																				handle : {
																					self : '<div class="profile_hub_tracking_sroll_handle"></div>'
																				}
																			}
																		},
																		holder : {																						
																			self : '<div class="profile_hub_tracking_items"></div>',
																			branch : {
																				inner : {
																					instructions : { 
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function (change) {
																								var id, promises; 

																								if ( change.event.target.className === "with-icon-for-profile-hub-tracking-remove-book" ) {

																									id       = change.event.target.getAttribute("data-type-book");
																									promises = state.account.price_promise;
																									promises.splice((id-1), 1);
																									state.account.price_promise = promises;
																									state.save_account          = true;
																								}
																							}
																						},
																						observe : {
																							who      : state.account,
																							property : "price_promise",
																							call     : function (change) {

																								if ( state.account.price_promise === null ) return;

																								var book_string, index, book;

																								book_string = "";

																								for (index = 0; index < state.account.price_promise.length; index++) {
																									state.account.price_promise[index].id = index;
																									book                                  = state.account.price_promise[index];
																									book_string                          += 
																									'<div class="profile_hub_tracking_item">'+
																										'<img src="'+ book.main_image_url +'" class="profile_hub_tracking_item_image">'+
																										'<div class="profile_hub_tracking_item_text">'+
																											'<div class="profile_hub_tracking_item_text_title">'+  book.item_name           +'</div>'+
																											'<div class="profile_hub_tracking_item_text_author">'+ book.author              +'</div>'+
																											'<div class="profile_hub_tracking_item_text_quote">'+  book.standard_price      +'</div>'+
																											'<div class="profile_hub_tracking_item_text_isbn">'+   book.external_product_id +'</div>'+
																										'</div>'+
																										'<div class="profile_hub_tracking_item_options">'+
																											'<img src="'+frameworkuri+'/CSS/Includes/works/profilehub/freepost.png" class="profile_hub_tracking_item_options_image">'+
																											'<div  data-type-book="'+ ( index + 1 ) +'" class="with-icon-for-profile-hub-tracking-remove-book">Remove book</div>'+
																										'</div>'+
																									'</div>';
																								};
																								
																								this.self.empty();
																								this.self[0].insertAdjacentHTML("afterbegin", book_string );
																							}
																						}
																					},
																					self : '<div class="profile_hub_tracking_items_inner"></div>'
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						},
					}
				},
			};

			world          = world.manifest($(append_to));
			router.begin();
			state.begin    = true;		

	}
})