define({
	main : {
		app              : "app",
		manifest         : "manifest/manifest",
		// manifest_modules : ["library/extend", "library/extend.tailor"],
		manifest_modules : {
			mains : ["library/extend"], 
			second_level : ["library/extend.tailor"],
		}
	},
	sorter  : {
		sort_relationship : {
			libraries : "basic",
		},
		module            : ["manifest/manifest.sorter.basic"],
		default_sorter    : "basic"
	},
	module  : {
		libraries  : [],
		parts      : [],
		data       : [], 	
		other      : ["library/extend.tailor"],
		components : ["library/observe","library/extend"]
	}
});