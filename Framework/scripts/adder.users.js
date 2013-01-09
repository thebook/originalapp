var lf_users = (function ($, lf_users) {

	lf_users.add_new_field_input = function (current_click, event) { 

		$.ajax({
			type : 'GET',
			url : this.global.loader_path,
			data : { template_options : { name : "user", user_options : this.global.user_options } },
			dataType : 'html',
			sucess : function (response) { 

			}
		});
		console.log(this.global.loader_path);
		console.log(this.global.user_options);
	};

	return lf_users;

})(jQuery, lf_users || {} );