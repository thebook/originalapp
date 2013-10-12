define({

	make : function (make) {

		this.state         = {
			submitting : false,
			retrieving : false
		}

		this.processes     = {
			submissions : [],
			retrievals  : []
		}

		this.settings = make.settings
		this.submit   = make.submit
		this.retrieve = make.retrieve
		this.data     = this.create_model_variables_following_definition({}, make.model)

		if ( this.settings.retrieve_on_make) 
			this.retrieve_multiple_as(this.settings.retrieve_on_make)

	},

	retrieve_multiple_as  : function (retrieve_models) {

		for (var index = 0; index < retrieve_models.length; index++)
			this.retrieve_model_as(retrieve_models[index])
	},

	retrieve_model_as : function (what) { 

		var retrieve, data;

		retrieve = this.retrieve[what]

		this.send_ajax_request({
			type         : "GET",
			data         : retrieve.paramaters || null,
			url          : retrieve.path || this.settings.main_path,
			request_name : what,
			callback     : function (event) {
				
				if ( retrieve.map.constructor === Array ) 
					console.log("constructor is an array")
				
				if ( retrieve.map.constructor === Object )
					console.log("consturtor is an object")

				if ( retrieve.map.constructor === Function )
					retrieve.map.call(this.data, event.currentTarget.response)
			}
		})
	},

	submit_model_as : function (what) {
		
		var submit, data;

		submit = this.submit[what]

		if ( submit.properties.constructor === Array )    
			data = this.get_model_properties_based_on_map(submit.properties)
		
		if ( submit.properties.constructor === Function ) 
			data = submit.properties.call(this.data)

		if ( submit.properties.constructor !== Array && submit.properties.constructor !== Function ) 
			throw new Error("the submit \""+ what +"\" properties key must be either an array of a function")

		if ( submit.paramaters ) data = { 
			instructions : submit.paramaters,
			model        : data
		}

		this.send_ajax_request({
			type         : "POST",
			data         : data,
			url          : submit.path,
			request_name : what
		})
	},

	notify_module_of_a_commenced_request : function ( request_name, request_type ) { 

		var process = ( 
			request_type === "POST" ? 
				["submitting", "submissions"] : 
				["retrieving", "retrievals"] 
		)
		
		this.state[process[0]] = true;
		
		this.processes[process[1]].push(request_name);
	},
	
	notify_module_of_a_finished_request : function ( request_name, request_type ) {

		var process = ( 
			request_type === "POST" ? 
				["submitting", "submissions"] : 
				["retrieving", "retrievals"] 
		)
		
		this.processes[process[1]].splice(this.processes[process[1]].indexOf(request_name));
		
		if ( this.processes.submissions.length === 0 ) 
			this.state[process[0]] = false;
	},

	send_ajax_request : function (send) {

		var request, self;
		
		self    = this
		request = Object.create(this.request)
		request.make().send({
			url : send.url,
			data: send.data,
			type: send.type,
			request_name : send.request_name,
			after_send : function () {
				self.notify_module_of_a_commenced_request( send.request_name, send.type )
			}
		}).then(function (event) {
			self.notify_module_of_a_finished_request( send.request_name, send.type )

			if ( send.callback ) 
				send.callback.call(self, event )
		})
	},

	request : {

		make : function () {

			this.then_queue = []
			return this
		},

		send : function (send) {

			var request, data, self;

			self                       = this
			request 				   = new XMLHttpRequest()
			request.responseType       = ""
			data                       = this.convert_object_into_url_paramaters({ 
				object : send.data 
			})
			request.onreadystatechange = function (change) {
				
				if ( request.readyState !== 4 ) return

				var index, then_return;

				index       = 0
				then_return = false

				for (index = 0; index < self.then_queue.length; index++)
					then_return = self.then_queue[index].call(self, change, then_return)
			}

			if ( send.type === "GET" && send.data ) 
				send.url = send.url +"?"+ data

			request.open(send.type, send.url, true)

			if ( send.type === "POST" ) 
				request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

			request.send(( send.type === "GET" && send.data ? data : null ))

			send.after_send.call(this, send)

			return this
		},

		then : function (method) {
			this.then_queue.push(method)
			return this
		},

		convert_object_into_url_paramaters : function (convert) {

			var paramaters = []

			for ( var property in convert.object )
				paramaters.push(property +"="+ (
					convert.object[property].constructor === String || 
					convert.object[property].constructor === Number ?
						convert.object[property] :
						window.encodeURIComponent(JSON.stringify(convert.object[property]))
					)
				)

			return paramaters.join("&")
		}
	},

	get_model_properties_based_on_map : function (map, even_map ) {

		var index, data, path, property, property_path, model_path, property_name, last_path;

		data  = {};
		index = 0;

		for (; index < map.length; index++ ) {

			model_path    = this.data;
			property_path = data;
			property      = map[index].split(".");

			for ( path = 0; path < property.length; path++ ) {

				property_name = property[path];
				model_path    = model_path[property_name];
				if ( !even_map ) {
					last_path     = property_path;
					property_path = ( property_path[property_name] ? property_path[property_name] : property_path[property_name] = {} );
				}
			}

			if ( !model_path.get ) throw new Error("path "+ map[index] +" does not have a get method, the path must not point to a namespace");
			( even_map )? data[property_name] = model_path.get() : last_path[property[path-1]] = model_path.get();
		}

		return data;
	},

	create_model_variables_following_definition : function (parent, object) {

		if ( !parent.observers ) {
			Object.defineProperty(parent, "observers", {
				configurable : true,
				enumerable   : false, 
				writable     : false, 
				value        : {}
			});
		}

		for ( var data in object ) {
			
			if ( object[data].more ) {
				this.create_model_variables_following_definition(parent[data] = {}, object[data].more);
			} else { 
				parent[data] = this.create_model_variable(parent, object, data);
			}
		}

		return parent;
	},

	create_model_variable : function (parent, object, property) {

		var model, old_value, new_value;
		
		model                      = {};
		new_value                  = object[property].value || "";								           	
		parent.observers[property] = [];	

		Object.defineProperties( model, {
			on_get    : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : object[property].on_get    || null
			},
			on_set    : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : object[property].on_set    || null
			},
			on_set_as : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : object[property].set_as    || null
			},
			on_get_as : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : object[property].get_as    || null
			},
			on_delete : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : object[property].on_delete || null
			},
			call_observers : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value : function () {

					if ( parent.observers && parent.observers[property] ) {
						for (var index = 0; parent.observers[property].length; index++ ) {

							parent.observers[property][index].call( object, {
								old_value     : old_value,
								new_value     : new_value,
								object        : object,
								property_name : property
							});
						}
					}
				}
			},
			set : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : function (value) {
					if ( this.on_set ) value = this.on_set(value);
					new_value = value;
					this.call_observers();
				}
			},
			get : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : function () {
					var return_value = new_value;
					if ( this.on_get ) return_value = this.on_get(return_value);
					return return_value;
				}
			},
			set_as : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : function ( what, value ) {
					if ( !this.on_set_as )       throw new Error("This property does not have any \"set as\" methods");
					if ( !this.on_set_as[what] ) throw new Error("Property does not have a \"set as\" method by the name of "+ what );
					new_value = this.on_set_as[what](new_value);
					this.call_observers();
				}
			},
			get_as : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : function ( what, value ) {
					if ( !this.on_get_as )       throw new Error("This property does not have any \"get as\" methods");
					if ( !this.on_get_as[what] ) throw new Error("Property does not have a \"get as\" method by the name of "+ what );
					return this.on_get_as[what](new_value);
				}
			},
			delete : {
				configurable : true,
				enumerable   : false,
				writable     : false,
				value        : function () {
					// should probably pass it the entire model object here
					if ( this.on_delete ) this.on_delete();
					delete parent[property];
				}
			}
		});

		return model;

	},

})