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
				book.results = {};

			var router = new alpha.route({
				on       : function () {},
				clean_up : function () {},
				sell   : {
					on   : function () {
						world.wrap.branch.sell.self.css({ display : "block" });
					},
					clean_up : function () {
						world.wrap.branch.sell.self.css({ display : "none" });
					}
				}
			});

			var world = new alpha.thought;
			world.thought = { 
				wrap : {
					self   : '<div class="wrap"></div>',
					branch : {
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
													self : '<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/header_logo.png" alt="" class="header_invisible_box_image_title">',
												},
												text : {
													self : '<div class="header_invisible_box_text_wrap"></div>',
													last_branch : { 
														title : '<div class="header_invisible_box_text_title">What We Do</div>',
														paragraph : '<div class="header_invisible_box_text">Recyclabook accepts over a million different titles, you can easily sell your book and get quick and safe payment</div>'
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
																			var amazon = new alpha.amazon({
																				typed    : value,
																				callback : function (books) { 
																					if ( books !== undefined ) {
																						book.results = books;
																						router.change_url("sell");
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
											self : '<span class="with-icon-progress-pop-up-arrow"></span>'
										},
										// logo : {
										// 	self   : '<div data-function-instructions="{\'page\' : \'homepage_body_wrap\' }" data-function-to-call="front.prototype.change_page" class="logo_for_bar"></div>',
										// 	last_branch : {
										// 		logo : '<span data-function-instructions="{\'page\' : \'homepage_body_wrap\' }" data-function-to-call="front.prototype.change_page" class="with-icon-logo"></span>'
										// 		}
										// 	}
										navigation : {
											self   : '<div class="navigation_wrap"></div>',
											branch : {
												wrap : {
													self   : '<div class="navigation_inner_wrap"></div>',
													branch : {
														navigation : {
															self   : '<div class="navigation"></div>',
															last_branch : {
																how_it_works : '<a href="/"          id="homepage_navigation"   class="navigation_button with-icon-for-navigation-text-for-bar-active">How It Works</a>',
																recyclabus   : '<a href="recyclabus" id="recyclabus_navigation" class="navigation_button navigation_text_for_bar">Recyclabus</a>',
																sell_books   : '<a href="sell"       id="sell_books_navigation"  class="navigation_button navigation_text_for_bar">Sell Books</a>'
															}
														},
														progress : {
															self   : '<div class="progress_icons_for_bar_wrap"></div>',
															branch : {								
																welcome : {
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
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
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
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
																	self   : '<div class="progress_icon_for_bar"></div>',
																	branch : {
																		circle : {
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
											self   : '<div class="progress_pop_up"></div>',
											branch : {
												title : {
													self   : '<div class="progress_pop_up_title"></div>',
													branch : {
														text : {
															self : '<span class="progress_pop_up_title_text"></span>'
														},
														icon : {
															self   : '<span class="progress_pop_up_title_icon"></span>',
															last_branch : {
																icon :'<span class="with-icon-welcome-progress-bar"></span>'
															}
														}
													},
													text : {
														self : '<p class="progress_pop_up_text"></p>'
													}
												}
											}
										},						
										welcome_popup : {
											self   : '<div class="progress_welcome_pop_up"></div>',
											branch : {
												sign_in : {
													self   : '<div class="progress_welcome_sign_in_box"></div>',
													last_branch : {
														title    : '<div class="progress_welcome_sign_in_box_title">Sign In</div>',
														email    : '<input type="text" class="progress_welcome_sign_in_box_input" placeholder="Email Address" value="">',
														password : '<input type="password" class="progress_welcome_sign_in_box_input" placeholder="Password" value="">',
														forgoten : '<span class="progress_welcome_sign_in_box_forgot_password">Forgoten Password?</span>'
													}
												},
												register : {
													self   : '<div class="progress_welcome_register_box"></div>',
													last_branch : {
														text   : '<div class="progress_welcome_register_box_text">New To Recyclabook >>></div>',
														button : '<a href="create_account" class="progress_welcome_register_box_button">Sign Up</a>'
													}
												}
											}
										},							
										user_button : {
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
												title : {
													self : '<div class="user_pop_up_title">Hi, Mcgee</div>' 
												},
												edit_option : {
													self : '<div class="user_pop_up_option">Edit Account</div>'
												},
												tracking_option : {
													self : '<div class="user_pop_up_option">Tracking</div>'
												},
												account : {
													self : '<div class="user_pop_up_option">Account History</div>'
												},
												sign_in_wrap : {
													self : '<div class="user_pop_up_title_white">Sign in Or </div>',
													last_branch : {
														register : '<span class="user_pop_up_title_highlight">Register</span> ' 
													}
												},
												email : {
													self : '<input type="text" class="user_pop_up_option_input" placeholder="Username">'
												},
												password : {
													self : '<input type="password" class="user_pop_up_option_input" placeholder="Password">'
												},
												forgotten_password : {
													self : '<div class="user_pop_up_options_forgot_password">forgottten password?</div>' 
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
															self :  '<div id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">Where is My ISBN </div>',
															last_branch : {
																arrow :  '<span id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="where_is_my_isbn_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																image :  '<img src="'+frameworkuri+'/CSS/Includes/works/where_is_my_isbn.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">',
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text">Just look at the back of your book and find the 13 or 9 digit number bellow the barcode.</div>'
															}
														}
													}
												},
												button_two : {
													self   :  '<div class="homepage_how_it_works_box_second_button_wrap"></div>',
													branch : { 
														trigger : {
															self :  '<div id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">Freepost Options</div>',
															last_branch : {
																arrow :  '<span id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>'
															}
														},
														text_box  : {
															self :  '<div id="freepost_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph_one :  '<div class="homepage_how_it_works_box_button_expanded_text">We\'ll send you a postage pack, inside you\'ll get an envelope with which you can post your books for free</div>',
																paragraph_two :  '<div class="homepage_how_it_works_box_button_expanded_text_highlight">or</div>',
																paragraph_three :  '<div class="homepage_how_it_works_box_button_expanded_text">If you have your own package you can print off our own packaging label from this website</div>',
																image :  '<img src="'+frameworkuri+'/CSS/Includes/works/freepost_options.png" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">'				
															}
														}
													}
												},
												button_three : {
													self   :  '<div class="homepage_how_it_works_box_third_button_wrap"></div>',
													branch : { 
														trigger : {
															self :  '<div  id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_last_box_button">How Am I Being Paid</div>',
															last_branch : {
																arrow : '<span id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>' 
															}
														},
														text_box  : {
															self :  '<div id="paid_toggle" class="homepage_how_it_works_box_button_expanded"></div>',
															last_branch : {
																paragraph : '<div class="homepage_how_it_works_box_button_expanded_text">Dont worry about filling in your bank details, we\'ll send you a cheque the same day we recieve your books.</div>'
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
													self : '<div class="homepage_recyclabus_box_button_wrap"></div>',
													last_branch : {
														text  : '<div data-function-instructions="{\'page\' : \'recyclabus\'}" data-function-to-call="front.prototype.change_page" class="homepage_recyclabus_box_button_text">Find Out More</div>',
														arrow :'<div class="with-icon-recyclabus-find-out-more-arrow"></div>'
													},
												},
												recyclabus_image : {
													self :'<img src="'+ frameworkuri +'/CSS/Includes/works/recyclabus.png"class="homepage_recyclabus_box_image">'
												}
											}
										},
										alies_bar : {
											self : '<div class="homepage_alies_bar"></div>',
											last_branch : {
												iod : '<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/iod.png'; ?>" alt="" class="homepage_ally_bar_image">',
												fsc : '<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/fsc.png'; ?>" alt="" class="homepage_ally_bar_image">',
												recycle :'<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/recycle.png'; ?>" alt="" class="homepage_ally_bar_image">'
											}
										}
									}
								}
							}
						},
						recyclabus : {
							self   : '<section class="recyclabus pages"></section>',
							branch : {
								left : {
									self   : '<div class="recyclabus_half_left"></div>',
									branch : {
										title : {
											self : '<div class="recyclabus_title">Recycla</div>',
											last_branch : { 
												highlight : '<span class="recyclabus_title_highlight">Bus</span>'
											}
										},
										short_description : {
											self : '<div class="recyclabus_title_description">The idea of Recyclabus is to make it as simple as possible for you to sell your textbooks.</div>'
										},
										description : {
											self   : '<div class="recyclabus_description_box"></div>',
											last_branch : {
												paragraph_one   : '<div class="recyclabus_description_box_title">What is recyclabus?</div>',
												paragraph_two   : '<div class="recyclabus_description_box_paragraph">Each Recyclabus will be manned by one of our book buyers, ready with a bar-code scanner to scan your books and pay your instantly.</div>',
												paragraph_three : '<div class="recyclabus_description_box_paragraph">The bus will be coming to your university towards the end of your exams, we\'ll be accepting over 1 million titles, so please visit this page nearer the time so you don\'t miss the bus and don\'t miss getting some money for the books you no longer need.</div>',
												paragraph_four  : '<div class="recyclabus_description_box_white_paragraph">On the day of the event we\'ll also have lots of exciting giveaways, so stay tuned to whats going on and what were giving away.</div>'
											}
										}
									}
								},
								right : {
									self   : '<div class="recyclabus_half"></div>', 
									branch : {
										wrap : {
											self   : '<div class="recyclabus_half_dates_wrap"></div>',
											branch : {
												dates : {
													self   : '<div class="recyclabus_dates_wrap"></div>',
													branch : {
														level_one  : {
															self   : '<div class="recyclabus_dates_level_one"></div>',
															branch : {
																text : {
																	self   : '<div class="recyclabus_dates_level_one_text_wrap"></div>',
																	last_branch : {
																		title_one : '<div class="recyclabus_dates_title_one">Dates</div>',
																		title_two : '<div class="recyclabus_dates_title_two">Released On</div>'
																	}
																},
																icon : {
																	self   : '<div class="recyclabus_dates_icon"></div>',
																	last_branch : {
																		image : '<img src="'+ frameworkuri +'/CSS/Includes/works/calendar.png">'
																	}
																}
															}
														},
														level_two : {
															self   : '<div class="recyclabus_dates_level_two"></div>',
															branch : {
																title_three : {
																	self   : '<div class="recyclabus_dates_title_three">1</div>',
																	last_branch : {
																		super_script : '<span class="recyclabus_dates_title_three_superscript">st.</span>'
																	}
																},
																title_four : {
																	self : '<div class="recyclabus_dates_title_four">April</div>'
																}
															}
														}
													}
												},
												dates_highlight : {
														self : '<div class="recyclabus_dates_highlight">If you give us your email and university well send you a reminder when were coming your way</div>'
												},
												inputs_wrap : {
													self   : '<div class="recyclabus_dates_input_wrap"></div>',
													last_branch : {
														input_email      : '<input type="text" class="recyclabus_dates_first_input" placeholder="Email">',
														input_university : '<input type="text" class="recyclabus_dates_seach_input" placeholder="University">',
														text             : '<div class="recyclabus_dates_input_text"><strong class="with-icon-lock-for-strong">Don\'t worry,</strong> well only use this information to remind you when you can sell your books</div>'
													}
												},
												buttons_wrap : {
													self   : '<div class="recyclabus_dates_button_wrap"></div>',
													branch : {
														inner_wrap : {
															self   : '<div class="recyclabus_dates_inner_wrap"></div>',
															last_branch : { 
																first_button  : '<div class="recyclabus_dates_first_button">Notify me about recyclabus</div>',
																second_button : '<div class="recyclabus_dates_second_button">Thank you for signing up</div>'
															}
														}
													}
												}
											}
										},
										dates_decorational_arrow : {
											self : '<div class="with-icon-dates-down-arrow"></div>',
										},
										extra_box : {
											self   : '<div class="recyclabus_dates_extra_box"></div>',
											branch : {
												clock_icon : { 
													self : '<div class="with-icon-dates-clock"></div>'
												},
												text : {
													self   : '<div class="recyclabus_dates_extra_text_wrap"></div>',
													branch : {
														title : { 
															self : '<div class="recyclabus_dates_extra_text_title">No Time To Lose?</div>'
														},
														text : {
															self   : '<div class="recyclabus_dates_extra_text">Check out how to sell by freepost and sell to us now</div>',
															last_branch : {
																text_icon : '<div class="recyclabus_dates_extra_text_icon"><span data-function-instructions="{\'page\' : \'homepage_body_wrap\'}" data-function-to-call="front.prototype.change_page"  class="with-icon-recyclabus-dates-extra-text"></span></div>'
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
						sell : {
							self : '<section class="body"></section>',
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
											self   : '<div class="sell_and_buy_basket"></div>',
											branch : {
												stats : { 
													self   : '<div id="buy_basket" class="basket_stats"></div>',
													last_branch : {
														sell_text : '<span class="sell_basket_text">Sell : </span>',
														quote : '<span class="sell_basket_number">0</span>'
													}
												}
											}
										}
									}
								},
								popup : {
									self   : '<div style="display: none;" class="store_basket_pop_up"></div>',
									branch : { 
										arrow : { 
											self : '<div class="with-icon-store-basket-pop-up-arrow"></div>'
										},
										content : {
											self   : '<div class="store_basket_pop_up_content"></div>',
											branch : {
												items : {
													self : '<div class="store_basket_pop_up_content_items_wrap"></div>'
												},
												total : { 
													self   : '<div class="store_basket_pop_up_content_total_wrap"></div>',
													last_branch : {
														text   : '<div class="store_basket_pop_up_content_total_text">Total:</div>',
														number : '<div class="store_basket_pop_up_content_total_number"></div>'
													}
												}									
											}
										},
										buttons : { 
											self   : '<div class="store_basket_pop_up_button_wrap"></div>',
											last_branch : {
												checkout : '<a href="sign_in_or_sign_up" class="store_basket_pop_up_button_first">Check And Continue</a>'
											}
										},
										popup_text : {
											self : '<div class="store_basket_pop_up_text">Currently showing freepost prices</div>'
										},
										content : { 
											self : '<div cass="searched_book_results"></div>'
										}
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
																									change.self.closest('.result_book_inner_wrap')
																									.css({ position : "relative" })
																									.animate({ top : "-45px" }, 400 );

																									console.log(this);
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
															path : "self.class",
															value: "wrap"
														},
														{ 
															path : "branch.wrap.branch.image.self.src",
															value: "image"
														},
														{
															path : "branch.wrap.branch.description.branch.title.self.text",
															value: "title"
														},
														{
															path : "branch.wrap.branch.description.branch.author.self.text",
															value: "author"
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
														
														book.wrap   = wraps.classes[wraps.on_wrap];
														book.title  = book.title.slice(0, 10) +'...';
														book.author = book.author.slice(0, 18) +'...';
														book.price  = "£"+ book.price / 100;
														book.id     = index+1;

														alpha.parse(map, manifest[index+1], book);
														manifest[index+1].branch.wrap.branch.button.branch.wrap.branch.instructions = {
															book : book
														};
														( wraps.on_wrap === 2? wraps.on_wrap = 0 : wraps.on_wrap++ );
													});	
													world.wrap.branch.sell.branch.items.branch = manifest;

													console.log(world.wrap.branch.sell.branch.items.branch);
											}
										},
										on : {
											the_event : "click",
											is_asslep : false, 
											call      : function (change) { 
												var target = $(change.event.target);

												if ( $(change.event.target).hasClass('result_book_add_button_text') ) {
													// target.	
												}
											}
										}
									},
									self : '<div class="result_books"></div>',
								}
							}			
						},
						registration : {
							self   : '<section class="pages input_box_body_wrap account "></section>',
							branch : {
								wrap   : {
									self   : '<div class="account_wrap"></div>',
									branch : {
										legend : { 
											self   : '<div class="legend_wrap"></div>',
											last_branch : {
												green    : '<div class="legend_mark_green">mandatory fields*</div>',
												x_symbol : '<div class="legend_mark_x_wrap"></div>'
											}
										},
										name_and_address : { 
											self   : '<div class="field_box_wrap"></div>',
											branch : {
												title : {
													self   : '<div class="field_box_title_wrap"></div>',
													last_branch : {
														icon  : '<div class="with-icon-leaf-one"></div>',
														title : '<div class="field_box_title">Name & Adress Details.*</div>'
													}
												},
												name : {
													self   : '<div class="field_box_input_wrap"></div>',
													last_branch : {
														title           : '<div class="field_box_input_title">First Name and Last Name</div>',
														name_input      : '<input type="text" class="field_box_input" placeholder="First Name">',
														not_valid       : '<span class="with-icon-not-valid-field"></span>',
														last_name_input : '<input type="text" class="field_box_input" placeholder="Second Name">',
													}
												},
												address : {
													self   : '<div class="field_box_input_wrap"></div>',
													last_branch : {
														title  			 : '<div class="field_box_input_title">Where shall we send your freepost pack</div>',
														post_code_input  : '<input type="text" class="field_box_input" placeholder="Post Code">',
														not_valid        : '<span class="with-icon-not-valid-field"></span>',
														town_input       : '<input type="text" class="field_box_input" placeholder="Town/City">',
														area_input       : '<input type="text" class="field_box_input" placeholder="Area">',
														address_input    : '<input type="text" class="field_box_input" placeholder="Street And Address">'
													}
												}
											}
										},
										password : {
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
													last_branch : {
														title 				: '<div class="field_box_input_title">Email address</div>',
														emai_input          : '<input type="text" class="field_box_input" placeholder="Email address">',
														not_valid           : '<span class="with-icon-not-valid-field"></span>',
														confirm_email_input : '<input type="text" class="field_box_input" placeholder="Confrim email address">'
													}						
												},
												password : {
													self   : '<div class="field_box_input_wrap"></div>',
													last_branch : {
														title          		   : '<div class="field_box_input_title">Password</div>',
														password 		       : '<input type="password" class="field_box_input" placeholder="Password">',
														not_valid      		   : '<span class="with-icon-not-valid-field"></span>',
														password_input_confirm : '<input type="password" class="field_box_input" placeholder="Confirm Password">'
													}
												}
											}
										},
										disclaimer : {
											self   : '<div class="input_box_disclaimer"></div>',
											branch : {
												tick : {
													self   : '<div class="input_box_disclaimer_box"></div>',
													last_branch : {
														tick : '<span class="with-icon-input-box-disclaimer-tick"></span>'
													}
												},
												text_wrap : {
													self   : '<div class="input_box_disclaimer_text_wrap"></div>',
													last_branch : {
														text_one : '<div class="input_box_disclaimer_text">If you don\'t want to recieve emails with exclusive offers and competitions from Recyclabook and our firends then untick this</div>',
														text_two : '<div class="input_box_disclaimer_small">by pressing continue you aggre to</div>',
														link     : '<div class="input_box_disclaimer_highlight">terms & conditions</div>'
													}
												},
												continue_button : {
													self : '<div data-function-to-call="front.prototype.register" class="input_box_button">Continue <span class="with-icon-input-box-continue"></span></div>'
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
																items : {
																	self : '<div class="basket_overview_items"></div>'
																},
																bar : {
																	self   : '<div class="basket_overview_bar"></div>',
																	last_branch : {
																		block : '<div class="basket_overview_bar_block"></div>'
																	}
																}
															}
														},
														edit : {
															self : '<div class="basket_overview_edit_button">Edit Basket</div>'
														},
														total : {
															self  : '<div class="basket_overview_total_wrap"></div>',
															last_branch : {
																total : '<div class="basket_overview_total"></div>',
																text  : '<div class="basket_overview_total_text">Total Sale: </div>'
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
																	last_branch : {
																		address  : '<input readonly class="address_overview_input" value="Address">',
																		area     : '<input readonly class="address_overview_input" value="Area">',
																		town     : '<input readonly class="address_overview_input" value="Town">',
																		post_code: '<input readonly class="address_overview_input_small" value="Post Code">'
																	}
																}
															}
														},
														edit : {
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
													last_branch : {
														tab_one : '<div class="how_would_you_like_tab_title_active">We Send you a freepost pack</div>'
														// tab_two : '<div class="how_would_you_like_tab_title">Print your own freepost pack</div>'
													}
												},
												tabs : {
													self   : '<div class="how_would_you_like_tab_wrap"></div>',
													branch : {
														tab_one : {
															self   : '<div class="how_would_you_like_we_send_active_tab"></div>',
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
																			last_branch : {
																				tick : '<div class="with-icon-we-checkout-tick"></div>',
																				text : '<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>'
																			}
																		}
																	}
																}														
															}													
														}
													}
												},
												button : {
													self : '<a href="thank_you" class="checkout_button">Confirm & Complete</a>'
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
												summary : {
													self   : '<div class="thank_you_banner_summary"></div>',
													last_branch : {
														text_one : '<span>You have sold your books. You will recieve a cheque for </span>',
														quote    : '<span class="thank_you_banner_summary_underline">£xx.xx</span>',
														text_two : '<span> as soon as we get your books</span>'
													}
												},
												paragraph : {
													self : '<div class="thank_you_banner_paragraph">We\'ll be waiting for your books to arrive, in the meantime, <strong>you have an account now</strong>. You can login and track the books and payments anytime, theres also an option to tell us when you\'ve sent your books so we can get your payment out <strong>even quicker.</strong></div>'
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
												header : '<div class="thank_you_circle_text_header">Alas we shall</div>',
												text   : '<div class="thank_you_circle_text">to the edge of earth and back dear friend and trips and trips till death</div>		'
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
							self : '<div class="profile_hub_popup_screen" style="display: none;"></div>',
							branch : { 
								donate : {
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
																		none : '<option value="null">Donate to which uni?</option>'
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
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="" readonly>'
														},
														seperator : {
															self :'<div class="profile_hub_donate_mesure_seperate"></div>'
														},
														second_ammount : {
															self : '<input type="text" class="profile_hub_donate_mesure_ammount" value="" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_donate_mesure_incrimentor"></div>',
															last_branch : {
																up   : '<div class="profile_hub_donate_mesure_incrimentor_up"></div>',
																down : '<div class="profile_hub_donate_mesure_incrimentor_down"></div>'
															}
														}
													}
												},
												donate : {
													self :'<div class="profile_hub_donate_save">Donate now</div>'
												},
												cancel : {
													self : '<div class="profile_hub_donate_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								reset : {
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
													last_branch : {
														notification : '<div class="profile_hub_reset_notification">Passwords do not match</div>',
														old_password_label : '<div class="profile_hub_reset_label">Current password</div>',
														old_password : '<input type="password" class="profile_hub_reset_input">',
														new_password_label : '<div class="profile_hub_reset_label">New password</div>',
														new_password : '<input type="password" class="profile_hub_reset_input" placeholder="New password">',
														confirm_new_password : '<input type="password" class="profile_hub_reset_input" placeholder="Confirm password">'
													}
												},
												save : {
													self :'<div class="profile_hub_reset_save">Save Changes</div>'
												},
												cancel : {
													self :'<div class="profile_hub_reset_cancel">Cancel</div>'
												}
											}
										}
									}
								},
								withdraw : {
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
															last_branch : {
																input : '<input type="text" class="profile_hub_withdraw_line_text" value="Mcjoe Poopy" readonly>				'
															}
														},
														edit : {
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
															last_branch : {
																address : '<input type="text" class="profile_hub_withdraw_line_text" value="Something somewhere">',
																town    : '<input type="text" class="profile_hub_withdraw_line_text" value="East something">',
																area    : '<input type="text" class="profile_hub_withdraw_line_text" value="Areaus">',
																post_code : '<input type="text" class="profile_hub_withdraw_line_text" value="CF2LK2">				'
															}
														},
														edit : {
															self : '<div class="profile_hub_withdraw_line_edit">edit</div>			'
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
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="" readonly>'
														},
														seperator : {
															self : '<div class="profile_hub_withdraw_mesure_seperate"></div>'
														},
														second_ammount : {
															self : '<input type="text" class="profile_hub_withdraw_mesure_ammount" value="" readonly>'
														},
														incrementor : {
															self : '<div class="profile_hub_withdraw_mesure_incrimentor"></div>',
															last_branch : {
																up   : '<div class="profile_hub_withdraw_mesure_incrimentor_up"></div>',
																down : '<div class="profile_hub_withdraw_mesure_incrimentor_down"></div>'
															}
														}
													}
												},
												withdraw : {
													self : '<div class="profile_hub_withdraw_and_send">Withdraw & Send</div>'
												},
												cancel : {
													self : '<div class="profile_hub_withdraw_cancel">Cancel</div>'
												}
											}
										}
									}
								}
							}
						},
						hub : {
							self : '<section class="profile_hub"></section>',
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
															last_branch : {
																icon : '<div class="with-icon-profile-hub-account"></div>',
																greeting : '<div class="profile_hub_account_bar_greeting">Hi james</div>',
																text : '<div class="profile_hub_account_bar_text">Account Details</div>'
															}
														},
														body : {
															self : '<div class="profile_hub_account_body"></div>',
															branch : {
																main_details : {
																	self : '<div class="profile_hub_account_main_details"></div>',
																	last_branch : {
																		first_name : '<input type="text" class="profile_hub_account_main_details_small_input">',
																		second_name: '<input type="text" class="profile_hub_account_main_details_small_input">',
																		address : '<input type="text" class="profile_hub_account_main_details_large_input">',
																		town : '<input type="text" class="profile_hub_account_main_details_small_input">',
																		area : '<input type="text" class="profile_hub_account_main_details_small_input">',
																		post_code :'<input type="text" class="profile_hub_account_main_details_small_input">'
																	}
																},
																extra_details : {
																	self : '<div class="profile_hub_account_extra_details"></div>',
																	last_branch : {
																		email_label : '<div class="profile_hub_account_extra_details_title">Registered email</div>',
																		email_input : '<input type="text" class="profile_hub_account_extra_details_input">'
																	}
																},
																buttons : {
																	self : '<div class="profile_hub_account_extra_buttons"></div>',
																	last_branch : { 
																		more_fields : '<div class="profile_hub_account_extra_buttons_small_button"><div class="with-icon-plus-for-profile-hub-account-extra-buttons"></div></div>',
																		edit : '<div class="profile_hub_account_extra_buttons_large_button">Edit Account Details</div>'
																	}
																}
															}
														}
													}
												},
												history : {
													self : '<div class="profile_hub_history profile_hub_box"></div>',
													branch : {
														bar : {
															self : '<div class="profile_hub_history_bar"></div>',
															last_branch : {
																icon : '<div class="with-icon-for-profile-hub-history"></div>',
																greeting : '<div class="profile_hub_history_bar_greeting">Order History</div>',
																notification : '<div class="profile_hub_history_notification"></div>'
															}
														},
														body : {
															self : '<div class="profile_hub_history_body"></div>',
															branch : {
																inner : {
																	self : '<div class="profile_hub_history_inner_body"></div>',
																	branch : {
																		sroll : {
																			self : '<div class="profile_hub_history_scroll"></div>',
																			last_branch : {
																				handle : '<div class="profile_hub_history_scroll_handle"></div>'
																			}
																		},
																		items : {
																			self :'<div class="profile_hub_history_items"></div>'
																		}
																	}
																}
															}
														}
													}
												}
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
															last_branch : {
																icon : '<div class="with-icon-for-profile-hub-bank"></div>',
																greeting : '<div class="profile_hub_bank_greeting">RecyclaBank</div>'
															}
														},
														information_box : {
															self : '<div class="profile_hub_bank_info"></div>',
															last_branch : {
																title : '<div class="profile_hub_bank_info_title">Recyclabank</div>',
																text : '<div class="profile_hub_bank_info_text">All money made from your book sales is conviniently stored in your bank, ready to be withdrawn at any time. Simply select withdraw funds, confirm the name and address of the cheque and we\'ll send it your way. You can also donate a portion of all your balance to your university RAG campagin.</div>',
																close : '<div class="with-icon-for-profile-hub-recyclabank-close"></div>',
																reminder : '<div class="profile_hub_bank_info_reminder">Don\'t show this again</div>'
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
																			last_branch : {
																				icon : '<div class="with-icon-pig-for-account-balance"></div>',
																				label : '<div class="profile_hub_bank_stats_label">Account balance</div>',
																				input : '<input type="text" class="profile_hub_bank_stats_input" value="£10.32" readonly>'
																			}
																		},
																		withdrawal : {
																			self : '<div class="profile_hub_bank_stats_middle"></div>',
																			last_branch : {
																				icon : '<div class="with-icon-clock-for-account-withdrawal"></div>',
																				label: '<div class="profile_hub_bank_stats_label">Last withdrawal</div>',
																				input:'<input type="text" class="profile_hub_bank_stats_input" value="02/05/2013" readonly>'
																			}
																		},
																		donation : {
																			self : '<div class="profile_hub_bank_stats_last"></div>',
																			last_branch : {
																				icon : '<div class="with-icon-hand-for-account-donation"></div>',
																				label: '<div class="profile_hub_bank_stats_label">Total Donations</div>',
																				input: '<input type="text" class="profile_hub_bank_stats_input" value="0.01" readonly>'
																			}
																		},
																		button : {
																			self : '<div class="profile_hub_bank_buttons"></div>',
																			last_branch : {
																				withdraw : '<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>',
																				donate :'<div class="with-icon-for-bank-donate">Donate to RAG</div>'
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
																wrap : {
																	self : '<div class="profile_hub_tracking_inner_body"></div>',
																	branch : {
																		srcoll : {
																			self : '<div class="profile_hub_tracking_sroll"></div>',
																			last_branch : {
																				handle : '<div class="profile_hub_tracking_sroll_handle"></div>'
																			}
																		},
																		show_bar : {
																			self : '<div class="profile_hub_tracking_show_bar"></div>',
																			last_branch : {
																				text : '<div class="profile_hub_tracking_show_bar_text">Showing all</div>',
																				send_freepost : '<div class="with-icon-for-profile-hub-tracking-envelope"></div>'
																			}
																		},
																		items : {
																			self : '<div class="profile_hub_tracking_items"></div>',
																			last_branch : {
																				price_promises_label :'<div class="profile_hub_tracking_title">Price promises</div>' ,
																				unaccepted_label : '<div class="profile_hub_tracking_title">Unaccepted</div>'
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
				}
			};

			$('.result_book_add_button').on('click', function () { 
				console.log("click");
			});	

			world = world.manifest($('body'));
			router.begin();

				
		});									
	</script>

</head>
<body>