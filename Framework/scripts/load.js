(function($) { 



clone = {

	/**
	 *  Inits the class, sets the current index, sets a watcher for when the index changes, bind the index input for 
	 * saving bind add and remove events to the buttons 
	 * @param  {object} passed   				            A object of passed paramaters
	 * @param  {string} passed.index_input_field            The id of the hiden input field which saved the current index value
	 * @param  {string} passed.remove_id 		            The id of the remove button
	 * @param  {string} passed.count_element_id             The id of the element which holds the current index count when changed
	 * @param  {string} passed.path_to_element_to_load		Path to ajax loaded file which spits out what we want
	 * @param  {json}   passed.element_to_be_loaded_options A json array of options to be passed to the ajax file can be null
	 * @param  {string} passed.parent						The buttons parent
	 * @return         Events bound, values set and gotten
	 */
	init : function (passed) { 

		this.index_input   = $( passed.index_input_field );

		this.remove_button = $( passed.remove_id );

		this.current_index = $( passed.count_element_id ).text();

		this.bind_add_and_remove_events_to_buttons(passed);

		this.check();

		console.log(this.current_index);
	},

	/**
	 * Binds the ajax load and remove event to the add and remove buttons
	 * @param  {object} passed 								A object of all the paramaters
	 * @param  {string} passed.path_to_element_to_load		Path to ajax loaded file which spits out what we want
	 * @param  {json}   passed.element_to_be_loaded_options A json array of options to be passed to the ajax file can be null
	 * @param  {string} passed.class_of_elements_to_remove  The class that all the added elements share
	 * @param  {string} passed.parent						
	 * @return {bind_event}        Binds two events to the button clicks
	 */	
	bind_add_and_remove_events_to_buttons : function (passed) { 

		var klass = this;

		$( passed.parent )
		.on(
			'click',
			'.clone',
		function () { 

			klass.clone( passed.path_to_element_to_load, passed.element_to_be_loaded_options, passed.parent );
		})
		.on('click',
			'.unclone',
		function () { 

			klass.remove( passed.class_of_elements_to_remove );
		});
	},

	/**
	 * Sets the counter input to the current index, and checks wether to hide or display the remove button
	 * @return  function calls
	 */
	check : function () { 

		this.index_input.val( this.i );
		( this.current_index < 2 ) ? this.remove_button.css('display', 'none') : this.remove_button.css('display', 'inline');
	},

	/**
	 * Creates a slide meta box thoguh ajax, increments the index, sends the index with the get request, and calls check()
	 * dont use a nonce with the php file which generates this
	 * @param  {string} u The string of the php file which generates the html
	 * @return {html}   A meta box 
	 */
	clone : function ( url, passed_ajax_options, element_to_append_to ) {

		// var passed_ajax_options = passed_ajax_options || null;

		++this.current_index;
		this.check();

		$('<div class="loading_div">Loading...</div>').css({ width : "100%", padding: "10px 0", clear : "both", textAlign : "center" })
		.insertBefore( element_to_append_to );

		$.ajax({

 			data     : { index : this.current_index, template_options : passed_ajax_options },
 			url      : url,
 			dataType : "html",
 			success  : function ( response ) {

				$( response ).css( 'display', 'none' )
				.insertBefore( element_to_append_to )
				.fadeIn(400);

				$('.loading_div').remove();
 			}
 		});
	},

	/**
	 * Removes the last "appended" of the specified class
	 * @param  {string} element_to_be_removed "Appended" Element class
	 * @return Removes the last appended element of the class and decrements the index
	 */
	remove : function ( element_to_be_removed ) { 

		$( element_to_be_removed + this.current_index )
		.fadeOut(300, function () { $(this).empty().remove(); });

		--this.current_index;
		this.check();
	}


};

})(jQuery);