var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.page_changer = function (property, old_page, page) {

		if ( old_page.length < 1 ) old_page = 'pages';

		if ( old_page !== page )
			$('.'+ old_page ).fadeOut(500, function () { $('.'+ page ).fadeIn(500); });
			$('#navigation_for_'+ old_page ).removeClass('with-icon-for-navigation-text-for-bar-active').addClass('navigation_text_for_bar');
			$('#navigation_for_'+ page ).removeClass('navigation_text_for_bar').addClass('with-icon-for-navigation-text-for-bar-active');

		return page;
	};

	alpha.front.prototype.change_page = function (wake, callback) {

		callback = callback || false;

		alpha.front.prototype.being.on_page = wake.instructions.page;

		if (callback)
			callback(wake.instructions.page);	
	};

	alpha.front.prototype.navigation = function () {

		this.parts = this.parts || {};

		this.parts.bar = {
			wrap : {
				self   : '<div class="bar"></div>',
				branch : {
					branch : {
						arrow : {
							self : '<span class="with-icon-progress-pop-up-arrow"></span>'
						},
						logo : {
							self   : '<div data-function-instructions="{\'page\' : \'homepage_body_wrap\' }" data-function-to-call="front.prototype.change_page" class="logo_for_bar"></div>',
							branch : {
								logo : '<span data-function-instructions="{\'page\' : \'homepage_body_wrap\' }" data-function-to-call="front.prototype.change_page" class="with-icon-logo"></span>'
							}
						},
						navigation : {
							self   : '<div class="navigation_wrap"></div>',
							branch : {
								branch : {
									wrap : {
										self   : '<div class="navigation_inner_wrap"></div>',
										branch : {
											branch : {
												navigation : {
													self   : '<div class="navigation"></div>',
													branch : {
														how_it_works : '<div data-function-instructions="{\'page\' : \'homepage_body_wrap\' }" data-function-to-call="front.prototype.change_page" class="with-icon-for-navigation-text-for-bar-active" id="navigation_for_homepage_body_wrap" >How It Works</div>',
														recyclabus   : '<div data-function-instructions="{\'page\' : \'recyclabus\' }" data-function-to-call="front.prototype.change_page" class="navigation_text_for_bar" id="navigation_for_recyclabus">Recyclabus</div>'
													}
												},
												progress : {
													self   : '<div class="progress_icons_for_bar_wrap"></div>',
													branch : {
														branch : {									
															welcome_icon : {
																self   : '<div class="progress_icon_for_bar"></div>',
																branch : {
																	branch : {
																		circle : {
																			self   : '<div class="progress_icon_circle_doing"></div>',
																			branch : {
																				icon : '<span class="with-icon-welcome-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Welcome</span>'
																		}}}},
															account_icon : {
																self   : '<div class="progress_icon_for_bar"></div>',
																branch : {
																	branch : {
																		circle : {
																			self   : '<div class="progress_icon_circle"></div>',
																			branch : {
																				icon : '<span class="with-icon-account-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Account</span>'
																		}}}},
															confirm : {
																self   : '<div class="progress_icon_for_bar"></div>',
																branch : {
																	branch : {
																		circle : {
																			self   : '<div class="progress_icon_circle"></div>',
																			branch : {
																				icon : '<span class="with-icon-confirm-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Confirm</span>'
																		}}}},
															thank_you : {
																self   : '<div class="progress_icon_for_bar"></div>',
																branch : {
																	branch : {
																		circle : {
																			self   : '<div class="progress_icon_circle"></div>',
																			branch : {
																				icon : '<span class="with-icon-thank-you-progress-bar"></span>'
																			}
																		},
																		text : {
																			self : '<span class="progress_icon_for_bar_text">Thank You</span>'
																		}}}},
																	}}
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
								branch : {
									title : {
										self   : '<div class="progress_pop_up_title"></div>',
										branch : {
											branch : {
												text : {
													self : '<span class="progress_pop_up_title_text"></span>'
												},
												icon : {
													self   : '<span class="progress_pop_up_title_icon"></span>',
													branch : {
														icon :'<span class="with-icon-welcome-progress-bar"></span>'
													}
												}
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
								branch : {
									sign_in : {
										self   : '<div class="progress_welcome_sign_in_box"></div>',
										branch : {
											title    : '<div class="progress_welcome_sign_in_box_title">Sign In</div>',
											email    : '<input type="text" class="progress_welcome_sign_in_box_input" placeholder="Email Address" value="">',
											password : '<input type="password" class="progress_welcome_sign_in_box_input" placeholder="Password" value="">',
											forgoten : '<span class="progress_welcome_sign_in_box_forgot_password">Forgoten Password?</span>'
										}
									},
									register : {
										self   : '<div class="progress_welcome_register_box"></div>',
										branch : {
											text   : '<div class="progress_welcome_register_box_text">New To Recyclabook >>></div>',
											button : '<div data-function-to-call="front.prototype.account" class="progress_welcome_register_box_button">Sign Up</div>'
										}
									}
								}
							}
						},
						
						user_button : {
							self   : '<div class="button_for_user"></div>',
							branch : {
								icon  : '<span class="with-icon-user"></span>',
								arrow : '<span class="with-icon-user-arrow"></span>'
							}
						},
						input : {
							self   : '<div class="input_for_bar"></div>',
							branch : {
								branch : {
									field : {
										self   : '<div class="field_for_input bar_field_for_input"></div>',
										branch : {
											input : '<input type="text" class="input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">'
										}
									},
									button : {
										self   : '<div class="button_for_input"></div>',
										branch : {
											icon : '<span data-function-instructions="{\'type\':\'bar\'}" data-function-to-call="front.prototype.search_though_amazon" class="with-icon-search"></div>'
										}}}}},
						user_popup_box : {
							self   :  '<div class="user_pop_up_box"></div>',
							branch : {
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
										self   : '<div class="user_pop_up_title_white">Sign in Or </div>',
										branch : {
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
								}}}}
					}
				}
			}
		};				

		this.parts.bar = alpha.manifest({
			what_to_manifest : this.parts.bar,
			append_to_who : $('.bar_outer_wrap') 
		});
	};

	return alpha;

})(alpha || {}, jQuery );