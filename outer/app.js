define(function () {

	var app = function (thought, modules) {

		world = Object.create(thought);

		world.make({
			parts   : {
				node_making_tools : modules.libraries.node_making_tools
			},
			thought : {
				wrap : {
					self : ".wrap",
					children : {
						foot : {
							instructions : {
								extend : { 
									into : "foot",
									pass : {
										settings : {
											advert_title  : "Advertising",
											pdf_link      : "",
											advert_images : [],
										}
									}
								}
							},
							self : ".footer"
						}
					}
				},
				
			}
		});

		world.manifest(document.body);
	};

	return app;
});