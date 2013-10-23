define({
	main : {
		app              : "app",
		manifest         : "manifest/manifest",
		manifest_modules : {
			mains : ["library/extend"],
			extentions : [
				"library/extend.old",
				"library/extend.main",
				"library/extend.main.notify",
				"library/extend.main.head",
				"library/extend.main.navigation",
				"library/extend.main.home",
				"library/extend.main.shop",
				"library/extend.foot",
				"library/extend.backend",
				"library/extend.backend.data",
				"library/extend.backend.data.table",
				"library/extend.backend.data.admin",
				"library/extend.backend.data.scan",
				"library/extend.backend.data.book",
			]			
		}
	},
	sorter  : {
		sort_relationship : {
			libraries : "basic",
			old       : "old",
		},
		module            : [
			"manifest/manifest.sorter.basic",
			"library/manifest.sorter.old",
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
			"library/algorithm",
			"library/router",
		],
		old : [
			"library/old/old_app",
			"library/old/manifest/jquery",
			"library/old/manifest/alpha",
			"library/old/manifest/manifest.alpha",
			"library/old/manifest/observe.alpha",
			"library/old/manifest/route.alpha",
			"library/old/library/amazon.alpha",
			"library/old/library/scroll.alpha",
			"library/old/library/book.alpha",
			"library/old/library/table.alpha",
		],
		data  : [
			"library/terms_and_conditions"
		],
	}
});