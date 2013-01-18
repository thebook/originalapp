var alpha = (function ( alpha, $ ) {

	alpha.filter_search = function ( current_click ) { 

		var typed_value = current_click.element.val(),
			filter      = new Object,
			elements_to_filter = new Array;


			$(current_click.instructions.what_to_filter).each(
			function (index) {

				filter[index] = { element : $(this),  filter : $(this).attr('data-filter') };
			});

			elements_to_filter = $.map(filter, 
				function (filter_element, member_index ) { 

					if (filter_element.filter.indexOf(typed_value) !== -1 ) { 

						return filter_element.element;
					}
				});

			console.log(elements_to_filter);

	};

	alpha.filter_search.prototype.find_search_value_in_string = function (value_to_filter_by, filter_array) { 


	};

	alpha.filter_search.prototype.filter_by_data_type = function (filter) { 


	};

	return alpha;

})(alpha || {}, jQuery );