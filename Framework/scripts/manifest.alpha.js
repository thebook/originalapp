var alpha = (function ( alpha, $ ) {

	alpha.thought = function () { 
		
		return { 
			manifest : function (where) {
				return alpha.thought.prototype.manifest.call(alpha.thought, { 
					what  : this.thought, 
					where : where
				});
			}
		};
	};

	alpha.thought.prototype.manifest = function (passed) {

		var prototype = this.prototype;

		return prototype.manifestor(passed.what, passed.where);

	};

	alpha.thought.prototype.bind_event = function (instructions) { 

		instructions.to.on(instructions.for_the_event, 
		function (event) {
			if ( !instructions.is_slumbering ) instructions.call_function.call(instructions.parent, { self : instructions.to, instructions : instructions.paramaters });
		});		
	};

	alpha.thought.prototype.instructions = function (parent, self, instructions) { 

		if ( instructions.on ) { 
			this.bind_event({
				to    	      : self, 
				for_the_event : instructions.on.the_event,
				is_slumbering : instructions.on.is_slumbering,
				call_function : instructions.on.call,
				paramaters    : instructions.on.with_instructions,
				parent	      : parent
			});
		}

		return instructions;
	};

	alpha.thought.prototype.manifestor = function (what, where) { 

		var prototype = this;

		$.each(what, function (name, body) { 
			var has_components_five_out_of = 0;

			console.log(name);

			if ( body.self ) { 
				console.log("has a self"); 
				// wrap with the manifest object and return 
				body.self = $(body.self);
				// append 
				where.append(body.self);
				// increment components it has
				has_components_five_out_of++;
			}

			if ( body.instructions ) { 
				console.log("enter various properties"); 
				body.instructions = prototype.instructions(what, body.self, body.instructions);
				has_components_five_out_of++;
			}

			if ( body.branch ) { 
				console.log("fuller branch");
				has_components_five_out_of++;
			}
			if ( body.last_branch ) { 
				console.log("leaf branch"); 
				has_components_five_out_of++;
			}


			if ( has_components_five_out_of === 0 ) {
				console.log("begin anew");
				alpha.thought.prototype.manifestor(body, where);
			}
		});
		console.log(what);
		return what;
		// $.each( thoughts_of_what_to_manifest, function (name, body) { 

		// 	body.self = $(body.self);

		// 	append_to.append(body.self);

		// 	if ( body.branch ) { 
														
		// 		$.each( body.branch, function (branch_name, branch_body) { 

		// 			if ( branch_body.constructor === String ) {

		// 				branch_body 			 = $(branch_body);
		// 				body.branch[branch_name] = $(branch_body);
		// 				body.self.append(branch_body);
		// 			}
		// 		});

		// 		if ( body.branch.branch ) prototype.manifestor(body.branch.branch, body.self);

		// 	}
		// });

		// return thoughts_of_what_to_manifest;				
	};



	return alpha;

})(alpha || {}, jQuery );