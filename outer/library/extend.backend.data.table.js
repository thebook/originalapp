define({

	make : function (instructions, modules) {

		var self   = this
		this.model = Object.create(modules.model)
		this.table = Object.create(modules.table)
		this.maker = Object.create(modules.node_making_tools)

		this.table.make({
			setup      : {
				row_id : "email"
			},
			dimensions : {
				padding    : 30,
				box_height : 100,
				box_width  : 100,
				height     : 400,
				width      : "",
			},
			box : {
				submit : function (data) {
					self.model.submit_model_as({
						properties : function () {
							return {
								action : "set_account",
								method : "account_value",
								paramaters : {
									email       : data.row_id,
									column_name : data.column_name,
									value       : data.box_value
								}
							}
						}
					})
				},
				definitions : [
					{
						title: "first name",
						name : "first_name",
					},
					{
						title: "email",
						name : "email",
					},
					{
						title: "id",
						name : "id",
					},
					{
						title: "password",
						name : "password",
					},
					{
						title: "university",
						name : "university",
					},
					{
						title: "year",
						name : "year",
					},
					{
						title      : "subject",
						name       : "subject",
					},
					{
						title      : "status",
						name       : "status",
						changeable : {
							by      : "dropdown",
							choices : [
								{
									title : "ordered pack",
									name  : "ordered_pack"
								},
								{ 
									title : "sent pack",
									name  : "sent_pack"
								},
								{ 
									title : "received",
									name  : "received"
								},
								{ 
									title : "paid",
									name  : "paid"
								},
								{ 
									title : "problem",
									name  : "problem"
								},
								{ 
									title : "passive",
									name  : "passive"
								}
							]
						}
					},
					{
						title : "comment",
						name  : "comment",
						changeable : { 
							by     : "text"
						}
					}
				]	
			}	
		}, modules )


		this.model.make({
			settings : {
				main_path        : instructions.data.retrieve.path,
				main_extension   : "",
				retrieve_on_make : [
					"table",
				],
			},
			retrieve  : {    
				table : {
					paramaters : instructions.data.retrieve.paramaters,
					map        : function (data) {
						this.table = JSON.parse(data)["return"]
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