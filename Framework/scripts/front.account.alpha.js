var alpha = (function ( alpha, $ ) {
	
	alpha.front = alpha.front || function () {};

	alpha.front.prototype.account = function () {

		var parts = alpha.front.prototype.parts;

		// Fade out welcome box and fade in progress popup box
		parts.bar.wrap.branch.branch.welcome_popup.self.fadeOut(400);
		parts.bar.wrap.branch.branch.progress_popup.self.css({ display: 'block', opacity: 0 }).animate({ opacity: 1 }, 400);

		alpha.front.prototype.registration.prototype.progress_to_icon(2);
		alpha.front.prototype.registration.prototype.refill_popup_box({
			title : "Create User",
			icon  : "with-icon-account-progress-bar",
			text  : "registration"
		});

		parts.registration_wrap.css({ 'margin-top': '2000px' }).animate({ 'margin-top': ( parts.bar.wrap.branch.branch.progress_popup.self.height() + 24 ) + 'px' }, 1200);

		alpha.front.prototype.parts.account = { 
			legend : { 
				self   : '<div class="legend_wrap"></div>',
				branch : {
					green    : '<div class="legend_mark_green">mandatory fields*</div>',
					x_symbol : '<div class="legend_mark_x_wrap"></div>'
				}
			},
			name_and_address : { 
				self   : '<div class="field_box_wrap"></div>',
				branch : {
					branch : {
						title : {
							self   : '<div class="field_box_title_wrap"></div>',
							branch : {
								icon  : '<div class="with-icon-leaf-one"></div>',
								title : '<div class="field_box_title">Name & Adress Details.*</div>'
							}
						},
						name : {
							self   : '<div class="field_box_input_wrap"></div>',
							branch : {
								title           : '<div class="field_box_input_title">First Name and Last Name</div>',
								name_input      : '<input type="text" class="field_box_input" placeholder="First Name">',
								not_valid   : '<span class="with-icon-not-valid-field"></span>',
								last_name_input : '<input type="text" class="field_box_input" placeholder="Second Name">',
							}
						},
						// address : {
						// 	self   : '<div class="field_box_input_wrap"></div>',
						// 	branch : {
						// 		title  			 : '<div class="field_box_input_title">Where shall we send your freepost pack</div>',
						// 		post_code_input  : '<input type="text" class="field_box_input_small" placeholder="Post Code">',
						// 		button           : '<div class="field_box_input_small_button">Find Address<span class="with-icon-field-box-house"></span></div>',
						// 		descriptive_text : '<div class="field_box_input_extra_text"><span class="field_box_input_extra_text_highlight">or</span> enter address manually</div>'
						// }}
						address : {
							self   : '<div class="field_box_input_wrap"></div>',
							branch : {
								title  			 : '<div class="field_box_input_title">Where shall we send your freepost pack</div>',
								post_code_input  : '<input type="text" class="field_box_input" placeholder="Post Code">',
								not_valid        : '<span class="with-icon-not-valid-field"></span>',
								town_input       : '<input type="text" class="field_box_input" placeholder="Town/City">',
								area_input       : '<input type="text" class="field_box_input" placeholder="Area">',
								address_input    : '<input type="text" class="field_box_input" placeholder="Street And Address">'
						}}
					}}},
			password : {
				self   : '<div class="field_box_wrap_left"></div>',
				branch : {
					branch : {
						title : {
							self   : '<div class="field_box_title_wrap"></div>',
							branch : {
								icon  : '<div class="with-icon-leaf-two"></div>',
								title : '<div class="field_box_title">Login Details.*</div>'
							}
						},
						email : {
							self   : '<div class="field_box_input_wrap"></div>',
							branch : {
								title 				: '<div class="field_box_input_title">Email address</div>',
								emai_input          : '<input type="text" class="field_box_input" placeholder="Email address">',
								not_valid           : '<span class="with-icon-not-valid-field"></span>',
								confirm_email_input : '<input type="text" class="field_box_input" placeholder="Confrim email address">'
							}						
						},
						password : {
							self   : '<div class="field_box_input_wrap"></div>',
							branch : {
								title          		   : '<div class="field_box_input_title">Password</div>',
								password 		       : '<input type="password" class="field_box_input" placeholder="Password">',
								not_valid      		   : '<span class="with-icon-not-valid-field"></span>',
								password_input_confirm : '<input type="password" class="field_box_input" placeholder="Confirm Password">'
							}}}}},
			disclaimer : {
				self   : '<div class="input_box_disclaimer"></div>',
				branch : {
					branch : {
						tick : {
							self   : '<div class="input_box_disclaimer_box"></div>',
							branch : {
								tick : '<span class="with-icon-input-box-disclaimer-tick"></span>'
							}
						},
						text_wrap : {
							self   : '<div class="input_box_disclaimer_text_wrap"></div>',
							branch : {
								text_one : '<div class="input_box_disclaimer_text">If you don\'t want to recieve emails with exclusive offers and competitions from Recyclabook and our firends then untick this</div>',
								text_two : '<div class="input_box_disclaimer_small">by pressing continue you aggre to</div>',
								link     : '<div class="input_box_disclaimer_highlight">terms & conditions</div>'
							}
						},
						continue_button : {
							self : '<div data-function-to-call="front.prototype.register" class="input_box_button">Continue <span class="with-icon-input-box-continue"></span></div>'
						}}}}
		};

		alpha.front.prototype.parts.account = alpha.manifest({
			what_to_manifest : alpha.front.prototype.parts.account,
			append_to_who : $('.account_wrap') 
		});

		alpha.front.prototype.parts.account.disclaimer.branch.branch.tick.self.bind('click', function () {

			var tick = alpha.front.prototype.parts.account.disclaimer.branch.branch.tick.branch.tick;
				(tick.css('display') !== 'none')? tick.css({ display : 'none' }) : tick.css({ display : 'inline' });
		});

		alpha.front.prototype.being.on_page = 'account';	
	};

	alpha.front.prototype.register = function () {

		var valid = {}, fields = alpha.front.prototype.being.user_info.fields, parts = alpha.front.prototype.parts;

		fields.e_mail            = parts.account.password.branch.branch.email.branch.emai_input.val();
		fields.email_confirm     = parts.account.password.branch.branch.email.branch.confirm_email_input.val();
		fields.password          = parts.account.password.branch.branch.password.branch.password.val();
		fields.password_confirm  = parts.account.password.branch.branch.password.branch.password_input_confirm.val();
		fields.first_name  		 = parts.account.name_and_address.branch.branch.name.branch.name_input.val();
		fields.second_name 		 = parts.account.name_and_address.branch.branch.name.branch.last_name_input.val();
		fields.post_code 		 = parts.account.name_and_address.branch.branch.address.branch.post_code_input.val();
		fields.address   		 = parts.account.name_and_address.branch.branch.address.branch.address_input.val();
		fields.address_area   	 = parts.account.name_and_address.branch.branch.address.branch.area_input.val();
		fields.address_town   	 = parts.account.name_and_address.branch.branch.address.branch.town_input.val();

		valid.name         	   = {};
		valid.name.object  	   = parts.account.name_and_address.branch.branch.name.branch;
		valid.address 		   = {};
		valid.address.object   = parts.account.name_and_address.branch.branch.address.branch;
		valid.email 		   = {};
		valid.email.object     = parts.account.password.branch.branch.email.branch;
		valid.password         = {};
		valid.password.object  = parts.account.password.branch.branch.password.branch;


		if ( fields.first_name.trim().length > 1 && fields.second_name.trim().length > 1 ) {

			valid.name.pass  = true;
		}
		else { 
			valid.name.pass    = false;
			valid.name.message = "First name and last name should be greater than one character";
		}

		if ( fields.post_code.trim().is_length_between(5,8) && fields.address.trim().length > 0 && fields.address_area.trim().length > 0 && fields.address_town.trim().length > 0 ) {

			valid.address.pass = true;
		}
		else {

			valid.address.pass = false;	
			valid.address.message = "";
			// if ( !fields.post_code.trim().is_length_between(5,8) && !fields.address.trim().length > 0 ) valid.address.message += "Post Code and Adress are incorrect,";
			if ( !fields.post_code.trim().is_length_between(5,8) ) 	valid.address.message += "Post Code is incorect, <br/>";
			if ( !fields.address.trim().length > 0 ) 		      	valid.address.message += "Address has not been entered, <br/>";
			if ( !fields.address_town.trim().length > 0 ) 		 	valid.address.message += "Town has not been entered, <br/>";
			if ( !fields.address_area.trim().length > 0 ) 		 	valid.address.message += "Area has not been entered,";
		}

		if ( ( fields.e_mail.length > 4 && this.prototype.check_that_input_is_valid(fields.e_mail, /[@]/g) ) && ( fields.email_confirm.length > 4 && this.prototype.check_that_input_is_valid(fields.email_confirm, /[@]/g)) ) {

			valid.email.pass    = this.prototype.check_that_two_inputs_match(fields.e_mail, fields.email_confirm );
			valid.email.message = "Emails do not match";
		}
		else {
			
			valid.email.pass    = false;
			valid.email.message = "Not a valid email";
		}

		if ( this.prototype.check_that_two_inputs_match( fields.password, fields.password_confirm)) {

			valid.password.pass    = (fields.password.length > 5);
			valid.password.message = "Password should be more than 5 characters long";
		}
		else {

			valid.password.pass    = false;
			valid.password.message = "Passwords do not match";
		}

		alpha.front.prototype.parts.account.disclaimer.branch.branch.continue_button.self.text("a momment...");

		alpha.front.prototype.register.prototype.is_email_in_use(fields.e_mail, function (is_email_in_use) {

			if (valid.email.pass && is_email_in_use) valid.email.pass = false; valid.email.message = "Email is already in use";

			if (alpha.front.prototype.register.prototype.throw_errors_for_inputs(valid)) {

				delete fields.email_confirm;
				delete fields.password_confirm;
				fields.recieve_newsletters = (alpha.front.prototype.parts.account.disclaimer.branch.branch.tick.branch.tick.css('display') !== 'none');				
				alpha.front.prototype.confirm();

				// $.post(
				// 	ajaxurl,
				// 	{ action:"create_sub_user", user_information: input },
				// 	function (response) {
						
				// 	},
				// 	'json');
			}
			else {
				alpha.front.prototype.parts.account.disclaimer.branch.branch.continue_button.self.text("Continue");
			}
		});	
	};

	alpha.front.prototype.register.prototype.is_email_in_use = function (email, callback) {

		$.post(
			ajaxurl,
			{ action:"check_if_email_is_in_use", email:email },
			function (position_of_email) {
				callback((position_of_email !== 0));
			},
			'json' );
	};

	alpha.front.prototype.register.prototype.throw_errors_for_inputs = function (log_of_mistakes) {

		var no_mistakes  = true, 
			notification = alpha.front.prototype.parts.account.legend.branch.x_symbol;

			notification.empty();

			$.each(log_of_mistakes, function (index, object) {
				
				if (!object.pass) {
					
					object.object.not_valid.css({ display :'block' });
					notification.append(alpha.replace_placeholders_with_values_in_text({ index : index, message : object.message }, alpha.front.prototype.being.basket_book_format_tick ));
					no_mistakes = false;
				}
				else { 
					object.object.not_valid.css({ display :'none' });
					notification.find('#notification_'+ index ).remove();
				}
			});

			return no_mistakes;
	};

	alpha.front.prototype.register.prototype.check_that_two_inputs_match = function (input_one, input_two, case_sensitive) {

		case_sensitive = case_sensitive || false;
		input_one 	   = (case_sensitive? input_one.trim() : input_one.toLowerCase().trim() );
		input_two 	   = (case_sensitive? input_two.trim() : input_two.toLowerCase().trim() );
		
		if (input_one.length > 0 || input_two.length > 0) return (input_one == input_two);
		else return false;
	};

	alpha.front.prototype.register.prototype.check_that_input_is_valid = function (input, regular_expresion_to_match_against) {

		return (input.match(regular_expresion_to_match_against)? true : false );
	};

	return alpha;

})(alpha || {}, jQuery );