define({
	main : {
		app              : "app",
		manifest         : "manifest/manifest",
		manifest_modules : {
			mains : ["library/extend"],
			extentions : [
				"library/extend.foot",
				"library/extend.backend",
				"library/extend.backend.data",
				"library/extend.backend.data.table",
				"library/extend.backend.data.admin",
			]			
		}
	},
	sorter  : {
		sort_relationship : {
			libraries : "basic",
			// parts     : "part"
		},
		module            : [
			"manifest/manifest.sorter.basic",
			// "library/manifest.sorter.part",
		],
		default_sorter    : "basic"
	},
	module  : {
		libraries  : [
			"library/node_making_tools",
			"library/observe",
			"library/animator",
			"library/model",
			"library/table",
			"library/request",
		],
		// parts : [
		// 	"library/part/wrap",
		// 	"library/part/wrap.foot",
		// 	"library/part/wrap.backend",
		// ],
		data  : [
			"library/terms_and_conditions"
		],
	}
});