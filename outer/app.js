define(function () {

	var app = function (thought, modules) {

		
		console.log(thought);
		console.log(modules);
		console.log("were here");
		// console.log("done");

		// stuff = {
		// 	other : "stuff"
		// };

		// new modules.components.observe({
		// 	object   : stuff,
		// 	property : "other",
		// 	observer : function () {
		// 		console.log("i observer");
		// 	}
		// });
		// console.log(thought);
		// console.log(components);
		// console.log(parts);

		world = Object.create(thought);

		world.make({
			parts   : {
				observer : modules.components.observe
			},
			thought : {
				bar : {
					self : ".bar"
				},
				animation : {
					instructions : {
						extend : {
							into : "tailor",
						}
					},
					self : ".tailor"
				}
			}
		});

		world.manifest(document.body);
		// console.log(thought.prototype)
	};

	return app;
});