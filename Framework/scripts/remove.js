(function($) { 



remove = {

	/**
	 * The init function of our little escapade, sets the global variables for this closure and calls check() to hide or show
	 * remove button
	 * @param  {string} o The id of the input which keeps count of slides
	 * @param  {string} r The id of the remove button
	 * @return  Sets the vars, and gets the saved slide index, from last update and performs check
	 */
	index : function ( o, r ) {
		
		// "Index Input" the input which keeps count of the slide number
		this.ii    = $( o );
		// "Remove" the remove button id
		this.re    = $( r );
		// "Index", the current slide number
		this.i     = $( o +'-counter').text();	
		
		this.check();	

	},


	/**
	 * Sets the counter input to the current index, and checks wether to hide or display the remove button
	 * @return  function calls
	 */
	check : function () { 

		this.ii.val( this.i );
		( this.i < 2 ) ? this.re.css('display', 'none') : this.re.css('display', 'inline');
	},

	/**
	 * Creates a slide meta box thoguh ajax, increments the index, sends the index with the get request, and calls check()
	 * dont use a nonce with the php file which generates this
	 * @param  {string} u The string of the php file which generates the html
	 * @return {html}   A meta box 
	 */
	c : function ( u ) {

		++this.i;
		this.check();

		$.ajax({

 			data     : { index : this.i },
 			url      : u,
 			dataType : "html",
 			success  : function ( a ) {

				$('#postbox-container-2').append( a );
 			}
 		});
	},

	/**
	 * Removes the last "appended" of the specified class
	 * @param  {string} a "Appended" Element class
	 * @return Removes the last appended element of the class and decrements the index
	 */
	remove : function ( a ) { 

			$('#' + a + this.i ).empty().remove();

			--this.i;
		 	this.check();
	}


};

})(jQuery);