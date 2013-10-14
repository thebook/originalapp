define({

	make : function (instructions, modules) {

		var self      = this
		this.settings = instructions
		this.model    = Object.create(modules.model)
		this.table    = Object.create(modules.table)
		this.maker    = Object.create(modules.node_making_tools)

		this.table.make({
			setup : this.settings.table.setup,
			box : {
				submit : function (data) {
					self.model.submit_model_as({
						properties : function () {
							return self.settings.submit_changed_value(data)
						}
					})
				},
				definitions : this.settings.table.fields
			}	
		}, modules )


		this.model.make({
			settings : {
				main_path        : this.settings.data.retrieve.path,
				main_extension   : "",
				retrieve_on_make : [
					"table",
				],
			},
			retrieve  : {    
				table : {
					paramaters : this.settings.data.retrieve.paramaters,
					map        : function (data) {
						this.table = ( self.settings.data.retrieve.method ? self.settings.data.retrieve.method.call(this, data) : data )
						self.table.update(this.table)
					}
				}
			},
			submit : {
				field : {
					properties : {}
				}
			},
			model : {
				table : []
			}
		})

		return this.table.main.wrap.node
	},
})