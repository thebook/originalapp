var alpha = (function ( alpha, $ ) {

	alpha.filter_search = function ( current_click ) { 

		var typed_value        = current_click.element.val().toLowerCase().trim(),
			filter             = this.prototype[current_click.instructions.filter_by]({ typed_value : typed_value, instructions : current_click.instructions }),
			elements_to_filter = this.prototype.find_elements_to_show(typed_value, filter);
			
			$(current_click.instructions.what_to_filter).not(elements_to_filter).hide(200);
			$(elements_to_filter).show(200);
	};

	alpha.filter_search.prototype.find_elements_to_show = function (value_to_filter_by, filter_array) { 

		elements_to_filter = $.map(filter_array, 
			function (filter_element, member_index ) { 

				if (filter_element.filter.indexOf(value_to_filter_by) !== -1 ) { 

					return filter_element.element;
				}
			});

		return elements_to_filter;
	};

	alpha.filter_search.prototype.data_type = function (filter) { 

		var filter_object   = new Object,
			search_by_label = ( filter.typed_value.indexOf('::') !== -1? true : false );

		$(filter.instructions.what_to_filter).each(
		function (index) { 

			var filter_words = $(this).attr('data-filter').toLowerCase();
				filter_words = ( search_by_label? filter_words : filter_words.split('::').join('') );

				filter_object[index] = { element : this,  filter : filter_words };
		});

		return filter_object;
	};

	return alpha;

})(alpha || {}, jQuery );