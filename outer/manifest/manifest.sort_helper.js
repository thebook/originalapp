define({

	require : {},
	module  : {},
	sorter  : {},
	loaded  : {
		main   : false,
		module : false,
		sorter : false
	},
	paths   : {
		original : {
		},
		main   : [],
		module : [],
		sorter : []
	},

	require_all : function () {

		var self = this;

		this.require(this.paths.main, function () {
			self.sort_main_modules.call(self, arguments);
			self.loaded.main = true;
			self.check_if_to_begin.call(self);
		});		

		this.require(this.paths.module, function () {
			self.module.library = self.assign_loaded_modules_to_their_groups({
				map       : self.paths.original.module.positions,
				reference : arguments
			});
			self.loaded.module  = true;
			self.check_if_to_begin.call(self);
		});	

		this.require(this.paths.sorter, function () {
			self.module.sorter = self.create_object_with_module_names_as_keys_for_modules({
				paths     : self.paths.sorter,
				reference : arguments
			});
			self.loaded.sorter = true;
			self.check_if_to_begin.call(self);
		});	
	},

	check_if_to_begin : function () {

		if ( this.loaded.module && this.loaded.sorter ) {
			this.module.library.sorted = this.sort_references_in_object({
				path              : this.paths.original.module.paths,
				modules           : this.module.library,
				sort_relationship : this.sorter.relationship,
				default_sorter    : this.sorter.default,
				sorter            : this.module.sorter
			});
		}

		if ( this.loaded.main && this.loaded.module && this.loaded.sorter ) {
			this.module.main.call(window, this.module.manifest, this.module.library.sorted );
		}
	},

	sort_main_modules : function (modules) {

		var index, module_name, name, components_reference, name_index;

		this.module.main     = modules[0];
		this.module.manifest = modules[1];
		
		for ( index = 2; index < this.paths.main.length; index++ ) {
			name                 = this.paths.main[index].split("/");
			name                 = name[name.length-1].split(".");
			module_name          = name[name.length-1];
			components_reference = this.module.manifest.components;
			if ( name.length > 1 ) {
				for ( name_index = 0; name_index < name.length-1; name_index++) {
					if ( !components_reference[name[name_index]].components ) {
						throw new Error( module_name +" can not be made a component of "+ name[name_index] +" becayse "+ name[name_index] +" does not have a \"components\" object in its prototype chain");
					} 
					components_reference = components_reference[name[name_index]].components;
				}
			}				
			components_reference[module_name] = modules[index];
		}
	},

	create_object_with_module_names_as_keys_for_modules : function (module) {

		var reference_object, index;

		index            = 0;
		reference_object = {};

		for (; index < module.paths.length; index++)
			reference_object[this.strip_out_last_word_of_module_path(module.paths[index])] = module.reference[index];

		return reference_object;
	},

	strip_out_last_word_of_module_path : function (path) { 
		
		path = path.split("/")
		path = path[path.length-1].split(".")
		return ( path[path.length-1] === "js" ? path[path.length-2] : path[path.length-1] );
	},

	set_paths : function (paths) {

		this.paths.original.main   = paths.main;
		this.paths.original.module = {
			positions : this.get_an_object_representing_positions_of_groups_in_a_flat_array(paths.module),
			paths     : paths.module
		};
		this.paths.original.sorter = paths.sorter;
		this.paths.main            = this.concat_all_paths_within_object(paths.main);
		this.paths.module          = this.concat_all_paths_within_object(paths.module);
		this.paths.sorter          = this.concat_all_paths_within_object(paths.sorter);
	},

	set_sorter : function (sorter) {
		this.sorter.relationship = sorter.sort_relationship || {};
		this.sorter.default      = sorter.default_sorter    || "basic";
	},

	concat_all_paths_within_object : function (object) {

		var paths = [];

		for ( var memeber in object ) { 
			if ( object[memeber].constructor === String ) paths.push(object[memeber]);
			if ( object[memeber].constructor === Array  ) paths = paths.concat(object[memeber]);
			if ( object[memeber].constructor === Object ) paths = paths.concat(this.concat_all_paths_within_object(object[memeber]));
		}

		return paths;
	},

	get_an_object_representing_positions_of_groups_in_a_flat_array : function (object) {

		var count, mapped_object;

		count         = 0;
		mapped_object = {};

		for ( var group in object ) {
			mapped_object[group] = {
				begin : count,
				end   : count + object[group].length
			}
			count = count + object[group].length;
		}

		return mapped_object;
	},

	assign_loaded_modules_to_their_groups : function (object) { 

		var reference_object = {};

		for ( var group in object.map ) {
			reference_object[group] = Array.prototype.slice.call(
				object.reference, 
				object.map[group].begin,
				object.map[group].end
			);
		}

		return reference_object;
	},

	sort_references_in_object : function (object) {

		var sorted_object, sorter;

		sorted_object = {};

		for ( var group in object.modules ) {
			if ( object.modules[group].length > 0 ) {
				sorter                = object.sort_relationship[group] || object.default_sorter;
				sorted_object[group]  = Object.create(object.sorter[sorter]).make({
					modules : object.modules[group],
					paths   : object.path[group]
				});
			}
		}

		return sorted_object;
	},

	shallow_copy_object : function (object) { 

		var new_object = {};

		for ( var property in object )
			if ( object.hasOwnProperty(property) ) 
				new_object[property] = object[property];

		return new_object;
	}
});	