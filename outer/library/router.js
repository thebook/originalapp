define({

	make : function (route) { 
		this.route   = route
		this.history = []
		this.on_route= "/"

		return this
	},

	begin : function () { 

		if ( this.is_history_supported() ) {

			this.initialize_onpopstate_listeners()
			this.add_onpopstate_listener(this.handle_route)
			this.intercept_links_and_use_them_to_call_route_changes()
			this.handle_route()

		} 
	},

	is_history_supported : function () { 		
		return !!(window.history && history.pushState);
	},

	initialize_onpopstate_listeners : function () { 

		var router

		router            = this
		window.onpopstate = function () {

			for (var index = this.onpopstate.listeners.length - 1; index >= 0; index--)
				this.onpopstate.listeners[index].call(
					router, 
					{ 
						route          : router.route, 
						listener_index : index
					}
				)
		}

		window.onpopstate.listeners = []

	},

	add_onpopstate_listener : function (listener) { 
		if ( window.onpopstate.listeners && window.onpopstate.listeners.constructor === Array )
			window.onpopstate.listeners.push(listener)
	},

	handle_route : function () { 
		if ( this.route.constructor === Function ) 
			this.call_single_route_handler()
		if ( this.route.constructor === Object ) 
			this.call_traditional_route_handler()
	},
	
	call_single_route_handler : function () { 

		this.route.call(this)
	},

	call_traditional_route_handler : function () { 

		var previous_callback, callback 

		previous_callback = this.history[this.history.length -1] || false
		callback          = this.parse_route()

		if ( previous_callback.off && previous_callback.off.constructor === Function )
			previous_callback.off.call(this)

		if ( callback.on ) { 
			callback.on.call(this);
			this.history.push(callback);
		}
		else { 
			throw new Error("there is no 'on' function in the router branch for this url");
		}
	},

	intercept_links_and_use_them_to_call_route_changes : function () {

		var anchors, index, self

		index   = 0
		self   	= this
		anchors = document.getElementsByTagName("a")

		for (; index < anchors.length; index++) {
			if ( !anchors[index].getAttribute("data-dont-route") ) { 
				anchors[index].addEventListener("click", function (event) { 
					event.preventDefault()
					event.stopImmediatePropagation()
					self.change_url(event.target.getAttribute("href"))
					return false
				})
			}
		}
	},

	parse_route : function () { 

		var path, route, branch

		path  = window.location.pathname 
		route = this.route

		if ( path !== "/" ) {

			path = path.split('/')

			while ( path.length ) { 
				branch = path.shift()
				if ( branch in route ) route = route[branch]
			}
		}
		if ( !route.on || route.on.constructor !== Function ) route.on = false

		return route
	},

	change_url : function (route) { 
		
		if ( route[0] !== '/' ) 
			route = "/"+ route;

		this.on_route = route
		history.pushState({}, "", window.location.protocol +"//"+ window.location.host + route );
		window.onpopstate()
	},
})