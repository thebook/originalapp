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
			scripts+'/manifest/route.alpha.js'
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
																	self  : '<input type="text" class="header_input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">					',
																}
															}
														},
														search_button : {
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
							self   : '<section class="homepage_body_wrap pages" style="display:block;"></section>',
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
							self   : '<section class="recyclabus pages" style="display: block;"></section>',
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
							self : '<section class="body pages" style="display:block"></section>',
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
								}	
							}			
						},
						registration : {
						},
						confirm : {
						},
						thank_you : {
						},
						hub : {
						},
						stock : {
						}
					}
				}
			};

			world = world.manifest($('body'));
		});
	</script>

</head>
<body>