var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.recyclabus = function () {

		this.parts = this.parts || {};

		this.parts.recyclabus = {
			left : {
				self   : '<div class="recyclabus_half_left"></div>',
				branch : {
					branch : {
						title : {
							self   : '<div class="recyclabus_title">Recycla</div>',
							branch : { 
								highlight : '<span class="recyclabus_title_highlight">Bus</span>'
							}
						},
						short_description : {
							self : '<div class="recyclabus_title_description">The idea of Recyclabus is to make it as simple as possible for you to sell your textbooks.</div>'
						},
						description : {
							self   : '<div class="recyclabus_description_box"></div>',
							branch : {
								paragraph_one   : '<div class="recyclabus_description_box_title">What is recyclabus?</div>',
								paragraph_two   : '<div class="recyclabus_description_box_paragraph">Eeach Recyclabus will be manned by one of our book buyers, ready with a barcode scanner to scan your books and pay your instantly.</div>',
								paragraph_three : '<div class="recyclabus_description_box_paragraph">The bus will be coming to your university towords the end of your exams, we\'ll be accepting over 1 million titles, so please visit this page nearer the time so you dont miss the bus and don\'t miss getting some money for the books you no longer need.</div>',
								paragraph_four  : '<div class="recyclabus_description_box_white_paragraph">On the day of the event we\'ll also have lots of exciting giveaways, so stay tuned to whats going on and what were giving away.</div>'
							}
						}
					}
				}
			},
			right : {
				self   : '<div class="recyclabus_half"></div>', 
				branch : {
					branch : {
						wrap : {
							self   : '<div class="recyclabus_half_dates_wrap"></div>',
							branch : {
								branch : {
									dates : {
										self   : '<div class="recyclabus_dates_wrap"></div>',
										branch : {
											branch : {
												level_one  : {
													self   : '<div class="recyclabus_dates_level_one"></div>',
													branch : {
														branch : {
															text : {
																self   : '<div class="recyclabus_dates_level_one_text_wrap"></div>',
																branch : {
																	title_one : '<div class="recyclabus_dates_title_one">Dates</div>',
																	title_two : '<div class="recyclabus_dates_title_two">Released On</div>'
																}
															},
															icon : {
																self   : '<div class="recyclabus_dates_icon"></div>',
																branch : {
																	image : '<img src="'+ frameworkuri +'/CSS/Includes/works/calendar.png">'
																}}}}},
												level_two : {
													self   : '<div class="recyclabus_dates_level_two"></div>',
													branch : {
														branch : {
															title_three : {
																self   : '<div class="recyclabus_dates_title_three">1</div>',
																branch : {
																	super_script : '<span class="recyclabus_dates_title_three_superscript">st.</span>'
																}
															},
															title_four : {
																self : '<div class="recyclabus_dates_title_four">April</div>'
															}}}}
											}
										}
									},
									dates_highlight : {
										self : '<div class="recyclabus_dates_highlight">If you give us your email and uni well send you a reminder when were coming your way</div>'
									},
									inputs_wrap : {
										self   : '<div class="recyclabus_dates_input_wrap"></div>',
										branch : {
											input_email      : '<input type="text" class="recyclabus_dates_first_input" placeholder="Email">',
											input_university : '<input type="text" class="recyclabus_dates_seach_input" placeholder="University">',
											text             : '<div class="recyclabus_dates_input_text"><strong class="with-icon-lock-for-strong">Dont worry,</strong> well only use this information to remind you when you can sell your books</div>'
										}
									},
									buttons_wrap : {
										self   : '<div class="recyclabus_dates_button_wrap"></div>',
										branch : {
											branch : {
												inner_wrap : {
													self   : '<div class="recyclabus_dates_inner_wrap"></div>',
													branch : { 
														first_button  : '<div class="recyclabus_dates_first_button">Notify me about recyclabus</div>',
														second_button : '<div class="recyclabus_dates_second_button">Thank you for signing up</div>'
													}}}}
												}}}},
						dates_decorational_arrow : {
							self : '<div class="with-icon-dates-down-arrow"></div>',
						},
						extra_box : {
							self   : '<div class="recyclabus_dates_extra_box"></div>',
							branch : {
								branch : {
									clock_icon : { 
										self : '<div class="with-icon-dates-clock"></div>'
									},
									text : {
										self   : '<div class="recyclabus_dates_extra_text_wrap"></div>',
										branch : {
											branch : {
												title : { 
													self : '<div class="recyclabus_dates_extra_text_title">No Time To Lose?</div>'
												},
												text : {
													self   : '<div class="recyclabus_dates_extra_text">Check out how to sell by freepost and sell to us now</div>',
													branch : {
														text_icon : '<div class="recyclabus_dates_extra_text_icon"><span data-function-instructions="{\'page\' : \'homepage_body_wrap\'}" data-function-to-call="front.prototype.change_page"  class="with-icon-recyclabus-dates-extra-text"></span></div>'
													}}}}
												}}}}
											}}}};

		this.parts.recyclabus = alpha.manifest({
			what_to_manifest : this.parts.recyclabus,
			append_to_who    : $('.recyclabus') 
		});

		this.parts.recyclabus.right.branch.branch.wrap.branch.branch.buttons_wrap.branch.branch.inner_wrap.branch.first_button
		.on('click', function () { 
			
			var value = {
				e_mail     : alpha.front.prototype.parts.recyclabus.right.branch.branch.wrap.branch.branch.inputs_wrap.branch.input_email.val(),
				university : alpha.front.prototype.parts.recyclabus.right.branch.branch.wrap.branch.branch.inputs_wrap.branch.input_university.val()
			}
			
			$(this).text('...one momment');

			$.post(
				ajaxurl,
				{ action:"create_user", user_information: value },
				function (response) {					
					alpha.front.prototype.parts.recyclabus.right.branch.branch.wrap.branch.branch.buttons_wrap.branch.branch.inner_wrap.self.animate({ top: '-52px' });
				},
				'json');
		});
	};

	return alpha;

})(alpha || {}, jQuery );