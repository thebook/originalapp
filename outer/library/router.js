module({

	make : function (route) { 
		route   = route
		history = []
	},

	begin : function () { 
		this.observe_url_change()
		this.intercept_links_and_use_them_to_call_route_changes()
		this.call_route_callback()
	},

	observe_url_change : function () { 

		if (this.is_history_supported()) {
			this.initialize_onpopstate_listeners()
			this.add_onpopstate_listener(this.call_route_callback)
		}
	},

	initialize_onpopstate_listeners : function () { 

		var router = this

		window.onpopstate = function () { 
			for (var i = this.onpopstate.listeners.length - 1; i >= 0; i--)
				this.onpopstate.listeners[i].call(router, { route: router.route, listener_index: i })
		};

		window.onpopstate.listeners = []
	},

	add_onpopstate_listener : function (listener) { 
		if ( window.onpopstate.listeners && window.onpopstate.listeners.constructor === Array ) { 
			window.onpopstate.listeners.push(listener);
		}
	},

	call_route_callback : function () { 

		var previous_callback = this.history[this.history.length -1] || false;
			callback = this.parse_route();

			if ( previous_callback.off && previous_callback.off.constructor === Function ) { 
				previous_callback.off.call(this);
			}

			if ( callback.on ) { 
				callback.on.call(this);
				this.history.push(callback);
			}
			else { 
				throw new Error("there is no 'on' function in the router branch for this url");
			}
	},

	intercept_links_and_use_them_to_call_route_changes : function () { 
		$('body').delegate("a", "click", function (event) { 
			if ( $(this).attr("data-dont-route") ) return;
			this.change_url($(this).attr('href'));
			return false;
		});

	},

	parse_route : function () { 

		var path  = window.location.pathname, route = this.route, branch;

		if ( path !== "/" ) {

			path = path.split('/');

			while ( path.length ) { 
				branch = path.shift();
				if ( branch in route ) route = route[branch];
			}
		}
		if ( !route.on || route.on.constructor !== Function ) route.on = false;	
		return route;
	},

	change_url : function (route) { 

		if ( route[0] !== '/' ) route = "/"+ route;
		history.pushState({}, "", window.location.protocol +"//"+ window.location.host + route );
		window.onpopstate();
		this.on_route = route;
	},

	get_route : function () { 
		return this.on_route;
	},

	is_history_supported : function () { 

		return !!(window.history && history.pushState);
	}
})