(function () {
	
	var require_js_script, path, scripts, index;

	index                    = 0
	path                     = ""
	scripts                  = document.head.children
	for (; index < scripts.length; index++)
		if ( scripts[index].nodeName === "SCRIPT" && scripts[index].getAttribute("data-path") )
				path = scripts[index].getAttribute("data-path") + "/"
	require_js_script        = document.createElement("script")
	require_js_script.setAttribute("data-main", path );
	require_js_script.src    = path+"manifest/require.js"
	require_js_script.onload = function () {

		requirejs(["manifest.define", "manifest/manifest.default-define", "manifest/manifest.sort_helper"], function (define, default_define, sort_helper) {
				
			var sort = Object.create(sort_helper);

			if ( define.requirejs ) 
				requirejs.config(define.requirejs);
			sort.require = requirejs;
			sort.set_paths({
				main   : define.main,
				module : define.module,
				sorter : define.sorter.module
			});
			sort.set_sorter(define.sorter);

			sort.require_all();
		});
	};

	document.head.appendChild(require_js_script);
})();