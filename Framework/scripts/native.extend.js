if (!Object.prototype.watch) {

	Object.defineProperty(Object.prototype, "watch", {
		configurable: true, 
		enumerable  : false, 
		writable    : false, 
		value       : function (prop, handler) {

			var oldval = this[prop], 
				newval = oldval, 
				getter = function () {
					return newval;
				}, 
				setter = function (val) {
				
					oldval = newval;
					return newval = handler.call(this, prop, oldval, val);
				};
			
			if (delete this[prop]) { // can't watch constants

				Object.defineProperty(this, prop, {
					  get         : getter, 
					  set         : setter, 
					  enumerable  : true, 
					  configurable: true
				});
			}
		}
	});
}

if (!Object.prototype.unwatch) {

	Object.defineProperty(Object.prototype, "unwatch", {
		enumerable  : false, 
		configurable: true, 
		writable    : false, 
		value       : function (prop) {
			var val = this[prop];
			delete this[prop]; // remove accessors
			this[prop] = val;
		}
	});
}

if ( !Object.prototype.keys ) {

	Object.defineProperty(Object.prototype, "keys", {
		enumerable   : false,
		configurable : true,
		writable     : false,
		value        : function () {

			var object = this, keys = [];

			for ( property in object )
				object.hasOwnProperty(property) && keys.push(property);

			return keys;
		}
	});
}

if ( !Object.prototype.add ) {

	Object.defineProperty(Object.prototype, "add", {
		enumerable   : false,
		configurable : true,
		writable     : false,
		value 		 : function (value) {

			var object = this, keys = [], new_key;

			for ( property in object )
				object.hasOwnProperty(property) && keys.push(property);

			new_key =  keys.length + 1;

			object[new_key] = value;

			return object;
		}
	});
}

if ( !Object.prototype.is_number ) {

	Object.defineProperty(Object.prototype, "is_number", {
		enumerable   : false,
		configurable : true,
		writable     : false,
		value 		 : function () {

			return !isNaN(parseFloat(this)) && isFinite(this);
		}
	});
}

if ( !String.prototype.trim ) {

	Object.defineProperty(String.prototype, "trim", {
		enumerable   : false,
		configurable : true,
		writable     : false,
		value 		 : function () {

			var	str = this.replace(/^\s\s*/, ''),
				ws  = /\s/,
				i   = str.length;
				
				while (ws.test(str.charAt(--i)));
				
				return str.slice(0, i + 1);
		}
	});
}

if ( !String.prototype.is_length_between ) {

	Object.defineProperty(String.prototype, "is_length_between", {
		enumerable   : false,
		configurable : true,
		writable     : false,
		value 		 : function (first_marker, second_marker) {

			return (this.length > first_marker && this.length < second_marker);
		}
	});
}