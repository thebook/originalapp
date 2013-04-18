var alpha = ( function ( alpha, $ ) { 

	alpha.route = function (route) { 

		alpha.route.prototype.route = route;
	};

	alpha.route.prototype.begin = function () { 
		alpha.route.prototype.observe_url_change();
		alpha.route.prototype.intercept_links_and_use_them_to_call_route_changes();
		alpha.route.prototype.call_route_callback();
	};

	alpha.route.prototype.observe_url_change = function () { 

		if (this.is_history_supported()) {
			this.initialize_onpopstate_listeners();
			this.add_onpopstate_listener(this.call_route_callback);
		}
	};

	alpha.route.prototype.initialize_onpopstate_listeners = function () { 

		var router = this;

		window.onpopstate = function () { 
			for (var i = this.onpopstate.listeners.length - 1; i >= 0; i--) {
				this.onpopstate.listeners[i].call(router, { route: router.route, listener_index: i });
			};
		};

		window.onpopstate.listeners = [];
	};

	alpha.route.prototype.add_onpopstate_listener = function (listener) { 
		if ( window.onpopstate.listeners && window.onpopstate.listeners.constructor === Array ) { 
			window.onpopstate.listeners.push(listener);
		}
	};

	alpha.route.prototype.call_route_callback = function () { 

		var callback = this.parse_route();

			if ( callback.on ) { 
				callback.on.call(this);
			}
			else { 
				throw new Error("there is no 'on' function in the router branch for this url");
			}
	};

	alpha.route.prototype.intercept_links_and_use_them_to_call_route_changes = function () { 
		$('body').delegate("a", "click", function (event) { 
			alpha.route.prototype.change_url($(this).attr('href'));
			return false;
		});

	};

	alpha.route.prototype.parse_route = function () { 

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
	};

	alpha.route.prototype.change_url = function (route) { 

		if ( route[0] !== '/' ) route = "/"+ route;
		history.pushState({}, "", window.location.protocol +"//"+ window.location.host + route );
		window.onpopstate();
	};

	alpha.route.prototype.is_history_supported = function () { 

		return !!(window.history && history.pushState);
	}

	return alpha;

})(alpha || {}, jQuery );