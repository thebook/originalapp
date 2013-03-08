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