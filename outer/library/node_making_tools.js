define({

	create_parts : function (part) {

		var parts_object;

		parts_object = {};

		for ( var element in part ) {
			
			parts_object[element]      = {}; 
			
			if ( part[element].children && part[element].children.constructor === Object ) 
				parts_object[element]  = this.create_parts(part[element].children);	

			parts_object[element].node = this.create_and_return_node(part[element]);

			if ( part[element].children && part[element].children.constructor === Function ) 
				parts_object[element]  = part[element].children.call(this, parts_object[element]);

		}

		return parts_object;
	},

	append_parts : function (append) {

		var property_count, node;

		for ( var part in append.parts ) {

			if ( part !== "node" && append.parts.hasOwnProperty(part) ) {
				property_count = 0;

				for ( var property in append.parts[part] ) 
					if ( append.parts[part].hasOwnProperty(property) && property !== "node") 
						property_count = property_count + 1;
				
				if ( append.parent ) append.parent.appendChild(append.parts[part].node);
				if ( property_count >= 1 ) this.append_parts({ 
					parts : append.parts[part], parent : append.parts[part].node
				});
			}
		}
	},

	create_and_return_node : function (of) {

		var node, style_property, property, attribute, method;

		node = document.createElement(of.type);

		for ( style_property in of.style )
			if ( of.style.hasOwnProperty(style_property) )
				node.style[style_property] = of.style[style_property];

		for ( attribute in of.attribute )
			if ( of.attribute.hasOwnProperty(attribute) )
				node.setAttribute(attribute, of.attribute[attribute])

		for ( property in of.property )
			if ( of.property.hasOwnProperty(property) )
				node[property] = of.property[property];

		for ( method in of.methods )
			if ( of.methods.hasOwnProperty(method) )
				node[method].apply(node, of.methods[method]);

		return node;
	},

});