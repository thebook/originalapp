(function($) { 

var cv = $('#meta_count_slider').val();
var  i = ( cv == null ? 1 : cv );

clone = {

	index : function () {

		 ++i
		$('#meta_count_slider').attr('value', i );

	},

	/**
	 * Creates a xmlhttp request and returns it
	 * @return {object} returns request, to a variable ( hopefully )
	 */
	xm : function () {

		var xt;

			try {

				xt = new XMLHttpRequest();
			}
			
			catch (e) {

				try {

					xt = new ActiveXObject("Msxml2.XMLHTTP");
				}
			
				catch (e) {

					try {

						xt = new ActiveXObject("Microsoft.XMLHTTP");
					}

					catch (e) { 

						xt = false;
					}
			
				}
			
			}		

			return xt;
	},

	c : function ( u ) {

		 	this.index();
		 	
		var l = u +'?index=' + i;
		var a = this.xm();
			a.open("GET", l, true );
			a.onreadystatechange = function () {

				if ( a.readyState == 4 ) {

					$('#postbox-container-2').append( a.responseText );
				}
			};

			a.send( null );

	},

	/**
	 * Removes the last "appended" of the specified class
	 * @param  {string} a "Appended" Element class
	 * @return Removes the last appended element of the class and decrements the index
	 */
	remove : function ( a ) { 

			$( a ).last().empty().remove();

			i--;
	}


};

})(jQuery);