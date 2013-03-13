var alpha = (function ( alpha, $ ) {

	alpha.recyclabus = function () {
					
		$('.recyclabus_dates_first_button').on('click', function () { 

			$(this).text('...a momment');
			
			var value = {};

			value.e_mail      = $('.recyclabus_dates_first_input').val();
			value.university  = $('.recyclabus_dates_seach_input').val();
			
			$.post(
				ajaxurl,
				{ action:"create_sub_user", user_information: value },
				function (response) {					
					$('.recyclabus_dates_inner_wrap').animate({ top: '-52px' });
				},
				'json');
		});
		
	};

	return alpha;

}(alpha || {}, jQuery ));