<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
	<meta http-equiv="Content-Typse" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title>Recyclabook</title>

	<link rel="shortcut icon" href="<?php echo FRAMEWORKURI .'/CSS/Includes/Works/rfavicon.png'; ?>"/>
	
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<style type="text/css"><?php include FRAMEWORK .'/CSS/style-core.php'; ?></style>
		
	<!-- this creates the html5 elements in IE browsers below version 9 -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
	<?php wp_head(); ?>

	<script src="<?php echo FRAMEWORKURI .'/js/manifest/jquery.js'; ?>"></script>	
	<script src="<?php echo FRAMEWORKURI .'/scripts/mousewheel.jquery.js'; ?>"></script>
	<script src="<?php echo FRAMEWORKURI .'/js/manifest/alpha.js'; ?>"></script>

	<script>	  
	  	var scripts = "<?php echo FRAMEWORKURI .'/js'; ?>",
	  		frameworkuri = "<?php echo FRAMEWORKURI; ?>",
	  		ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		alpha.load_scripts_asynchronously_with_callback([
			scripts+'/manifest/manifest.alpha.js',
			scripts+'/manifest/observe.alpha.js',
			scripts+'/manifest/route.alpha.js',
			scripts+'/library/amazon.alpha.js',
			scripts+'/library/scroll.alpha.js',
			scripts+'/library/book.alpha.js'
			// scripts+"/native.extend.js", 
			// scripts+"/front.recyclabus.alpha.js", 
			// scripts+"/front.search.alpha.js", 
			// scripts+"/front.books.alpha.js", 
			// scripts+"/front.books.popup.alpha.js", 
			// scripts+"/front.change_page.alpha.js", 
			// scripts+"/front.basket.alpha.js", 
			// scripts+"/front.registration.alpha.js", 
			// scripts+"/front.account.alpha.js", 
			// scripts+"/front.confirm.alpha.js", 
			// scripts+"/front.thank_you.alpha.js", 
			// scripts+"/utility.users.js", 
			// scripts+"/utility.alpha.js", 
			// scripts+"/front.test.alpha.js", 
			// scripts+"/amazon.js", 
			// scripts+"/ticket.alpha.js", 
			// scripts+"/route.alpha.js",
			// scripts+"/front.alpha.js"
		],
		function (error, result) { 
			var book  = {};
				book.results = [];
				book.basket  = [];
			var animate = {};
				animate.load  = false;
				animate.state = false;
				animate.scroll= true;
				animate.page  = "home";
				animate.popup = false;
				animate.pop   = {};
				animate.pop.outside = false;

				// animate.number

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
				state.viewed_item.parts.isbn    = "";
				state.viewed_item.parts.title   = "";
				state.viewed_item.parts.author  = "";
				state.viewed_item.parts.price   = "";
				state.viewed_item.parts.image   = "";
				state.viewed_item.parts.editorial_review = "";

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
				state.add_address  = false;
				state.add_account  = false;
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

				state.withdraw     = 0.00;
				state.log_in       = {};
				state.log_in.where = "";
				state.log_in.logging_in = false;
				state.signed  = false;
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
						world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.tracking.branch.body.branch.wrap.instructions.scroll.initiate_being();
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
						world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.basket.branch.basket.instructions.scroll.initiate_being();
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
				}
			});
			
			var world = new alpha.thought;
			world.thought = {
				wrap : {
					instructions : {
						email : function (wake) {

							wake.text += "<p>Many Thanks,</p><p>The Recyclabook Team</p><p>We give out some MAD prizes.</p><p>Give us a like, give us a follow and we’ll give you a pony (maybe).</p><p><a href=\"Facebook.com/Recyclabook\">Facebook.com/Recyclabook</a></p><p><a href=\"Twitter.com/Recyclabook\">Twitter.com/Recyclabook</a></p>";

							$.post(ajaxurl, {
								action : "set_email",
								method : "email",
								paramaters : {
									name    : wake.name,
									email   : wake.email,
									subject : wake.subject,
									text    : wake.text
								}
							}, function () {}, "json");
						},
						observers : [
							{
								who      : state.log_in,
								property : "logging_in",
								call     : function (change) { 
									animate.load = "logging you in...";
									if ( change.new === true && !state.signed ) {
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
														state.signed = true;
														state.log_in.logging_in = false;
														animate.load = false;
														if ( state.log_in.where === "welcome" ) router.change_url("confirm");

													}, "json");
												} else {
													console.log("invalid password");
													state.log_in.logging_in = false;
													animate.load = false;
												}
											} 	
											else { 
												console.log("invalid email");
												state.log_in.logging_in = false;
												animate.load = false;
											}
										}, 
										"json");
									}
								}
							},
							{
								who      : state,
								property : "add_address",
								call     : function (change) { 
									if (!change.new) return;

									state.addresses[0].user = state.account.email;

									$.post( ajaxurl, {
										action : "set_account",
										method : "new_address",
										paramaters : {
											address : state.addresses[0]
										}
									}, function () {
										state.add_adress = false;
									},"json");
								}
							},
							{
								who      : state,
								property : "add_account",
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
											state.signed      = true;
											state.add_account = false;
										},"json");
									}
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

									var price_promise, added_books;
										if ( state.account.price_promise === null ) state.account.price_promise = [];
										price_promise = state.account.price_promise.concat(book.basket);
										state.account.price_promise = price_promise;
										added_books   = "<ul>";
										for (var index = 0; index < book.basket.length; index++) {
											added_books += "<li>"+ book.basket[index].title +"</li>";
										};
										added_books  += "</ul>";
										book.basket   = [];
										state.save_account       = true;
										state.give_price_promise = false;

									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name +", "+ state.account.second_name,
										subject : "New books have been added to your price promise",
										text    : "<p>Hi "+ state.account.first_name +"</p><p>You have added the following books to your price promise basket.</p>"+ added_books +"<p>Because, the prices of books and quotes we give can change, the price promise basket is our way of promising that we will give you the price quoted on that day for your books, so you dont have to worry</p><p> We will be expecting for your books to arrive </p><p> To check on your price promise basket, and add any new books, visit <a href=\"recyclabook.com\">Recyclabook</a>, where you can log in and monitor what is going on with your books though your account hub.</p>"
									});

									world.wrap.instructions.email({
										email   : "recyclabook@gmail.com",
										name    : "Recyclaguys",
										subject : "User added books",
										text    : "<p>You guys a user with the username :"+ state.account.email +"</p><p> and name "+ state.account.first_name +", "+ state.account.second_name +"</p><p> has added these books to their price promise basket"+ added_books +"</p>"
									});
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
												date        : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
											}
										}
									}, function () {}, "json");

									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name +", "+ state.account.second_name,
										subject : "Freepost pack",
										text    : "<p>Hi "+ state.account.first_name +"</p><p>We will dispatch a freepost pack soon to : </p><ul><li>"+ state.addresses[0].address +"</li><li>"+ state.addresses[0].town +"</li><li>"+ state.addresses[0].town +"</li><li>"+ state.addresses[0].post_code +"</li></ul><p>When you receive the pack all you have to do is post your books in the freepost envelope provided.</p><p>Once we receive the books we will send you a cheque.</p><p>For more information visit <a href=\"Recyclabook.com\">Recyclabook.com</a>.</p>"
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
											email   : state.account.email,
											name    : state.account.first_name +", "+ state.account.second_name,
											subject : "Freepost pack",
											text    : "<p>Hi, "+ state.account.first_name +",</p><p>Thank you for selling your book with Recyclabook.</p><p>You have chosen to send your books to us with your own packaging.</p><p>All you have to do is now is post your books in the pre-paid envelope provided.</p><p>If you have one write this number on it: '"+ state.account.id +"'; so that we know it came from you,</p><p>Or if you have your own packaging material, print off the freepost code attached</p><p>and send it attached to your package.</p><p>We are looking forward to receiving your books.</p>"
										});
									}, "json");

								}
							},
							{ 
								who      : state,
								property : "add_account",
								call     : function (change) {
									if ( !change.new ) return;
									var text,
										normal_registration = "<p>Hi there "+ state.account.first_name +"</p><p>Thank you for registering an account with Recyclabook.</p><p>We focus on giving students the easiest possible way to sell their textbooks.</p><p>With an account you can track your order, see how much you’ve made from selling your textbooks, donate to your RAG campaign and more.</p><p>Your account details:</p><ul><li>Username:"+ state.account.email +"</li><li>Password:"+ state.account.password +"</li></ul>",
										bus_registration    = "<p>Hi there "+ state.account.email +"</p><p>Thank you for signing up to recieve updates about the Recyclabus.</p><p> We will make sure to email you as soon as our bus is coming new your University</p><p>Meanwhile we've gone and opened up an account for you, just in case you ever wish to use our onlline services</p><p>With an account you can track your orders, see how much you’ve made from selling your textbooks, donate to your RAG campaign and more.</p><p>Your account details:</p><ul><li>Username:"+ state.account.email +"</li><li>Password:"+ state.account.password +"</li></ul>";
										text                = ( state.account.first_name === state.account.email? bus_registration : normal_registration );
									
									world.wrap.instructions.email({
										email   : state.account.email,
										name    : state.account.first_name,
										subject : "Welcome to Recyclabook",
										text    : text
									});

									world.wrap.instructions.email({
										email   : "recyclabook@gmail.com",
										name    : "Recyclaguys",
										subject : "User Registered",
										text    : "You guys a user with the username :"+ state.account.email +" has registered for our services"
									});
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
							}
						]
					},
					self   : '<div class="wrap"></div>',
					branch : {
						load : {
							instructions : {
								observers : [
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
							self : '<div class="load">Loading...</div>'
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
																		search : function (value) {
																			animate.load = "searching books...";
																			var amazon = new alpha.amazon({
																				typed    : value,
																				callback : function (books) { 
																					if ( books !== undefined ) {
																						state.quote  = "post";
																						book.results = books;
																						router.change_url("sell");
																						animate.load = false;
																					}
																				}
																			});
																		},
																		on : {
																			the_event : "keypress",
																			is_asslep : false,
																			call      : function (change) {												
																				if ( change.event.keyCode === 13 ) {
																					this.input.instructions.search(change.self.val());
																				}
																			}
																		}
																	},
																	self  : '<input type="text" class="header_input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">',
																}
															}
														},
														search_button : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		this.input_wrap.branch.input.instructions.search(this.input_wrap.branch.input.self.val());
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
																recyclabus : {
																	instructions : {
																		observe : {
																			who      : animate,
																			property : "page",
																			call     : function (change) {
																				var self = world.wrap.branch.navigation.branch.wrap.branch.navigation.branch.wrap.branch.navigation.branch.recyclabus.self;
																				if ( change.new === "recyclabus" ) self.attr("class", "with-icon-for-navigation-text-for-bar-active");
																				if ( change.new !== "recyclabus" ) self.attr("class", "navigation_text_for_bar");
																			}
																		}
																	},
																	self : '<a href="recyclabus" id="recyclabus_navigation" class="navigation_text_for_bar">Recyclabus</a>'
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
																	if ( change.new === "register" )  text.text("This will not only create your profile hub that will let you track payments, check book orders and edit details but makes sure we make the payment out to the right person and send the freepost pack to the correct address.");
																	if ( change.new === "confirm"  )  text.text("Better be safe than sorry, Just check the books and address are correct and edit any mistakes if need be, then chose which type of freepost you prefer and confirm your sale. Shazam!");
															}
														}
													},
													self : '<p class="progress_pop_up_text"></p>'
												}
											}
										},						
										welcome_popup : {
											instructions : {
												observe : {
													who      : state,
													property : "signed",
													call     : function (change) {
														var box = world.wrap.branch.navigation.branch.wrap.branch.welcome_popup.self;
														// if ( change.new )  console.log("signed in");
													}
												}
											},
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
																			state.account.password = change.self.val();
																			state.log_in.where      = "welcome";
																			state.log_in.logging_in = true;
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
																		state.log_in.where      = "welcome";
																		state.log_in.logging_in = true;
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
													last_branch : {
														text   : '<div class="progress_welcome_register_box_text">New To Recyclabook >>></div>',
														button : '<a href="register" class="progress_welcome_register_box_button">Sign Up</a>'
													}
												}
											}
										},							
										user_button : {
											instructions : {
												open : false,
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( this.user_button.instructions.open ) {
															this.user_popup_box.self.animate({ opacity : 0 }, 300, function () {
																$(this).css({ display : "none" });
															});
															this.user_button.instructions.open = false;
														} 
														else { 
															this.user_popup_box.self.css({ display : "block" }).animate({ opacity : 1 }, 200);
															this.user_button.instructions.open = true;
														}
													}
												}
											},
											self   : '<div class="button_for_user"></div>',
											last_branch : {
												icon  : '<span class="with-icon-user"></span>',
												arrow : '<span class="with-icon-user-arrow"></span>'
											}
										},						
										user_popup_box : {											
											self   :  '<div class="user_pop_up_box"></div>',
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
																var settings = world.wrap.branch.navigation.branch.wrap.branch.user_popup_box.branch.settings.self;
																if ( change.new ) {
																	settings.css({ display : "block" });
																} else {
																	settings.css({ display : "none" });
																}
															}
														}
													},
													self   : "<div class=\"user_pop_up_settings_wrap\"></div>",
													branch : {
														title : {
															instructions : {
																observe : {
																	who      : state.account,
																	property : "first_name",
																	call     : function (change) { 
																		var title = world.wrap.branch.navigation.branch.wrap.branch.user_popup_box.branch.settings.branch.title.self;
																			title.text("Hi, "+ change.new );
																	}
																}
															},
															self : '<div class="user_pop_up_title"></div>' 
														},
														edit_option : {
															self : '<a href="hub" class="user_pop_up_option">View Account</a>'
														},
														sign_out : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		state.signed    = false;
																		for ( var part in state.addresses[0] ) state.addresses[0][part] = "";
																		for ( var part in state.account )      state.account[part]      = preset.account[part];
																	}
																}
															},
															self : '<div class="user_pop_up_option">Sign Out</div>'
														}
														// tracking_option : {
														// 	self : '<div class="user_pop_up_option">Tracking</div>'
														// },
														// account : {
														// 	self : '<div class="user_pop_up_option">Account History</div>'
														// }
													}
												},
												sign_in : {
													instructions : {
														observe : {
															who : state,
															property : "signed",
															call : function (change) { 
																var sign_in = world.wrap.branch.navigation.branch.wrap.branch.user_popup_box.branch.sign_in.self;
																if ( change.new ) {
																	sign_in.css({ display : "none" });
																} else {
																	sign_in.css({ display : "block" });
																}
															}
														}
													},
													self   : "<div class=\"user_pop_up_sign_in_wrap\"></div>",
													branch : {
														sign_in_wrap : {
															self   : '<div class="user_pop_up_title_white">Sign in</div>'
															// branch : {
															// 	register : {
															// 		self : '<span class="user_pop_up_title_highlight">Register</span>'
															// 	}
															// }
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
															self : '<input type="text" class="user_pop_up_option_input" placeholder="Username">'
														},
														password : {
															instructions : {
																on : {
																	the_event : "keypress",
																	is_asslep : false,
																	call      : function (change) {
																		if ( change.event.keyCode === 13 ) {
																			state.account.password  = change.self.val();
																			state.log_in.where      = "normal";
																			state.log_in.logging_in = true;
																		}	
																	}
																}
															},
															self : '<input type="password" class="user_pop_up_password_input" placeholder="Password">'
														},
														enter : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function () {
																		state.account.password  = this.password.self.val();
																		state.log_in.where      = "normal";
																		state.log_in.logging_in = true;
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
															self : '<div class="user_pop_up_options_forgot_password">forgottten password?</div>' 
														}
													}
												}																							
											}
										}
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
																				action : "set_email",
																				method : "email",
																				paramaters : {
																					name    : state.account.email,
																					email   : state.account.email,
																					subject : "Password Reminder",
																					text    : "<p>Hi "+ response.return.first_name +", you recently asked us to send you your password as you could not remember it</p><p>Your password is : "+ response.return.password +"</p>"
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
										advertising : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.advertising.self;
														if ( change.new === "advertising" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self : '<div class="popup_advertising"></div>',
											branch : {
												title : {
													self : '<div class="popup_advertising_title">Advertising</div>'
												},
												text : {
													self : '<a href="http://recyclabook.com/advertising_pack.pdf" target="blank" data-dont-route="true" class="popup_advertising_download">Download the advertising pack pdf</div>'
												},
												one : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_one.jpg" class="popup_advertising_page">'
												},
												two : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_two.jpg" class="popup_advertising_page">'
												},
												three : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_three.jpg" class="popup_advertising_page">'
												},
												four : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/advertising_four.jpg" class="popup_advertising_page">'
												}
											}
										},
										media : {	
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.media.self;
														if ( change.new === "media" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_media"></div>',
											branch : {
												bubble : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/media_bubble.png" class="popup_media_bubble">'
												},
												logos : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/media.png" class="popup_media_logos">'
												},
												email : {
													self : '<div class="popup_media_email">Press@recyclabook.com</div>'
												}
											}
										},
										contact :{
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.contact.self;
														if ( change.new === "contact" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_contact"></div>',
											branch : {
												image : {
													self : '<img src="'+frameworkuri+'/CSS/Includes/works/contact.png" class="popup_contact_image">'
												}, 
												text : {
													self : '<div class="popup_contact_text"></div>',
													branch : {
														left : {
															self   : '<div class="popup_contact_text_left"></div>',
															branch : {
																email : {
																	self : '<div class="popup_contact_text_left_text">Talk@recyclabook.com</div>'
																},
																phone : {
																	self : '<div class="popup_contact_text_left_text">02921 202665</div>'
																}
															}
														},
														right : {
															self   : '<div class="popup_contact_text_right"></div>',
															branch : {
																address : {
																	self : '<div class="popup_contact_text_right_text">Britania House</div>'
																},
																area : {
																	self : '<div class="popup_contact_text_right_text">Caerphilly Bussines park</div>'
																},
																town : {
																	self : '<div class="popup_contact_text_right_text">Caerphilly</div>'
																},
																post_code : {
																	self : '<div class="popup_contact_text_right_text">CF83 3GG</div>'
																}
															}
														}
													}
												}
											}
										},
										word :{
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.word.self;
														if ( change.new === "word_from_us" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self   : '<div class="popup_word"></div>',
											branch : {
												title : {
													self : '<div class="popup_word_title">A Word From Us</div>'
												},
												text : {
													self   : '<div class="popup_word_text"></div>',
													branch : {
														paragraph : {
															self : '<div class="popup_word_paragraph">Recyclabook was founded by Tom Williams and James Seear with the aim of providing the easiest possible way for a student to sell their textbook.</div>'
														},
														paragraph_two : {
															self : '<div class="popup_word_paragraph">After months of trials and tribulations and with the help of some great people along the way, we’ve grown to a team of six, spoken to universities across the world and created Recyclabook - a company that provides a service that we wanted when we were students!</div>'
														},
														paragraph_three : {
															self : '<div class="popup_word_paragraph">We’ve tried to create a brand that embodies ease and trust at its core, this is where the ‘Recyclabus’ stems from, a van parked in a convenient location where students can bring their books and get paid instantly. </div>'
														},
														thanks : {
															self : '<div class="popup_word_paragraph">Thanks,</div>'
														},
														signed : {
															self : '<div class="popup_word_paragraph">Tom and James</div>'
														}
													}
												}
											}
										},
										legal : {
											instructions : {
												observe : {
													who      : animate.pop,
													property : "outside",
													call     : function (change) { 
														var box = world.wrap.branch.popup.branch.box.branch.legal.self;
														if ( change.new === "legal" ) { 
															box.css({ display : "block" })
														} else {
															setTimeout(function () { 
																box.css({ display :"none" });
															}, 500 );
														 }
													}
												}
											},
											self : '<div class="popup_legal"></div>',
											branch : {
												title : {
													self : '<div class="popup_legal_title">Terms & Conditions</div>'
												},
												text : {
													self   : '<div class="popup_legal_text"></div>',
													branch : {
														paragraph : {
															self : '<div class="popup_legal_paragraph"></div>'
														}
													}
												}
											}
										}	
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
												scrible : { 
													self :'<div class="homepage_how_it_works_option_title_scrible">1st option</div>' ,
												},
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
										recyclabus_sticker : {
											self : '<div class="with-icon-or-sticker-recyclabus"></div>'
										},
										recyclabus : {
											self   : '<div class="homepage_recyclabus_box_wrap"></div>',
											branch : {
												scrible : {
													self :'<div class="homepage_recyclabus_box_title_scrible">2nd option</div>'
												},
												title : {
													self : '<div class="homepage_recyclabus_box_title">Recycla<span class="homepage_recyclabus_box_title_color">Bus</span></div>'
												},
												text_wrap : {
													self   : '<div class="homepage_recyclabus_box_text_wrap"></div>',
													branch : {
														paragraph_one : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">Our bus is touring Universities all over the country, come along and get paid instantly</div>' 
															}
														},
														paragraph_two : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">It gives you an <strong>extra 20%</strong> on your sell quote</div>'
															}
														},
														paragraph_three : {
															self : '<div class="homepage_recyclabus_box_point"></div>',
															last_branch : {
																leaf : '<div class="with-icon-recyclabus-point-leaf"></div>',
																text : '<div class="homepage_recyclabus_box_point_text">No need to fill in any details <strong>just turn up on the day</strong></div>'
															}
														}
													}
												},
												find_out_more : {
													self : '<a href="recyclabus" class="homepage_recyclabus_box_button_wrap"></a>',
													last_branch : {
														text  : '<span class="homepage_recyclabus_box_button_text">Find Out More</span>',
														arrow :'<span class="with-icon-recyclabus-find-out-more-arrow"></span>'
													},
												},
												recyclabus_image : {
													self :'<img src="'+ frameworkuri +'/CSS/Includes/works/recyclabus.png"class="homepage_recyclabus_box_image">'
												}
											}
										}
									}
								}
							}
						},
						bus : {
							self : '<section class="bus pages"></div>',
							branch : {
								image : {
									self : '<img src="'+frameworkuri+'/CSS/Includes/works/bus.png" class="bus_image">'
								},
								left_split : {
									self : '<div class="bus_left_split"></div>',
									branch : {
										dates : {
											self   : '<div class="bus_dates"></div>',
											branch : {
												bar : {
													self : '<div class="bus_bar"></div>',
													branch : {
														branch : {
															search : {
																self : '<div class="bus_search"></div>',
																branch : {
																	icon : {
																		self : '<div class="with-icon-for-bus-dates-search"></div>'
																	},
																	input : {
																		instructions : {
																			on : {
																				the_event : "keyup",
																				is_asslep : false,
																				call      : function (change) {
																					var body, dates, value;
																						value = change.self.val().toLowerCase().trim();
																						body  = world.wrap.branch.bus.branch.left_split.branch.dates.branch.body.branch.wrap.branch;
																						dates = [
																							{
																								place : "The University of South Wales, Caerleon Campus",
																								date  : "14th, 15th May"
																							},
																							{
																								place : "University of West England, Frenchay Campus",	
																								date  : "16th, 17th May"
																							},
																							{
																								place : "Swansea University",
																								date  : "20th May"
																							},
																							{
																								place : "University of West England, Treforest Campus",
																								date  : "21st May"
																							},
																							{
																								place : "Bath University",
																								date  : "23rd, 32rd May"
																							},
																							{
																								place : "The University of the West of England, Frenchay Campus",
																								date  : "24th May"
																							},
																							{
																								place : "UWIC",
																								date  : "28th May"
																							},
																							{
																								place : "Swansea Metropolitan University",
																								date  : "29th May"
																							},
																							{
																								place : "Swansea University",						
																								date  : "30th, 31st May"
																							},
																							{
																								place : "Bristol University",							
																								date  : "4th, 5th June"
																							},
																							{
																								place : "Cardiff University",							
																								date  : "6th, 7th June"
																							},
																							{
																								place : "Cardiff University",							
																								date  : "13th June"
																							},
																							{
																								place : "Bristol University",							
																								date  : "14th June"
																							}
																						];

																						for (var index = 0; index < dates.length; index++) {
																							var contains_text = ( dates[index].place.toLowerCase().indexOf(value) !== -1 || dates[index].date.toLowerCase().indexOf(value) !== -1 );
																								if (contains_text) {
																									body["date_"+index].self.css({ display : "block" });
																								} else { 
																									body["date_"+index].self.css({ display : "none" });
																								}
																						};

																				}
																			}
																		},
																		self : '<input type="text" class="bus_search_input" placeholder="Filters as you type">'
																	}
																}
															}
														}	
													}
												},
												body : {
													self : '<div class="bus_body"></div>',
													branch : {
														wrap : {
															self : '<div class="bus_body_wrap"></div>',
															branch : {	
																date_0 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">The University of South Wales, Caerleon Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">14th, 15th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_1 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">The University of the West of England, Frenchay Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">16th, 17th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_2 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Swansea University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">20th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_3 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">University of West England, Treforest Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">21st May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_4 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Bath University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">23rd, 32rd May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_5 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">University of West England, Frenchay Campus</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">24th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_6 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">UWIC</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">28th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_7 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Swansea Metropolitan University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">29th May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_8 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Swansea University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">30th, 31st May</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_9 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Bristol University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">4th, 5th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_10 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Cardiff University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">6th, 7th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_11 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Cardiff University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">13th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																},
																date_12 : {
																	self   : '<div class="bus_date"></div>',
																	branch : {
																		place : {
																			self : '<div class="bus_date_place">Bristol University</div>'
																		},
																		date  : {
																			self : '<div class="bus_date_date">14th June</div>'
																		},
																		mark : {
																			self : '<div class="with-icon-bus-date-mark"></div>'
																		}
																	}
																}
															}
														}
													}
												}
											}
										},
										twitter : {
											instructions : {
												observe : {
													who      : state,
													property : "begin",
													call     : function (change) {
														var box = world.wrap.branch.bus.branch.left_split.branch.twitter.self,
															js,
															fjs =document.getElementsByTagName("script")[0],
															p   =/^http:/.test(document.location)?'http':'https';

															if( !document.getElementById("twitter-wjs") ) {
																js     = document.createElement("script");
																js.id  = "twitter-wjs";
																js.src = p +"://platform.twitter.com/widgets.js";
																fjs.parentNode.insertBefore(js,fjs);
															}
													}
												}
											},
											self : '<div class="bus_twitter"></div>',
											branch : {
												box : {
													self : '<a class="twitter-timeline" width="550" href="https://twitter.com/Recyclabook" data-widget-id="329948817518632962"></a>'
												}
											}
										}
									}
								},
								right_split : {
									self : '<div class="bus_right_split"></div>',
									branch : {
										map : {
											self : '<div class="bus_map"></div>',
											branch : {
												map : {
													self : '<iframe src="http://mapsengine.google.com/map/u/0/view?mid=zGeNIY0VmxqQ.kfujWjwn6WWo" width="390" height="390"></iframe>'
												}
											}
										},
										notify : {
											self : '<div class="bus_signup"></div>',
											branch : {
												bar : {
													self : '<div class="bus_signup_bar">Don\'t Want To Miss Us?</div>'
												},
												body : {
													self : '<div class="bus_signup_body"></div>',
													branch : {
														text : {
															self : '<div class="bus_signup_text">Leave your email and university and we\'ll email you when we\'re coming your way. Don\'t worry, we\'ll only use this to send you reminders - nothing more!</div>'
														},
														email : {
															instructions : {
																observe : {
																	who      : state, 
																	property : "signed",
																	call     : function (change) {
																		var input = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.email.self;
																		input.attr("readonly", change.new);
																		input.val(state.account.email);
																	}
																},
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.signed ) return;
																		state.account.email            = change.self.val();
																		state.registration.email.match = state.account.email;
																	}	
																}	
															},
															self : '<input type="text" class="bus_signup_input" placeholder="Email">'
														},
														university : {
															instructions : {
																observe : {
																	who      : state, 
																	property : "signed",
																	call     : function (change) {
																		var input = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.university.self;
																		if ( change.new && state.account.university !== "" ) {
																			input.attr("readonly", true);
																			input.val(state.account.university);
																		} else {
																			input.attr("readonly", false);
																		}
																	}
																},
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( !state.signed ) state.account.university = change.self.val();
																	}	
																}	
															},
															self : '<input type="text" class="bus_signup_input" placeholder="University">'
														},
														button : {
															instructions : {
																observers : [
																	{ 
																		who      : state.account,
																		property : "recieve_newsletter",
																		call     : function (change) {
																			var self = world.wrap.branch.bus.branch.right_split.branch.notify.branch.body.branch.button;
																			if ( change.new === 1 || change.new === "1" ) { 
																				self.self.text("You have signed up");
																			} else { 
																				self.self.text("Submit for reminders");
																			}
																		}
																	}
																],
																on : { 
																	the_event : "click", 
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.account.email.trim() === "") return;
																		if ( state.account.recieve_newsletter === 1 || state.account.recieve_newsletter === "1" ) return;
																		if ( state.signed ) {
																			state.account.recieve_newsletter = 1;
																			state.save_account = true;
																		} else { 
																			state.addresses[0].address        = "None";
																			state.addresses[0].town           = "None";
																			state.addresses[0].area           = "None";
																			state.addresses[0].post_code      = "None..";
																			state.account.recieve_newsletter  = 1;
																			state.account.first_name          = state.account.email;
																			state.account.second_name         = "None";
																			state.account.password            = Math.random().toFixed(7).slice(2);
																			state.registration.password.match = state.account.password;
																			state.add_account = true;
																			state.add_address = true;
																		}
																	}
																}
															},
															self : '<div class="bus_signup_submit">Submit For Reminders</div>'
														}
													}
												}
											}
										}
									}
								}
							}
						},
						sell : {
							self : '<section class="body pages"></section>',
							branch : {
								quote : {
									self   : '<div class="sell_quote_box"></div>',
									branch : {
										title : {
											self : '<div class="sell_quote_box_title">Prices Shown</div>',
										},
										post : {
											instructions : {
												current : true,
												observe : {
													who      : state,
													property : "quote",
													call     : function (change) {
														var self = world.wrap.branch.sell.branch.quote.branch.post.self;

														if ( change.new === "post") {
															self.attr("class","with-icon-sell-quote-freepost");
														} else {
															self.attr("class","with-icon-sell-quote-freepost-unticked");
														}
													}
												},
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( state.quote === "post" && this.post.instructions.current ) return;
														this.bus.instructions.current  = false;
														this.post.instructions.current = true; 
														state.quote = "post";
													}
												}
											},
											self : '<div class="with-icon-sell-quote-freepost">Freepost</div>'
										},
										bus : {
											instructions : {
												current : false,
												observe : {
													who      : state,
													property : "quote",
													call     : function (change) {
														var self = world.wrap.branch.sell.branch.quote.branch.bus.self;

														if ( change.new === "bus" ) {
															self.attr("class","with-icon-sell-quote-bus");
														} else {
															self.attr("class","with-icon-sell-quote-bus-unticked");
														}
													}
												},
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( state.quote === "bus" && this.bus.instructions.current ) return;
														this.post.instructions.current = false; 
														this.bus.instructions.current  = true;
														state.quote = "bus";
													}
												}
											},
											self : '<div class="with-icon-sell-quote-bus-unticked">Recyclabus</div>',
										},
										description : {
											self : '<div class="sell_quote_box_description">You get an extra 20% if you use Recyclabus</div>'
										},
										link : {
											self : '<a href="recyclabus" class="sell_quote_box_link">Find out more about Recyclabus</a>'
										},
									}
								},	
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
												open : false,
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														if ( this.basket_box.instructions.open ) {
															world.wrap.branch.sell.branch.popup.self.animate({ opacity : 0 }, 300, function () {
																$(this).css({ display : "none" });
															});
															this.basket_box.instructions.open = false;
														} 
														else { 
															world.wrap.branch.sell.branch.popup.self.css({ display : "block" }).animate({ opacity : 1 }, 200);
															this.basket_box.instructions.open = true;
														}
													}
												}
											},
											self   : '<div class="sell_and_buy_basket"></div>',
											branch : {
												stats : { 
													self   : '<div id="buy_basket" class="basket_stats"></div>',
													branch : {
														sell_text : {
															self : '<span class="sell_basket_text">Sell : </span>'
														},
														quote : {
															instructions : {
																observe : {
																	who      : book,
																	property : "basket",
																	call     : function (change) { 
																		world.wrap.branch.sell.branch.basket.branch.basket_box.branch.stats.branch.quote.self.text(change.new.length);
																	}
																}
															},
															self : '<span class="sell_basket_number">0</span>'
														}
													}
												}
											}
										}
									}
								},
								popup : {
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
														observe : {
															who : book,
															property : "basket",
															call : function (change) {
																var format, manifest, map, append_to;

																	format = {
																		self : '<div class="store_basket_pop_up_content_item"></div>',
																		branch : {
																			thumbnail : {
																				self : '<div class="store_basket_pop_up_content_item_thumbnail"></div>',
																				branch : {
																					image : {
																						self : '<img src="">'
																					}
																				}
																			},
																			title : {
																				self : '<div class="store_basket_pop_up_content_item_title"></div>'
																			},
																			author : {
																				self :'<div class="store_basket_pop_up_content_item_author"></div>' 
																			},
																			isbn : {
																				self : '<div class="store_basket_pop_up_content_item_isbn_wrap"></div>',
																				branch : {
																					text : {
																						self : '<div class="store_basket_pop_up_content_item_isbn_highlight">ISBN: </div>'
																					},
																					isbn : {
																						self : '<div class="store_basket_pop_up_content_item_isbn"></div>'
																					}
																				}
																			},
																			price : {
																				self : '<div class="store_basket_pop_up_content_item_sell_price_wrap"></div>',
																				branch : {
																					text  : {
																						self : '<div class="store_basket_pop_up_content_item_sell_price_text">Sell for:</div>'
																					},
																					price : {
																						self : '<div class="store_basket_pop_up_content_item_sell_price"></div>'
																					}
																				}
																			},
																			remove : {
																				instructions : {
																					on : {
																						the_event : "click",
																						is_asslep : false,
																						call      : function (change) { 
																							var index = change.self.attr('id');
																								basket= book.basket;
																								basket.splice(index, 1);
																								book.basket = basket;
																						}
																					}
																				},
																				self : '<div id="" class="with-icon-x-for-store-basket-pop-up-content-item"></div>'
																			}
																		}
																	};
																	map = [
																		{
																			path : "branch.thumbnail.branch.image.self.src",
																			value: "image"
																		},
																		{
																			path : "branch.title.self.text",
																			value: "title"
																		},
																		{
																			path : "branch.author.self.text",
																			value: "author"
																		},
																		{
																			path : "branch.isbn.branch.isbn.self.text",
																			value: "isbn"
																		},
																		{
																			path : "branch.price.branch.price.self.text",
																			value: "price"
																		},
																		{
																			path : "branch.remove.self.id",
																			value: "id"
																		}
																	];

																	append_to = world.wrap.branch.sell.branch.popup.branch.items.branch.items.self;

																	append_to.empty();
																	manifest = alpha.format(format, append_to, book.basket.length );

																	$.each(book.basket, function (index, book) { 
																		book.id = index;
																		alpha.parse(map, manifest[index+1], book);
																	});	
																	world.wrap.branch.sell.branch.popup.branch.items.branch.items.branch = manifest;
															}
														}
													},
													self : '<div class="store_basket_pop_up_content_items_wrap"></div>'
												},
												total : { 
													instructions : {
														observe : {
															who      : book,
															property : "basket",
															call     : function (change) { 
																var quote = 0;
																for (var index = 0; index < change.new.length; index++) {
																	quote += change.new[index].price * 100;
																};
																quote /= 100;
																world.wrap.branch.sell.branch.popup.branch.items.branch.total.branch.number.self.text("£ "+quote);
															}
														}
													},
													self   : '<div class="store_basket_pop_up_content_total_wrap"></div>',
													branch : {
														text   : {
															self : '<div class="store_basket_pop_up_content_total_text">Total:</div>'
														},
														number : {
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
															}
														}
													},
													self : '<div class="store_basket_pop_up_button_first">Check And Continue</div>'
												}
											}
										},
										popup_text : {
											self : '<div class="store_basket_pop_up_text">Currently showing freepost prices</div>'
										},
										// post : {
										// 	self : '<div class="store_basket_pop_up_change">See Freepost</div>',
										// },
										// bus : {

										// }
									}
								},
								items : {
									instructions : {
										observe : {
											who      : book,
											property : "results",
											call     : function (change) {

												var format, manifest, map, wraps, append_to;
													format = {
														self : '<div class=""></div>',
														branch : {
															wrap : {
																self : '<div class="result_book_search"></div>',
																branch : {
																	info : {
																		instructions : {
																			on : {
																				the_event : "click",
																				is_asslep : false,
																				call      : function (change) {
																					var book      = this.button.branch.wrap.branch.instructions.book;
																					for ( var part in state.viewed_item.parts ) state.viewed_item.parts[part] = book[part];
																					state.viewed_item.book = book;
																					state.viewed_item.show = true;
																				}
																			}
																		},
																		self : '<span class="with-icon-info-for-book"></span>'
																	},
																	image : {
																		self : '<img src="" class="result_book_thumbnail_image">'
																	},
																	description : {
																		self : '<article class="result_book_search_text"></article>',
																		branch : {
																			title : {
																				self : '<strong class="result_book_title"></strong>'
																			},
																			author : {
																				self : '<div class="result_book_author"></div>'
																			},
																			price_wrap : {
																				self : '<div class="result_book_price_wrap"></div>',
																				branch : {
																					text : {
																						self : '<span class="result_book_price_text">Sell for - </span>'
																					},
																					price : {
																						self : '<storng class="result_book_price"></storng>'
																					}}}}},
																	button : {
																		self : '<div class="result_book_add_button_wrap"></div>',
																		branch : {
																			wrap : {
																				self : '<div class="result_book_inner_wrap"></div>',
																				branch : {											
																					add_button : {
																						instructions : {
																							on : {
																								the_event         : "click",
																								is_asslep         : false,
																								call              : function (change) {
																									change.self.closest('.result_book_inner_wrap').css({ position : "relative" }).animate({ top : "-45px" }, 400 );
																									change.self.closest('.result_book_search').next().animate({ opacity : 1 }, 500);
																									var promise = book.basket;
																										promise.push(this.instructions.book);
																										book.basket = promise;
																								}
																							}
																						},
																						self : '<div class="result_book_add_button"></div>',
																						last_branch : {
																							text :'<span class="result_book_add_button_text">Add To Sell Basket</span>'
																						}},
																					added_button :{
																						self : '<div class="result_book_add_button_static"></div>',
																						last_branch : {
																							text : '<span class="with-icon-added-to-sell-basket-tick">Added To Basket</span>'
																						}
																					}
																				}
																			}
																		}
																	}
																}
															},
															button : {
																self : '<div class="result_book_extra_options_buttons"></div>',
																branch : {
																	sell : {
																		instructions : {
																			on : { 
																				the_event : "click",
																				is_asslep : false,
																				call      : function (change) { 
																					if ( book.basket.length === 0 ) return;
																					(state.signed)? router.change_url("confirm") : router.change_url("confirm_sign_in");
																				}
																			}
																		},
																		self : '<span class="result_book_added_book_sell_button"><span class="with-icon-sell-now-arrow"></span>Sell now?</span>'
																	},
																	add : {
																		instructions : { 
																			book : null,
																			on : {
																				the_event : "click",
																				is_asslep : false,
																				call      : function (change) {
																					var promise = book.basket;
																						promise.push(this.add.instructions.book);
																						book.basket = promise;
																				}
																			}
																		},
																		self : '<span class="result_book_added_book_add_again_button"><span class="with-icon-add-again"></span>Add again+</span>'
																	}
																}
															}
														}
													};
													wraps = {};
													wraps.on_wrap = 0;
													wraps.classes = [
														"result_book_search_wrapper_left", 
														"result_book_search_wrapper", 
														"result_book_search_wrapper_right"
													];
													map = [
														{
															path : "branch.wrap.branch.button.branch.wrap.branch.add_button.self.id",
															value: "id"
														},
														{
															path : "self.class",
															value: "wrap"
														},
														{ 
															path : "branch.wrap.branch.image.self.src",
															value: "image"
														},
														{
															path : "branch.wrap.branch.description.branch.title.self.text",
															value: "short_title"
														},
														{
															path : "branch.wrap.branch.description.branch.author.self.text",
															value: "short_author"
														},
														{
															path : "branch.wrap.branch.description.branch.price_wrap.branch.price.self.text",
															value: "price"
														}
													];
													append_to = world.wrap.branch.sell.branch.items.self;

													append_to.empty();
													manifest = alpha.format(format, append_to, book.results.length );
													$.each(book.results, function (index, book) { 
														book.wrap         = wraps.classes[wraps.on_wrap];
														
														book.title        = book.title.replace(/'s/g, "s");
														book.author       = book.author.replace(/'s/g,"s");
														book.short_title  = book.title.slice(0, 10) +'...';
														book.short_author = book.author.slice(0, 18) +'...';
														book.price        = book.price;
														book.id           = index+1;

														alpha.parse(map, manifest[index+1], book);
														manifest[index+1].branch.wrap.branch.button.branch.wrap.branch.instructions = {
															book : book
														};
														console.log(book);

														manifest[index+1].branch.button.branch.add.instructions.book = book;
														( wraps.on_wrap === 2? wraps.on_wrap = 0 : wraps.on_wrap++ );
													});	
													world.wrap.branch.sell.branch.items.branch = manifest;

													if (change.new.length === 0) append_to.append("<div class=\"reslt_not_found\">No search results were found sorry</div>");

													append_to.css({ top : "800px"});
													append_to.animate({ top : "0px" }, 900);
											}
										}
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
															property : "image",
															call     : function (change) { 
																var self = world.wrap.branch.item.branch.book.branch.image_wrap.branch.image.self;
																self.attr("src", change.new);
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
															property : "title",
															call     : function (change) { 
																var self = world.wrap.branch.item.branch.book.branch.books_text.branch.title.self;
																self.text(change.new);
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
																var self = world.wrap.branch.item.branch.book.branch.books_text.branch.author.self;
																self.text(change.new);
															}
														}
													},
													self : '<div class="search_books_expanded_author"></div>'
												},
												isbn : { 
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "isbn",
															call     : function (change) { 
																var self = world.wrap.branch.item.branch.book.branch.books_text.branch.isbn.self;
																self.text(change.new);
															}
														}
													},
													self   : '<div class="search_books_expanded_isbn"></div>'
												},
												quote : {
													instructions : {
														observe : {
															who      : state.viewed_item.parts,
															property : "price",
															call     : function (change) { 
																var self = world.wrap.branch.item.branch.book.branch.books_text.branch.quote.self;
																self.text("£"+change.new);
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
																				// var promise = book.basket;
																				// 	promise.push(state.viewed_item.book);
																				// 	book.basket = promise;
																					change.self.animate({ top : "-49px", marginBottom : "-49px" }, 300);
																			}
																		},
																		observe : {
																			who      : state.viewed_item,
																			property : "show",
																			call     : function (change) { 
																				var self = world.wrap.branch.item.branch.book.branch.books_text.branch.buttons.branch.inner.branch.add.self;
																				if ( !change.new ) self.css({ top : "0px", marginBottom : "0px" });
																			}
																		}
																	},
																	self   : '<div class="search_books_expanded_book_add_to_sell_basket_button"></div>',
																	branch : {
																		text : {
																			// instructions : {
																			// 	on : {
																			// 		the_event : "click",
																			// 		is_asslep : false,
																			// 		call      : function (change) {
																			// 			var promise = book.basket;
																			// 				promise.push(state.viewed_item.book);
																			// 				book.basket = promise;
																			// 		}
																			// 	}
																			// },
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
													self : '<div class="legend_mark_green">mandatory fields*</div>'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.first_name = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="First Name">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.second_name = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="Second Name">'
														}
													}
												},
												address : {
													self   : '<div class="field_box_input_wrap"></div>',
													branch : {
														title  			 : {
															self : '<div class="field_box_input_title">Where shall we send your freepost pack</div>'
														},
														not_valid        : {
															self : '<span class="with-icon-not-valid-field"></span>'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].address = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="House name or number">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].town = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="Town/City">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].area = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="County">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.addresses[0].post_code = change.self.val().replace(/\s+/g, '');;
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="Post Code">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.email = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="Email address">'
														},
														not_valid           : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														confirm_email_input : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.email.match = change.self.val().trim();
																	}
																}
															},
															self : '<input type="text" class="field_box_input" placeholder="Confrim">'
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
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.account.password = change.self.val().trim();
																	}
																}
															},
															self : '<input type="password" class="field_box_input" placeholder="Password">'
														},
														not_valid      		   : {
															self : '<span class="with-icon-not-valid-field"></span>'
														},
														password_input_confirm : {
															instructions : {
																on : {
																	the_event : "keyup",
																	is_asslep : false,
																	call      : function (change) {
																		state.registration.password.match = change.self.val().trim();
																	}
																}
															},
															self : '<input type="password" class="field_box_input" placeholder="Confirm">'
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
													last_branch : {
														text_one : '<div class="input_box_disclaimer_text">If you don\'t want to receive emails with exclusive offers and competitions from Recyclabook and our friends then untick this</div>',
														text_two : '<div class="input_box_disclaimer_small">by pressing continue you agree to</div>',
														link     : '<div class="input_box_disclaimer_highlight">terms & conditions</div>'
													}
												},
												continue_button : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 
																state.add_account = true;
																state.add_address = true;
																router.change_url("confirm");
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
																		scroll : null
																	},
																	self   : '<div class="basket_overview_basket"></div>',
																	branch : {
																		items : {
																			instructions : {
																				observers : [
																					{
																						who      : book,
																						property : "basket",
																						call     : function (change) { 
																							
																							var format, manifest, map, append_to;
																							append_to = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.basket.branch.basket.branch.items.branch.wrap;
																							format = { 
																								self : '<div class="basket_overview_item"></div>',
																								branch : {
																									close : {
																										instructions : {
																											on : {
																												the_event : "click",
																												is_asslep : false,
																												call      : function (change) { 
																													if (confirm("Are you sure you want to remove this book?")) {
																														var index = change.self.attr('id');
																															basket= book.basket;
																															basket.splice(index, 1);
																															book.basket = basket;
																													}
																												}
																											}
																										},
																										self : '<div id="" style="display:block;" class="with-icon-x-for-overview-item confirm_basket_remove"></div>'
																									},
																									thumbnail : {
																										self : '<img class="basket_overview_item_thumbnail" src="">'
																									},
																									text : {
																										self : '<div class="basket_overview_item_text_wrap"></div>',
																										branch : {
																											title : {
																												self : '<div class="basket_overview_item_text_title"></div>'
																											},
																											author : {
																												self : '<div class="basket_overview_item_text_author"></div>'
																											},
																											isbn : {
																												self :'<div class="basket_overview_item_isbn"></div>'
																											}
																										}
																									},
																									price : {
																										self : '<div class="basket_overview_item_price_wrap"></div>',
																										branch : {
																											text : {
																												self :'<div class="basket_overview_item_price_text">Sell for</div>'
																											},
																											quote : {
																												self :'<div class="basket_overview_item_price"></div>'
																											}
																										}
																									}
																								}
																							};
																							map = [
																								{
																									path : "branch.thumbnail.self.src",
																									value: "image"
																								},
																								{
																									path : "branch.text.branch.title.self.text",
																									value: "title"
																								},
																								{
																									path : "branch.text.branch.author.self.text",
																									value: "author"
																								},
																								{
																									path : "branch.text.branch.isbn.self.text",
																									value: "isbn"
																								},
																								{
																									path : "branch.price.branch.quote.self.text",
																									value: "price"
																								},
																								{
																									path : "branch.close.self.id",
																									value: "id"
																								}
																							];
																							append_to.self.empty();
																							manifest = alpha.format(format, append_to.self, book.basket.length );
																							$.each(book.basket, function (index, book) { 
																								book.id = index;
																								alpha.parse(map, manifest[index+1], book);
																							});
																							append_to.branch = manifest;
																							
																						}
																					},
																					{
																						who      : animate,
																						property : "scroll",
																						call     : function (change) { 
																							console.log("scroll on");
																							var basket = world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.basket.branch.basket;
																								basket.instructions.scroll = new alpha.scroll_bar({
																									parent : basket.self[0],
																									wrap   : basket.branch.items.self[0],
																									holder : basket.branch.items.branch.wrap.self[0],
																									scroll : basket.branch.bar.self[0],
																									handle : basket.branch.bar.branch.block.self[0],
																									size   : 182
																								});
																								console.log(basket.instructions.scroll);
																						}
																					}
																				],
																			},
																			self : '<div class="basket_overview_items"></div>', 
																			branch : {
																			 	wrap : {
																			 		self : '<div class="basket_overview_items_wrap"></div>'
																			 	}
																			}
																		},
																		bar : {
																			self   : '<div class="basket_overview_bar"></div>',
																			branch : {
																				block : {
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
																					for (var index = 0; index < change.new.length; index++) {
																						quote += change.new[index].price * 100;
																					};
																					quote /= 100;
																					world.wrap.branch.confirm.branch.wrap.branch.confirmation_overview.branch.basket_overview.branch.total.branch.total.self.text("£"+ quote);
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
															self : '<div class="how_would_you_like_tab_title_active">Contains: instructions and a freepost envelope"</div>'
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
															self : '<div class="how_would_you_like_tab_title">Use your own postage</div>'
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
																					self : '<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>'
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
																					self : '<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>'
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
						hub_popup : {
							instructions : {
								observe : {
									who      : animate,
									property : "popup",
									call     : function (change) {
										var box = world.wrap.branch.hub_popup.self;
										if ( change.new !== false ) {
											box.css({ display : "block" }).animate({ opacity : 1 });
										} else {
											box.animate({ opacity : 0 }, 500, function () {
												box.css({ display :"none" });
											});
										}
									}
								}
							},
							self : '<div class="profile_hub_popup_screen"></div>',
							branch : { 
								donate : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.donate.self;
												if ( change.new === "donate" ) { 
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self : '<div class="profile_hub_donate"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_donate_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_donate_logo">',
												text : '<div class="profile_hub_donate_description">Donation to your uni RAG</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_donate_body"></div>',
											branch : {
												send_to : {
													self :'<div class="profile_hub_donate_line"></div>' ,
													branch : {
														description : { 
															self : '<div class="profile_hub_donate_line_description">Cheque to be sent to :</div>'
														},
														text : {
															self :'<div class="profile_hub_donate_line_text_wrap"></div>' ,
															branch : { 
																select : {
																	self : '<select class="profile_hub_donate_line_select"></select>',
																	last_branch : {
																		none         : '<option value="null">Donate to which uni?</option>',
																		universities : '<option value="University of Aberdeen">University of Aberdeen</option><option value="University of Abertay Dundee">University of Abertay Dundee</option><option value="Aberystwyth University">Aberystwyth University</option><option value="Anglia Ruskin University, Cambridge and Chelmsford">Anglia Ruskin University, Cambridge and Chelmsford</option><option value="The Arts University Bournemouth">The Arts University Bournemouth</option><option value="University of the Arts London">University of the Arts London</option><option value="Camberwell College of Arts">Camberwell College of Arts</option><option value="Central Saint Martins College of Art and Design">Central Saint Martins College of Art and Design</option><option value="Chelsea College of Art and Design">Chelsea College of Art and Design</option><option value="London College of Communication">London College of Communication</option><option value="London College of Fashion">London College of Fashion</option><option value="Wimbledon College of Art">Wimbledon College of Art</option><option value="Aston University, Birmingham">Aston University, Birmingham</option><option value="Bangor University">Bangor University</option><option value="University of Bath">University of Bath</option><option value="Bath Spa University">Bath Spa University</option><option value="University of Bedfordshire">University of Bedfordshire</option><option value="University of Birmingham">University of Birmingham</option><option value="Birmingham City University">Birmingham City University</option><option value="Birmingham Conservatoire">Birmingham Conservatoire</option><option value="Bishop Grosseteste University">Bishop Grosseteste University</option><option value="University Centre at Blackburn College">University Centre at Blackburn College</option><option value="University of Bolton">University of Bolton</option><option value="Bournemouth University">Bournemouth University</option><option value="BPP University College of Professional Studies">BPP University College of Professional Studies</option><option value="University of Bradford">University of Bradford</option><option value="University of Bradford School of Management">University of Bradford School of Management</option><option value="University of Brighton">University of Brighton</option><option value="Brighton and Sussex Medical School">Brighton and Sussex Medical School</option><option value="University of Bristol">University of Bristol</option><option value="Brunel University, Uxbridge and London">Brunel University, Uxbridge and London</option><option value="University of Buckingham">University of Buckingham</option><option value="Buckinghamshire New University,">Buckinghamshire New University,</option><option value="High Wycombe University of Cambridge">High Wycombe University of Cambridge</option><option value="Canterbury Christ Church University">Canterbury Christ Church University</option><option value="Cardiff University">Cardiff University</option><option value="Cardiff International Academy of Voice">Cardiff International Academy of Voice</option><option value="Cardiff University School of Medicine">Cardiff University School of Medicine</option><option value="Cardiff Metropolitan University (UWIC)">Cardiff Metropolitan University (UWIC)</option><option value="University of Central Lancashire">University of Central Lancashire</option><option value="University of Chester">University of Chester</option><option value="University of Chichester">University of Chichester</option><option value="Crichton University Campus">Crichton University Campus</option><option value="City University London">City University London</option><option value="Cass Business School">Cass Business School</option><option value="City Law School">City Law School</option><option value="Coventry University">Coventry University</option><option value="Cranfield University">Cranfield University</option><option value="University for the Creative Arts">University for the Creative Arts</option><option value="University of Cumbria">University of Cumbria</option><option value="De Montfort University">De Montfort University</option><option value="University of Derby">University of Derby</option><option value="University of Dundee">University of Dundee</option><option value="Durham University">Durham University</option><option value="University of East Anglia">University of East Anglia</option><option value="University of East London">University of East London</option><option value="University of East London School of Law">University of East London School of Law</option><option value="Edge Hill University">Edge Hill University</option><option value="University of Edinburgh">University of Edinburgh</option><option value="Moray House School of Education">Moray House School of Education</option><option value="Edinburgh Napier University">Edinburgh Napier University</option><option value="University of Essex">University of Essex</option><option value="University of Exeter">University of Exeter</option><option value="Camborne School of Mines">Camborne School of Mines</option><option value="Falmouth University">Falmouth University</option><option value="Dartington College of Arts">Dartington College of Arts</option><option value="University of Glamorgan, Cardiff">University of Glamorgan, Cardiff</option><option value="University of Glasgow">University of Glasgow</option><option value="Glasgow Caledonian University">Glasgow Caledonian University</option><option value="University of Gloucestershire">University of Gloucestershire</option><option value="University of Greenwich">University of Greenwich</option><option value="Glyndŵr University, Wrexham">Glyndŵr University, Wrexham</option><option value="Harper Adams University">Harper Adams University</option><option value="Heriot-Watt University">Heriot-Watt University</option><option value="University of Hertfordshire, Hatfield">University of Hertfordshire, Hatfield</option><option value="University of the Highlands & Islands">University of the Highlands & Islands</option><option value="University of Huddersfield">University of Huddersfield</option><option value="University of Hull, Hull and Scarborough">University of Hull, Hull and Scarborough</option><option value="Hull York Medical School (HYMS)">Hull York Medical School (HYMS)</option><option value="Imperial College London">Imperial College London</option><option value="Imperial College at Wye">Imperial College at Wye</option><option value="Royal School of Mines">Royal School of Mines</option><option value="Keele University, Staffordshire">Keele University, Staffordshire</option><option value="University of Kent, Canterbury and Medway">University of Kent, Canterbury and Medway</option><option value="Kingston University">Kingston University</option><option value="Lancaster University">Lancaster University</option><option value="University of Leeds">University of Leeds</option><option value="Leeds Metropolitan University">Leeds Metropolitan University</option><option value="Leeds Trinity University">Leeds Trinity University</option><option value="University of Leicester">University of Leicester</option><option value="University of Lincoln, Lincoln">University of Lincoln, Lincoln</option><option value="University of Liverpool">University of Liverpool</option><option value="Liverpool School of Tropical Medicine">Liverpool School of Tropical Medicine</option><option value="Liverpool Hope University">Liverpool Hope University</option><option value="Liverpool John Moores University">Liverpool John Moores University</option><option value="University of London">University of London</option><option value="Birkbeck, University of London">Birkbeck, University of London</option><option value="Central School of Speech and Drama">Central School of Speech and Drama</option><option value="Courtauld Institute of Art">Courtauld Institute of Art</option><option value="Goldsmiths, University of London">Goldsmiths, University of London</option><option value="Heythrop College">Heythrop College</option><option value="Institute of Cancer Research">Institute of Cancer Research</option><option value="Institute of Education">Institute of Education</option><option value="King\'s College London">King\'s College London</option><option value="Institute of Psychiatry (IOP)">Institute of Psychiatry (IOP)</option><option value="London Business School">London Business School</option><option value="London School of Economics and Political Science (LSE)">London School of Economics and Political Science (LSE)</option><option value="London School of Hygiene and Tropical Medicine">London School of Hygiene and Tropical Medicine</option><option value="Queen Mary, University of London">Queen Mary, University of London</option><option value="Royal Academy of Music">Royal Academy of Music</option><option value="Royal Holloway, University of London, Egham">Royal Holloway, University of London, Egham</option><option value="Royal Veterinary College">Royal Veterinary College</option><option value="St George\'s, University of London">St George\'s, University of London</option><option value="School of Advanced Study">School of Advanced Study</option><option value="Institute for the Study of the Americas">Institute for the Study of the Americas</option><option value="Institute of Advanced Legal Studies">Institute of Advanced Legal Studies</option><option value="Institute of Classical Studies">Institute of Classical Studies</option><option value="Institute of Commonwealth Studies">Institute of Commonwealth Studies</option><option value="Institute of English Studies">Institute of English Studies</option><option value="Institute of Germanic & Romance Studies">Institute of Germanic & Romance Studies</option><option value="Institute of Historical Research">Institute of Historical Research</option><option value="Institute of Musical Research">Institute of Musical Research</option><option value="Institute of Philosophy">Institute of Philosophy</option><option value="Warburg Institute">Warburg Institute</option><option value="School of Oriental and African Studies (SOAS)">School of Oriental and African Studies (SOAS)</option><option value="School of Pharmacy, University of London">School of Pharmacy, University of London</option><option value="University College London (UCL)">University College London (UCL)</option><option value="Eastman Dental Institute">Eastman Dental Institute</option><option value="Institute of Archaeology">Institute of Archaeology</option><option value="Institute of Child Health">Institute of Child Health</option><option value="Institute of Neurology">Institute of Neurology</option><option value="School of Slavonic and East European Studies (SSEES)">School of Slavonic and East European Studies (SSEES)</option><option value="University Marine Biological Station">University Marine Biological Station</option><option value="London Metropolitan University">London Metropolitan University</option><option value="London South Bank University">London South Bank University</option><option value="Loughborough University">Loughborough University</option><option value="University of Manchester">University of Manchester</option><option value="Manchester Business School">Manchester Business School</option><option value="Manchester Metropolitan University">Manchester Metropolitan University</option><option value="Middlesex University, London">Middlesex University, London</option><option value="Newcastle University">Newcastle University</option><option value="Newman University">Newman University</option><option value="University of Northampton">University of Northampton</option><option value="Northumbria University, Newcastle upon Tyne">Northumbria University, Newcastle upon Tyne</option><option value="Norwich University of the Arts">Norwich University of the Arts</option><option value="University of Nottingham">University of Nottingham</option><option value="Nottingham Trent University">Nottingham Trent University</option><option value="The Open University">The Open University</option><option value="University of Oxford">University of Oxford</option><option value="Oxford Brookes University">Oxford Brookes University</option><option value="Peninsula College of Medicine and Dentistry">Peninsula College of Medicine and Dentistry</option><option value="University of Plymouth">University of Plymouth</option><option value="University of Portsmouth">University of Portsmouth</option><option value="Queen\'s University Belfast">Queen\'s University Belfast</option><option value="St Mary\'s University College">St Mary\'s University College</option><option value="Stranmillis University College">Stranmillis University College</option><option value="Queen Margaret University">Queen Margaret University</option><option value="University of Reading">University of Reading</option><option value="Henley Business School">Henley Business School</option><option value="The Robert Gordon University">The Robert Gordon University</option><option value="Roehampton University, London">Roehampton University, London</option><option value="Royal College of Art, London">Royal College of Art, London</option><option value="University of St Andrews">University of St Andrews</option><option value="University of Salford">University of Salford</option><option value="University of Sheffield">University of Sheffield</option><option value="Sheffield Hallam University">Sheffield Hallam University</option><option value="University of Southampton">University of Southampton</option><option value="Southampton Solent University">Southampton Solent University</option><option value="Staffordshire University">Staffordshire University</option><option value="University of Stirling">University of Stirling</option><option value="University of Strathclyde">University of Strathclyde</option><option value="University of Sunderland">University of Sunderland</option><option value="University of Surrey, Guildford">University of Surrey, Guildford</option><option value="University of Sussex">University of Sussex</option><option value="Swansea Metropolitan University">Swansea Metropolitan University</option><option value="Swansea University">Swansea University</option><option value="Teesside University">Teesside University</option><option value="University of Ulster">University of Ulster</option><option value="University of Wales">University of Wales</option><option value="University of Wales, Newport">University of Wales, Newport</option><option value="University of Wales, Trinity Saint David">University of Wales, Trinity Saint David</option><option value="University of Warwick">University of Warwick</option><option value="University of West London">University of West London</option><option value="London College of Music">London College of Music</option><option value="University of Westminster">University of Westminster</option><option value="University of the West of England">University of the West of England</option><option value="University of the West of Scotland">University of the West of Scotland</option><option value="University of Winchester">University of Winchester</option><option value="University of Wolverhampton">University of Wolverhampton</option><option value="University of Worcester">University of Worcester</option><option value="Worcester Business School">Worcester Business School</option><option value="University of York">University of York</option><option value="York St John University">York St John University</option>'
																	}
																}
															}
														}
													}
												},
												measure : {
													self : '<div class="profile_hub_donate_mesure"></div>',
													branch : {
														text : {
															self : '<div class="profile_hub_donate_mesure_text">Donate ammount :</div>'
														},
														first_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.donate.branch.body.branch.measure.branch.first_ammount.self;
																		self.val("£"+change.new.split(".").shift());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="£0" readonly>'
														},
														seperator : {
															self :'<div class="profile_hub_donate_mesure_seperate"></div>'
														},
														second_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.donate.branch.body.branch.measure.branch.second_ammount.self;
																		self.val(change.new.split(".").pop());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="00" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_donate_mesure_incrimentor"></div>',
															branch : {
																up   : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) + 0.5;
																				if ( value > state.account.credit ) value = parseFloat(state.account.credit);
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_donate_mesure_incrimentor_up"></div>'
																},
																down : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) - 0.5;
																				if ( value < 0.00 ) value = 0.00
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_donate_mesure_incrimentor_down"></div>'
																}
															}
														}
													}
												},
												donate : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) { 

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
																			university : this.send_to.branch.text.branch.select.self.val(),
																			amount     : state.withdraw,
																			date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate()
																		}
																	}
																}, function (response) {}, "json");

																state.account.credit          -= state.withdraw;
																state.account.credit           = state.account.credit.toFixed(2);
																state.withdraw                 = "0.00";
																animate.popup                  = false;
																state.save_account             = true;
															}
														}
													},
													self :'<div class="profile_hub_donate_save">Donate now</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
															}
														}
													},
													self : '<div class="profile_hub_donate_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								reset : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.reset.self;
												if ( change.new === "reset" ) {
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self   : '<div class="profile_hub_reset"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_reset_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_reset_logo">',
												text : '<div class="profile_hub_reset_description">Password Change</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_reset_body"></div>',
											branch : {
												inner : {
													self : '<div class="profile_hub_reset_input_wrap"></div>',
													branch : {
														notification : {
															instructions : {
																observers : [
																	{ 
																		who      : state.notification.reset,
																		property : "notify",
																		call     : function (change) {
																			var self = world.wrap.branch.hub_popup.branch.reset.branch.body.branch.inner.branch.notification.self;
																			( change.new)? self.css({ display : "block" }) : self.css({ display : "none" });
																		}
																	},
																	{ 
																		who      : state.notification.reset,
																		property : "text",
																		call     : function (change) {
																			var self = world.wrap.branch.hub_popup.branch.reset.branch.body.branch.inner.branch.notification.self;
																			self.text(change.new);
																		}
																	}
																]
															},
															self : '<div class="profile_hub_reset_notification">Passwords do not match</div>'
														},
														old_password_label : {
															self : '<div class="profile_hub_reset_label">Current password</div>'
														},
														old_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="Current Password">'
														},
														new_password_label : {
															self : '<div class="profile_hub_reset_label">New password</div>'
														},
														new_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="New password">'
														},
														confirm_new_password : {
															self : '<input type="password" class="profile_hub_reset_input" placeholder="Confirm password">'
														}
													}
												},
												save : {
													instructions : { 
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 

																var password         = this.inner.branch.old_password.self.val(), 
																	new_password     = this.inner.branch.new_password.self.val().trim(), 
																	confirm_password = this.inner.branch.confirm_new_password.self.val().trim();

																state.notification.reset.notify = true;

																if ( password !== state.account.password ) {
																	state.notification.reset.text = "Old password is incorrect";
																	return;
																}
																if ( password !== state.account.password ) {
																	state.notification.reset.text = "Old password is incorrect";
																	return;
																}
																if (new_password === "" ) { 
																	state.notification.reset.text = "No new password set";
																	return;
																}
																if (new_password !== confirm_password ) {
																	state.notification.reset.text = "Passwords do not match";
																	return;
																}

																state.notification.reset.text   = "Password Changed";
																state.account.password          = new_password;
																state.save_account              = true;
																this.inner.branch.old_password.self.val("");
																this.inner.branch.new_password.self.val("");
																this.inner.branch.confirm_new_password.self.val("");
															}
														}
													},
													self :'<div class="profile_hub_reset_save">Save Changes</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
																state.notification.reset.notify = false;
																this.inner.branch.old_password.self.val("");
																this.inner.branch.new_password.self.val("");
																this.inner.branch.confirm_new_password.self.val("");
															}
														}
													},
													self :'<div class="profile_hub_reset_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								withdraw : {
									instructions : {
										observe : {
											who      : animate,
											property : "popup",
											call     : function (change) {
												var box = world.wrap.branch.hub_popup.branch.withdraw.self;
												if ( change.new === "withdraw" ) {
													box.css({ display : "block", top : window.screen.availHeight+"px" }).animate({ top : "0px" }, 300);
												} else {
													box.animate({ top : window.screen.availHeight+"px" }, 200, function () {
														box.css({ display : "none" });
													});
												}
											}
										}
									},
									self : '<div class="profile_hub_withdraw"></div>',
									branch : {
										head : {
											self : '<div class="profile_hub_withdraw_logo_wrap"></div>',
											last_branch : {
												logo : '<img src="'+ frameworkuri +'/CSS/Includes/works/header_logo.png" class="profile_hub_withdraw_logo">',
												text : '<div class="profile_hub_withdraw_description">Withdraw Funds</div>'
											}
										},
										body : {
											self : '<div class="profile_hub_withdraw_body"></div>',
											branch : {
												cheque_name : {
													self : '<div class="profile_hub_withdraw_line"></div>',
													branch : {
														description : {
															self : '<div class="profile_hub_withdraw_line_description">Cheque to me made out to :</div>'
														},
														text : {
															self : '<div class="profile_hub_withdraw_line_text_wrap"></div>',
															branch : {
																input : {
																	instructions : {
																		observers : [
																			{
																				who : state.account,
																				property : "first_name",
																				call : function (change) { 
																					if ( state.edit.withdraw.first_name ) return;
																						var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.cheque_name.branch.text.branch.input.self;
																							self.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "first_name",
																				call : function (change) { 
																					var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.cheque_name.branch.text.branch.input.self;
																						self.attr("readonly", (!change.new));
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
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.edit.withdraw.first_name ) {
																			state.edit.withdraw.first_name = false;
																			change.self.text("edit");
																		} else { 
																			state.edit.withdraw.first_name = true;
																			change.self.text("save");
																		}
																	}
																}
															},
															self : '<div class="profile_hub_withdraw_line_edit">edit</div>'
														}
													}
												},
												send_to : {
													self : '<div class="profile_hub_withdraw_line"></div>',
													branch : {
														description : {
															self : '<div class="profile_hub_withdraw_line_description">Cheque to be sent to :</div>'
														},
														text : {
															self : '<div class="profile_hub_withdraw_line_text_wrap"></div>',
															branch : {
																address : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "address",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.address.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.address.self;
																						input.attr("readonly", (!change.new));
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
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																town    : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "town",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.town.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.town.self;
																						input.attr("readonly", (!change.new));
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
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																area    : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "area",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.area.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.area.self;
																						input.attr("readonly", (!change.new));
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
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																},
																post_code : {
																	instructions : {
																		observers : [
																			{
																				who     : state.addresses[0],
																				property: "post_code",
																				call    : function (change) {
																					if ( state.edit.withdraw.address ) return;
																						var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.post_code.self;
																						input.val(change.new);
																				}
																			},
																			{
																				who      : state.edit.withdraw,
																				property : "address",
																				call     : function (change) {
																					var input = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.send_to.branch.text.branch.post_code.self;
																						input.attr("readonly", (!change.new));
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
																	self : '<input type="text" class="profile_hub_withdraw_line_text" value="" readonly>'
																}
															}
														},
														edit : {
															instructions : {
																on : {
																	the_event : "click",
																	is_asslep : false,
																	call      : function (change) { 
																		if ( state.edit.withdraw.address ) {
																			state.edit.withdraw.address = false;
																			change.self.text("edit");
																		} else { 
																			state.edit.withdraw.address = true;
																			change.self.text("save");
																		}
																	}
																}
															},
															self : '<div class="profile_hub_withdraw_line_edit">edit</div>'
														}
													}
												},
												measure : {
													self : '<div class="profile_hub_withdraw_mesure"></div>',
													branch : {
														text : {
															self : '<div class="profile_hub_withdraw_mesure_text">Withdraw ammount :</div>'
														},
														first_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.measure.branch.first_ammount.self;
																		self.val("£"+change.new.split(".").shift());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="0" readonly>'
														},
														seperator : {
															self : '<div class="profile_hub_withdraw_mesure_seperate"></div>'
														},
														second_ammount : {
															instructions : {
																observe : {
																	who      : state,
																	property : "withdraw",
																	call     : function (change) { 
																		var self = world.wrap.branch.hub_popup.branch.withdraw.branch.body.branch.measure.branch.second_ammount.self;
																		self.val(change.new.split(".").pop());
																	}
																}
															},
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="00" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_withdraw_mesure_incrimentor"></div>',
															branch : {
																up   : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) + 0.5;
																				if ( value > state.account.credit ) value = parseFloat(state.account.credit);
																				value = value.toFixed(2);
																				console.log(value);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_withdraw_mesure_incrimentor_up"></div>'
																},
																down : {
																	instructions : {
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function (change) {
																				var value = parseFloat(state.withdraw) - 0.5;
																				if ( value < 0.00 ) value = 0.00
																				value = value.toFixed(2);
																				state.withdraw = value;
																			}
																		}
																	},
																	self : '<div class="profile_hub_withdraw_mesure_incrimentor_down"></div>'
																}
															}
														}
													}
												},
												withdraw : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function (change) {
																
																if ( state.withdraw === 0 || state.withdraw === "0.00" ) return;
																var date = new Date();
																$.post(ajaxurl, {
																	action     : "set_ticket",
																	method     : "cheque",
																	paramaters : {
																		cheque : {
																			email      : state.account.email,
																			first_name : state.account.first_name,
																			second_name: state.account.second_name,
																			date       : date.getFullYear() +"/"+ date.getMonth() +"/"+ date.getDate(),
																			amount     : state.withdraw,
																			address    : state.addresses[0].address,
																			town       : state.addresses[0].town,
																			area       : state.addresses[0].area,	
																			post_code  : state.addresses[0].post_code
																		}
																	}
																}, function () {}, "json");

																state.edit.withdraw.first_name = false;
																state.edit.withdraw.address    = false;
																state.account.last_withdraw    = date.getFullYear() +"-"+ date.getMonth() +"-"+ date.getDate();
																state.account.credit          -= state.withdraw;
																state.account.credit           = state.account.credit.toFixed(2);
																state.withdraw                 = "0.00";
																animate.popup                  = false;
																state.save_account             = true;
															}
														}
													},
													self : '<div class="profile_hub_withdraw_and_send">Withdraw & Send</div>'
												},
												cancel : {
													instructions : {
														on : {
															the_event : "click",
															is_asslep : false,
															call      : function () { 
																animate.popup = false;
																state.edit.withdraw.first_name = false;
																state.edit.withdraw.address    = false;
															}
														}
													},
													self : '<div class="profile_hub_withdraw_cancel">Cancel</div>'
												}
											}
										}
									}
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
												bank : {
													self : '<div class="profile_hub_bank profile_hub_box_right"></div>',
													branch : {
														bar : {
															self : '<div class="profile_hub_bank_bar"></div>',
															branch : {
																icon : { 
																	instructions : {
																		open : false,
																		on : {
																			the_event : "click",
																			is_asslep : false,
																			call      : function () {
																				var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
																				if ( this.icon.instructions.open ) {
																					popup.css({ display : "none" });
																					this.icon.instructions.open = false;
																				} else { 
																					popup.css({ display : "block" });
																					this.icon.instructions.open = true;
																				}																				
																			}
																		}
																	},
																	self : '<div class="with-icon-for-profile-hub-bank"></div>'
																},
																greeting : {
																	self : '<div class="profile_hub_bank_greeting">RecyclaBank</div>'
																}
															}
														},
														information_box : {
															self : '<div class="profile_hub_bank_info"></div>',
															branch : {
																title :    { 
																	self : '<div class="profile_hub_bank_info_title">Recyclabank</div>'
																},
																text :     { 
																	self : '<div class="profile_hub_bank_info_text">All money made from your book sales is conviniently stored in your bank, ready to be withdrawn at any time. Simply select withdraw funds, confirm the name and address of the cheque and we\'ll send it your way. You can also donate a portion of all your balance to your university RAG campagin.</div>'
																},
																close :    { 
																	instructions : {
																		on : {
																			the_event : "click", 
																			is_asslep : false,
																			call      : function (change) { 
																				var popup = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.information_box.self;
																				if ( world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open ) {
																					popup.css({ display : "none" });
																					world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = false;
																				} else { 
																					popup.css({ display : "block" });
																					world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.bar.branch.icon.instructions.open = true;
																				}
																			}	
																		}
																	},
																	self : '<div class="with-icon-for-profile-hub-recyclabank-close"></div>'
																}
																// reminder : { 
																// 	self : '<div class="profile_hub_bank_info_reminder">Don\'t show this again</div>'
																// }
															}
														},
														body : {
															self : '<div class="profile_hub_bank_body"></div>',
															branch : {
																stats : {
																	self : '<div class="profile_hub_bank_status"></div>',
																	branch : {
																		balance : {
																			self : '<div class="profile_hub_bank_stats_first"></div>',
																			branch : {
																				icon :  {
																					self : '<div class="with-icon-pig-for-account-balance"></div>'
																				},
																				label : {
																					self : '<div class="profile_hub_bank_stats_label">Account balance</div>'
																				},
																				input : {
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "credit",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.balance.branch.input.self;
																									self.val("£"+ change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="" readonly>'
																				}
																			}
																		},
																		withdrawal : {
																			self   : '<div class="profile_hub_bank_stats_middle"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-clock-for-account-withdrawal"></div>'
																				},
																				label: { 
																					self : '<div class="profile_hub_bank_stats_label">Last withdrawal</div>'
																				},
																				input: { 
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "last_withdraw",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.withdrawal.branch.input.self;
																								if ( change.new === "0000-00-00") {
																									self.val("never");
																								} else { 
																									self.val(change.new);
																								}
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="never" readonly>'
																				}
																			}
																		},
																		donation : {
																			self   : '<div class="profile_hub_bank_stats_last"></div>',
																			branch : {
																				icon : {
																					self : '<div class="with-icon-hand-for-account-donation"></div>'
																				},
																				label: {
																					self : '<div class="profile_hub_bank_stats_label">Total Donations</div>'
																				},
																				input: {
																					instructions : { 
																						observe : { 
																							who      : state.account,
																							property : "donate",
																							call     : function (change) {	
																								var self = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.bank.branch.body.branch.stats.branch.donation.branch.input.self;
																									self.val("£"+ change.new);
																							}
																						}
																					},
																					self : '<input type="text" class="profile_hub_bank_stats_input" value="0.00" readonly>'
																				}
																			}
																		},
																		button : {
																			self : '<div class="profile_hub_bank_buttons"></div>',
																			branch : {
																				withdraw : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "withdraw";
																							}
																						}
																					},
																					self : '<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>'
																				},
																				donate : {
																					instructions : {
																						on : {
																							the_event : "click",
																							is_asslep : false,
																							call      : function () { 
																								animate.popup = "donate";
																							}
																						}
																					},
																					self : '<div class="with-icon-for-bank-donate">Donate to RAG</div>'
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												},
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
																		scroll : null,
																		observe : {
																			who      : animate,
																			property : "scroll",
																			call     : function (change) { 

																				var basket = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.tracking.branch.body.branch.wrap;
																					
																					basket.instructions.scroll = new alpha.scroll_bar({
																						parent : basket.self[0],
																						wrap   : basket.branch.items.self[0],
																						holder : basket.branch.items.branch.wrap.self[0],
																						scroll : basket.branch.scroll.self[0],
																						handle : basket.branch.scroll.branch.handle.self[0],
																						size   : 300
																					});
																			}
																		}
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
																		items : {																						
																			self : '<div class="profile_hub_tracking_items"></div>',
																			branch : {
																				wrap : {
																					self : '<div class="profile_hub_tracking_items_inner"></div>',
																					branch : {
																						promise : {
																							self : '<div class="profile_hub_tracking_items_group"></div>',
																							branch : {
																								title : {
																									self : '<div class="profile_hub_tracking_title">Price promises</div>'
																								},
																								wrap : {
																									instructions : { 
																										observe : {
																											who      : state.account,
																											property : "price_promise",
																											call     : function (change) {
																												if ( state.account.price_promise === null ) return;
																												var format, manifest, map, append_to;
																													format = { 
																														self : '<div class="profile_hub_tracking_item"></div>',
																														branch : {
																															image : {
																																self : '<img src="" class="profile_hub_tracking_item_image">'
																															},
																															text : {
																																self : '<div class="profile_hub_tracking_item_text"></div>',
																																branch : {
																																	title : {
																																		self : '<div class="profile_hub_tracking_item_text_title"></div>'
																																	},
																																	author : {
																																		self : '<div class="profile_hub_tracking_item_text_author"></div>'
																																	},
																																	quote : {
																																		self : '<div class="profile_hub_tracking_item_text_quote"></div>'
																																	},
																																	isbn : {
																																		self : '<div class="profile_hub_tracking_item_text_isbn"></div>	'
																																	}
																																}
																															},
																															options : {
																																self : '<div class="profile_hub_tracking_item_options"></div>',
																																branch : {
																																	image : {
																																		self : '<img src="'+frameworkuri+'/CSS/Includes/works/profilehub/freepost.png" class="profile_hub_tracking_item_options_image">'
																																	},
																																	remove : {
																																		instructions : {
																																			on : {
																																				the_event : "click",
																																				is_asslep : false,
																																				call      : function (change) { 
																																					if (confirm("Are you sure you want to remove this book from the price promise list?")) {
																																						var promise = state.account.price_promise,
																																							index   = change.self.attr("id");
																																							promise.splice(index, 1);
																																							state.account.price_promise = promise;
																																							state.save_account = true;
																																					}
																																				}
																																			}
																																		},
																																		self : '<div id="" class="with-icon-for-profile-hub-tracking-remove-book">Remove book</div>'
																																	}
																																}
																															}
																														}
																													};

																													map = [
																														{
																															path : "branch.image.self.src",
																															value: "image"
																														},
																														{
																															path : "branch.text.branch.title.self.text",
																															value: "title"
																														},
																														{
																															path : "branch.text.branch.author.self.text",
																															value: "author"
																														},
																														{
																															path : "branch.text.branch.isbn.self.text",
																															value: "isbn"
																														},
																														{
																															path : "branch.text.branch.quote.self.text",
																															value: "price"
																														},
																														{
																															path : "branch.options.branch.remove.self.id",
																															value: "id"
																														}
																													];
																													console.log("reconstruct");
																													append_to = world.wrap.branch.hub.branch.wrap.branch.right_boxes.branch.tracking.branch.body.branch.wrap.branch.items.branch.wrap.branch.promise.branch.wrap;
																													append_to.self.empty();
																													manifest = alpha.format(format, append_to.self, state.account.price_promise.length );
																														
																													for (var index = 0; index < state.account.price_promise.length; index++) {
																														state.account.price_promise[index].id = index;
																														alpha.parse(map, manifest[index+1], state.account.price_promise[index]);
																													};
																													append_to.branch = manifest;
																											}
																										}
																									},		
																									self : '<div class="profile_hub_tracking_items_sub_group"></div>'
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
										}
									}
								}
							}
						},
						stock : {
						}
					}
				},
				footer : {
					self   : '<div class="footer"></div>',
					branch : { 
						wrap : {
							self : '<div class="footer_wrap"></div>',
							branch : {
								navigation : {
									self   : '<div class="footer_navigation"></div>',
									branch : {
										contact : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "contact";
													}
												}
											},
											self : '<div class="footer_text">Contact Us</div>'
										},
										media : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "media";
													}
												}
											},
											self : '<div class="footer_text">Media</div>'
										},
										word : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "word_from_us";
													}
												}
											},
											self : '<div class="footer_text">A Word From Us</div>'
										},
										// terms : {
										// 	instructions : {
										// 		on : {
										// 			the_event : "click",
										// 			is_asslep : false,
										// 			call      : function (change) {
										// 				animate.pop.outside = "legal";
										// 			}
										// 		}
										// 	},
										// 	self : '<div class="footer_text">Terms & Conditions</div>'
										// },
										advertising : {
											instructions : {
												on : {
													the_event : "click",
													is_asslep : false,
													call      : function (change) {
														animate.pop.outside = "advertising";
													}
												}
											},
											self : '<div class="footer_text">Advertising</div>'
										}
									}
								},
								logos : {
									self : '<div class="footer_logos"></div>',
									branch : {
										logos : {
											self : '<img src="'+frameworkuri+'/CSS/Includes/works/footer_logos.png" class="footer_logo">'
										}
									}
								}
							}
						}
					}
				}
			};

			world = world.manifest($('body'));
			router.begin();
			animate.scroll = true;
			state.begin    = true;

			var test = [
				{	
					asin : "1780873697",
					author:"Paul Glendinning",
					binding : "Paperback",
					id : 0,
					image : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
					isbn : "1780873697",
					lowest_new_price:"243",
					lowest_used_price:"207",
					number_in_stock:"1",
					pages:"416",
					price:6.99	,
					title:"Maths in Minutes"
				},
				{	
					asin : "1780873697",
					author:"Paul Glendinning...",
					binding : "Paperback",
					id : 0,
					image : "http://ecx.images-amazon.com/images/I/51-mYD0PU7L._SL160_.jpg",
					isbn : "1780873697",
					lowest_new_price:"243",
					lowest_used_price:"207",
					number_in_stock:"1",
					pages:"416",
					price:6.99	,
					title:"Maths in M..."
				}
			];

			// for ( var part in state.viewed_item.parts ) state.viewed_item.parts[part] = test[0][part];
			// 	state.viewed_item.show = true;				
		});									
	</script>

</head>
<body>