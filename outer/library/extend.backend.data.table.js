define({

	make : function (instructions, modules) {

		this.model = Object.create(modules.model)
		this.table = Object.create(modules.table)
		this.maker = Object.create(modules.node_making_tools)

		this.model.make({
			settings : {
				main_url         : "",
				main_extension   : "",
				retrieve_on_make : [
					"",
					""
				],
			},
			model : []
		})

		this.model.send_ajax_request({
			type : "GET",
			data : {
				action : "get_account",
				method : "table",
			},
			url  : instructions.data.retrieve.path
		})

		return this.maker.create_and_return_node({
			property : {
				textContent : "stuff"
			}
		})
	},
})