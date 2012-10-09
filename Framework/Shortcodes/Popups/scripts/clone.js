(function($) { 

var i = 1;

clone = {

	remove : function( o, rm ) {

	var	r = $(o);
	var	p = r.prev();
	var pp= p.prev();

		p.empty().remove(); pp.empty().remove();

		i--;

		clone.rm(rm);

	},

	rm : function ( o ) {

		o = $(o);

		( i > 1 ) ? o.css('display', 'inline') : o.css('display', 'none') ;
	},

	clone : function( o, rm, t ) { 

	var	a = $(o);
	var	p = a.prev();
	var v = p.clone().find('input').val('').end();
		
		i++;
		
		v.insertAfter( p );
		$('<div class="tab"><div class="d"><p>'+ t + ' ' + i +'</p></div></div>').insertAfter( p );

		clone.rm( rm );

	}

};

})(jQuery);