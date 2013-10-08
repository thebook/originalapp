define({
	make : function (to_sort) {

		var module_object, index, module_name;

		index         = 0
		module_object = {};

		for (; index < to_sort.modules.length; index++) {
			module_name = to_sort.paths[index].split("/");
			module_name = module_name[module_name.length-1].split(".");
			module_name = module_name[module_name.length-1];
			module_object[module_name] = to_sort.modules[index];
		}

		return module_object;
	}
});