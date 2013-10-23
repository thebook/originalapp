define({
	make : function (to_sort) {

		var alpha

		to_sort.modules[1].make(window)
		// initial 
		alpha = to_sort.modules[2].make({}, window.jQuery )
		// manifest 
		alpha = to_sort.modules[3].make(alpha, window.jQuery )
		// observe 
		alpha = to_sort.modules[4].make(alpha, window.jQuery )
		// route
		alpha = to_sort.modules[5].make(alpha, window.jQuery )
		// amazon
		alpha = to_sort.modules[6].make(alpha, window.jQuery )
		// scroll
		alpha = to_sort.modules[7].make(alpha, window.jQuery )
		// book
		alpha = to_sort.modules[8].make(alpha, window.jQuery )
		// table
		alpha = to_sort.modules[9].make(alpha, window.jQuery )

		return {
			alpha : alpha,
			app   : to_sort.modules[0],
			jquery: window.jQuery
		}
	}
});