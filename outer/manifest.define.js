define({
	main : {
		app              : "app",
		manifest         : "manifest/manifest",
		manifest_modules : {
			mains : ["library/extend"],
			extentions : [
				"library/extend.foot"
			]			
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
		libraries  : [
			"library/node_making_tools",
			"library/observe",
			"library/animator"
		],
		data : [
			"library/terms_and_conditions"
		],
	}
});