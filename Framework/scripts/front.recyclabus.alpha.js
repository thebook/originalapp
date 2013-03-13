var alpha = (function ( alpha, $ ) {

	alpha.recyclabus = function () {

		// '<div class="recyclabus_half_left"></div>'
		// 	'<div class="recyclabus_title">Recycla</div>'
		// 		'<span class="recyclabus_title_highlight">Bus</span>'
		// 	'<div class="recyclabus_title_description">The idea of Recyclabus is to make it as simple as possible for you to sell your textbooks.</div>'
		// 	'<div class="recyclabus_description_box"></div>'
		// 		'<div class="recyclabus_description_box_title">What is recyclabus?</div>'
		// 		'<div class="recyclabus_description_box_paragraph">Eeach Recyclabus will be manned by one of our book buyers, ready with a barcode scanner to scan your books and pay your instantly.</div>'
		// 		'<div class="recyclabus_description_box_paragraph">The bus will be coming to your university towords the end of your exams, we\'ll be accepting over 1 million titles, so please visit this page nearer the time so you dont miss the bus and don\'t miss getting some money for the books you no longer need.</div>'
		// 		'<div class="recyclabus_description_box_white_paragraph">On the day of the event we\'ll also have lots of exciting giveaways, so stay tuned to whats going on and what were giving away.</div>'
		// '<div class="recyclabus_half"></div>'
		// 	'<div class="recyclabus_half_dates_wrap"></div>'
		// 		'<div class="recyclabus_dates_wrap"></div>'
		// 			'<div class="recyclabus_dates_level_one"></div>'
		// 				'<div class="recyclabus_dates_level_one_text_wrap"></div>'
		// 					'<div class="recyclabus_dates_title_one">Dates</div>'
		// 					'<div class="recyclabus_dates_title_two">Released On</div>'
		// 				'<div class="recyclabus_dates_icon"></div>'
		// 					'<img src="">'
		// 			'<div class="recyclabus_dates_level_two"></div>'
		// 				'<div class="recyclabus_dates_title_three">1</div>'
		// 					'<span class="recyclabus_dates_title_three_superscript">st.</span>'
		// 				'<div class="recyclabus_dates_title_four">April</div>'
		// 		'<div class="recyclabus_dates_highlight">If you give us your email and uni well send you a reminder when were coming your way</div>'
		// 		'<div class="recyclabus_dates_input_wrap"></div>'
		// 			'<input type="text" class="recyclabus_dates_first_input" placeholder="Email">'
		// 			'<input type="text" class="recyclabus_dates_seach_input" placeholder="University">'
		// 			'<div class="recyclabus_dates_input_text"><strong class="with-icon-lock-for-strong">Dont worry,</strong> well only use this information to remind you when you can sell your books</div>				'
		// 		'<div class="recyclabus_dates_button_wrap"></div>'
		// 			'<div class="recyclabus_dates_inner_wrap"></div>'
		// 				'<div class="recyclabus_dates_first_button">Notify me about recyclabus</div>'
		// 				'<div class="recyclabus_dates_second_button">We\'ve got your back :)</div>'
		// 	'<div class="with-icon-dates-down-arrow"></div>'
		// 	'<div class="recyclabus_dates_extra_box"></div>'
		// 		'<div class="with-icon-dates-clock"></div>'
		// 		'<div class="recyclabus_dates_extra_text_wrap"></div>'
		// 			'<div class="recyclabus_dates_extra_text_title">No Time To Lose?</div>'
		// 			'<div class="recyclabus_dates_extra_text">Check out how to sell by freepost and sell to us now</div>'
		// 				'<div class="recyclabus_dates_extra_text_icon"></div>'
		// 					'<span class="with-icon-recyclabus-dates-extra-text"></span>'
					
		$('.recyclabus_dates_first_button').on('click', function () { 

			var value = {};
			
			value.e_mail      = $('.recyclabus_dates_first_input').val();
			value.university  = $('.recyclabus_dates_seach_input').val();
			


			$('.recyclabus_dates_inner_wrap').animate({ top: '-52px' });

			$.post(
				ajaxurl,
				{ action:"create_sub_user", user_information: value },
				function (response) {

					
				},
				'json');
		});
		
	};

	return alpha;

}(alpha || {}, jQuery ));