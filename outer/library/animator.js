define({
	
	make : function () {

		this.animation_queue = [];
		this.time            = 0;
		this.support         = {
			animation : {
				request_animation_frame : false,
				performance         : false
			}
		};
		this.get_animation_request_frame();
		this.get_animation_perfomance_support();
	},

	animate : function (instructions) {

		this.queue_animation(instructions);

		if ( this.animation_queue.length === 1 ) this.animation_loop();
	},

	queue_animation : function (instructions) {

		this.animation_queue.push({
			type         : ( instructions.object ? "animate_object" : "animate_element" ),
			arguments    : instructions,
			time_elapsed : 0
		});
	},

	animation_loop : function () {

		var running, last_frame = this.performance(), loop, prototype = this;

		loop = function ( now ) {

			now = prototype.performance();

			if ( running !== false  ) {
				window.requestAnimationFrame( loop );
				running    = prototype.render( now - last_frame );
				last_frame = now;
			}
		}

		loop( last_frame );
	},

	render : function (timestamp) {

		var index;

		for (index = 0; index < this.animation_queue.length; index++ ) {
			if ( this.process_queued_animation(this.animation_queue[index], timestamp) === false ) {
				this.animation_queue.splice( index, 1 );
			}
		}

		if ( this.animation_queue.length === 0 ) return false;
	},

	process_queued_animation : function (animation, timestamp) {

		animation.time_elapsed += timestamp;

		if ( this.animation_methods[animation.type].call(this, animation.arguments, animation.time_elapsed) === false ) return false;
	},

	animation_methods : {

		animate_element : function (instructions, time_elapsed) {

			var properties_without_a_postfix;
			properties_without_a_postfix = ["opacity"];

			for (var index = 0; index < instructions.property.length; index++) {

				if ( this.animator({
					object         : instructions.element.style,
					property       : instructions.property[index],
					time_elapsed   : time_elapsed,
					start_value    : instructions.from[index],
					end_value      : instructions.to[index],
					easing         : ( !instructions.with_easing || instructions.with_easing === false ? "none" : instructions.with_easing ),
					duration       : instructions.how_long,
					postfix        : ( properties_without_a_postfix.indexOf(instructions.property[index]) === -1 ? "px" : "" )
				}) === false ) {

					instructions.property.splice(index, 1 );
					instructions.to.splice(index, 1 );
				}
			}

			if ( instructions.property.length === 0 ) return false;
		},

		animate_object : function (instructions, time_elapsed) {

			return this.animator({
				object         : instructions.object,
				property       : instructions.property,
				time_elapsed   : time_elapsed,
				start_value    : instructions.from,
				end_value      : instructions.to,
				easing         : ( !instructions.with_easing || instructions.with_easing === false ? "none" : instructions.with_easing ),
				duration       : instructions.how_long
			});
		}
	},

	animator : function (animation) {

		var value, precentage_of_progress;

		animation.postfix                    = animation.postfix || 0;
		precentage_of_progress               = animation.time_elapsed/animation.duration;
		value                                = animation.start_value + ( animation.end_value - animation.start_value ) * this.easing.library[animation.easing].call(this, precentage_of_progress);
		value                                = ( precentage_of_progress >= 1 ? animation.end_value : value );
		animation.object[animation.property] = value + animation.postfix;

		return ( value === animation.end_value ? false : value );
	},

	easing : {
		library    : {

			none : function (t) {
				return t;
			},

			easeInQuad : function (t) {

				return this.easing.components.quad( t );
			},

			easeInCubic : function (t) {
				return this.easing.components.cubic( t );
			},

			easeInQuart : function (t) {
				return this.easing.components.quart( t );
			},

			easeInQuint : function (t) {
				return this.easing.components.quint( t );
			},

			easeInSine : function (t) {
				return this.easing.components.sine(t);
			},

			easeInExpo : function (t) {
				return this.easing.components.expo( t );
			},

			easeInCirc : function (t) {
				return this.easing.components.circ( t );
			},

			easeOutQuad : function (t) {
				return this.easing.tools.reverse( this.easing.components.quad, t );
			},

			easeOutCubic : function (t) {
				return this.easing.tools.reverse( this.easing.components.cubic, t );
			},

			easeOutQuart : function (t) {
				return this.easing.tools.reverse( this.easing.components.quart, t );
			},

			easeOutQuint : function (t) {
				return this.easing.tools.reverse( this.easing.components.quint, t );
			},

			easeOutSine : function (t) {
				return this.easing.tools.reverse( this.easing.components.sine, t );
			},

			easeOutExpo : function (t) {
				return this.easing.tools.reverse( this.easing.components.expo, t );
			},

			easeOutCirc : function (t) {
				return this.easing.tools.reverse( this.easing.components.circ, t );
			},

			easeInOutQuad : function (t) {
				return this.easing.tools.reflect( this.easing.components.quad, t );
			},

			easeInOutCubic : function (t) {
				return this.easing.tools.reflect( this.easing.components.cubic, t );
			},

			easeInOutQuart : function (t) {
				return this.easing.tools.reflect( this.easing.components.quart, t );
			},

			easeInOutQuint : function (t) {
				return this.easing.tools.reflect( this.easing.components.quint, t );
			},

			easeInOutSine : function (t) {
				return this.easing.tools.reflect( this.easing.components.sine, t );
			},

			easeInOutExpo : function (t) {
				return this.easing.tools.reflect( this.easing.components.expo, t );
			},

			easeInOutCirc : function (t) {
				return this.easing.tools.reflect( this.easing.components.circ, t );
			},
		},

		components : {

			quad  : function (t) {
				return Math.pow( t, 2 );
			},

			cubic : function (t) {
				return Math.pow( t, 3 );
			},

			quart : function (t) {
				return Math.pow( t, 4 );
			},

			quint : function (t) {
				return Math.pow( t, 5 );
			},

			sine : function (t) {
				return 1 - Math.cos(t * Math.PI / 2);
			},

			expo : function (t) {
				return Math.pow(2, 10 * (t - 1 ));
			},

			circ : function (t) {
				return 1 - Math.sqrt(1 - t * t);
			}
		},
		tools      : {

			reverse : function (method, t) {
				return 1 - method(1 - t);
			},

			reflect : function (method, t) {
				return 0.5 * (t < 0.5 ? method(2 * t) : (2 - method(2 - 2 * t)));
			}
		},

	},

	get_animation_request_frame : function () {

		var last_time, index, vendors, chosen_method;

		last_time = 0;
		index     = 0;
		vendors   = ['ms', 'moz', 'webkit', 'o'];

		for(; index < vendors.length && !window.requestAnimationFrame; ++index) {

			chosen_method = window[vendors[index]+'RequestAnimationFrame'];

			if ( chosen_method ) {
				window.requestAnimationFrame = chosen_method;
				this.support.animation.request_animation_frame = vendors[index];
			}
		}

		if (!window.requestAnimationFrame) {

			this.support.animation.request_animation_frame = "custom";

			window.requestAnimationFrame = function(callback) {

				var current_time, time_to_call, id;

				current_time = new Date().getTime();
				time_to_call = Math.max(0, 16 - (current_time - last_time));
				last_time    = current_time + time_to_call;
				id = window.setTimeout(function() {
					callback(current_time + time_to_call);
				}, time_to_call);
				return id;
			};
		}
	},

	get_animation_perfomance_support : function () {

		this.support.animation.performance = ( window.performance && window.performance.now ? true : false );
	},

	performance : function () {
		return ( this.support.animation.performance ? window.performance.now() : +new Date() );
	},

});