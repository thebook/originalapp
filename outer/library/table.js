define({

	make : function (instructions, modules) {

		var self = this

		this.maker       = Object.create(modules.node_making_tools)
		this.setup       = {
			row_id       : instructions.setup.row_id           || "id",
			box_height   : instructions.dimensions.box_height  || 100,
			box_width    : instructions.dimensions.box_width   || 100,
			content_width: ( instructions.dimensions.box_width || 100 ) * instructions.box.definitions.length
		}
		this.data        = []
		this.box         = instructions.box
		this.class_names = {
			wrap                : "table_wrap",
			boxes               : "table_boxes",
			names               : "table_names",
			name                : "table_name",
			row                 : "table_row",
			box                 : "table_box",
			box_dropdown        : "table_box_dropdown",
			box_dropdown_option : "table_box_dropdown_option",

			selected_row   : "",
			table_titles   : "",
			title          : "",
			table_wrap     : "",
			head           : "",
			field          : "",
			selected_field : "",
			used_field     : "",
			option_wrap    : "",
			option         : {
				button      : "",
				box         : "",
				description : "",
				input       : "",
			}
		}		
		this.main       = this.maker.create_parts({
			wrap : {
				attribute : {
					"class" : this.class_names.wrap
				},
				children : {
					names   : {
						style : {
							width : this.setup.content_width +"px"
						},
						attribute : {
							"class" : this.class_names.names
						},
						children : function (parent) {

							for (var index = 0; index < self.box.definitions.length; index++)
								parent["column_"+self.box.definitions[index].name] = {
									node : this.create_and_return_node({
										style : {
											height : self.setup.box_height +"px",
											width  : self.setup.box_width +"px"
										},
										property  : {
											textContent : self.box.definitions[index].title
										},
										attribute : {
											"class" : self.class_names.name
										}
									})
								}

							return parent
						}
					},
					content : {
						style : {
							width : this.setup.content_width +"px"
						},
						attribute  : {
							"class": this.class_names.boxes
						},
					},
				}
			}
		})
		this.maker.append_parts({
			parts : this.main
		})

		return this
	},

	update : function (data) {

		this.data = data

		for (var index = 0; index < data.length; index++)
			this.main.wrap.content.node.appendChild(this.create_row({
				data : data[index],
				id   : index
			}))

	},

	create_row : function (row) { 

		var self, node
		console.log(row)
		self = this
		node = this.maker.create_parts({	
			row : {
				attribute : {
					"class" : this.class_names.row
				},
				children : function (parent) {

					var column, definition

					for ( var column in row.data )
						if ( definition = self.get_box_definition_by_name(column) )
							parent[column] = {
								node : self.create_box_based_on_definition({
									row_id     : row.data[self.setup.row_id],
									column_name: column,
									definition : definition,
									data       : row.data[column]
								})
							}

					return parent
				}
			}
		})

		this.maker.append_parts({
			parts : node
		})

		return node.row.node
	},

	create_box_based_on_definition : function (box) {

		var definition, self, box_node, open

		open       = false
		self       = this
		definition = {
			field : {
				style : {
					height: self.setup.box_height +"px",
					width : self.setup.box_width +"px"
				},
				attribute  : {
					"class"            : this.class_names.box,
					"data-row-id"      : box.row_id,
					"data-column-name" : box.column_name,
				},
				children : {
					text : {
						property : {
							textContent : box.data
						}
					}
				}
			}
		}

		if ( box.definition.changeable && box.definition.changeable.by === "dropdown" )
			definition.field = this.extend_box_definition_into_dropdown(definition.field, box)

		box_node = this.maker.create_parts(definition)

		this.maker.append_parts({
			parts : box_node 
		})

		return box_node.field.node
	},

	extend_box_definition_into_dropdown : function (definition, box) {

			var self = this

			definition.style.cursor = "pointer"
			definition.methods      = {
				addEventListener : ["click", function (event) {

					if ( !event.target.nextElementSibling || !event.target.nextElementSibling.getAttribute("data-open") ) return

					var is_open, dropdown

					dropdown = event.target.nextElementSibling
					is_open  = dropdown.getAttribute("data-open")

					if ( is_open === "false" ) {
						dropdown.style.display = "block"
						dropdown.setAttribute("data-open", "true" )
					}
					else {
						dropdown.setAttribute("data-open", "false" )
						dropdown.style.display = "none"
					}
				}]
			}
			definition.children.dropdown = {
				style     : {
					display : "none"
				},
				attribute : {
					"class"     : this.class_names.box_dropdown,
					"data-open" : false
				},
				methods : {
					addEventListener : ["click", function (event) {
						

						if ( event.target.getAttribute("data-option") ) {
							
							event.target.parentElement.previousSibling.textContent = box.definition.changeable.choices[event.target.getAttribute("data-option")].title
							self.assign_box_change_to_database({
								row_id      : event.target.parentNode.parentNode.getAttribute("data-row-id"),
								column_name : event.target.parentNode.parentNode.getAttribute("data-column-name"),
								box_value   : box.definition.changeable.choices[event.target.getAttribute("data-option")].title
							});
						}
					}]
				},
				children : function (parent) {

					for (var index = 0; index < box.definition.changeable.choices.length; index++) 
						parent["option_"+index] = {
							node : this.create_and_return_node({
								property : {
									textContent : box.definition.changeable.choices[index].title
								},
								attribute : {
									"data-option" : index,
									"class"       : self.class_names.box_dropdown_option
								}
							})
						}

					return parent 
				}
			}

		return definition
	},

	assign_box_change_to_database : function (box) {
		this.box.submit.call(this, box)
	},

	get_box_definition_by_name : function (name) {

		var index, definition

		index = 0
		definition = false

		for (; index < this.box.definitions.length; index++)
			if ( this.box.definitions[index].name === name )
				definition = this.box.definitions[index]

		return definition
	},

	old_make : function (wake) {

		var prototype;

		prototype            = this;
		this.self            = wake.self;
		wake.self.table      = {};
		wake.self.table.wake = {
			visuals                         : wake.visuals,
			max_row_load                    : wake.max_row_load,
			table_name                      : wake.table_name,
			width                           : wake.columns.length * wake.column_width,
			submit_field_callback           : wake.submit_field_callback,
			columns                         : wake.columns,
			column_width                    : wake.column_width,
			column_number                   : wake.column_number-1,
			row_height                      : wake.row_height,
			class_names                     : wake.class_names,
			length                          : wake.column_number * wake.column_width,
			number_of_columns_that_can_show : Math.floor(wake.self.clientWidth/wake.column_width)-1,
			number_of_rows_that_can_show    : Math.floor(wake.table_height/wake.row_height)-1
		}

		wake.self.table.component = {
			box    : "",
			titles : ""
		}
		wake.self.table.visible = {
			column : {
				left  : 0,
				right : wake.self.table.wake.number_of_columns_that_can_show
			},
			row : {
				top    : 0,
				bottom : wake.self.table.wake.number_of_rows_that_can_show
			}
		}
		wake.self.table.change = {
			history : [],
			value   : {
				changeing : false,
				selected  : null,
				changing  : false,
				column    : 0,
				row       : 0,
				value     : ""
			}
		}
		wake.self.table.selected = {
			history: [],
			current: {
				column : 0,
				row    : 0
			}
		}
		wake.self.table.notification  = {
			current : {},
			history : []
		}
		wake.self.table.revealed_rows = wake.max_row_load
		wake.self.table.selected_rows = []

		wake.self.table.submision_column_names = wake.submision_column_names
		wake.self.table.rows = []

		this.self.style.height = wake.table_height + "px"

		this.self.insertAdjacentHTML("afterbegin",
			'<div class="'+ this.self.table.wake.class_names.option_wrap +'"></div>'+
			'<div style="width:'+ this.self.table.wake.width                   +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_titles +'"></div>'+
			'<div style="width:685px; float:left; overflow:hidden; height:400px;">'+
				'<div style="width:'+ this.self.table.wake.width                  +'px;"'+
				'class="'+            this.self.table.wake.class_names.table_wrap +'"></div>'+
			'</div>');

		this.self.table.component.options     = this.self.children[0];
		this.self.table.component.titles      = this.self.children[1];
		this.self.table.component.box         = this.self.children[2].children[0];

		this.self.addEventListener("keydown", function (event) {
			prototype.keypress_handler(event);
		});

		this.self.addEventListener("click", function (event) {
			
			if ( event.target.tagName === "TEXTAREA" ) 
				prototype.field_selection_value_changer(event);
			if ( event.target.getAttribute("data-type-option-index") ) 
				prototype.call_method_for_clicked_option(event);
			if ( event.target.getAttribute("data-type-field") && prototype.self.table.change.value.selected !== event.target ) {
				prototype.come_out_of_field_editing();
			}
		});

		this.self.addEventListener("dblclick", function (event) {
			prototype.come_into_field_editing(event.target);
		});

		new alpha.observe({
			object   : this.self.table.selected,
			property : "current",
			observer : function (change) {
				prototype.field_selection_mover(change);
				prototype.visible_area_calculator(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.visible,
			property : "column",
			observer : function (change) {
				console.log(prototype.self.table.visible.row)
				console.log(prototype.self.table.visible.column)
				prototype.move_visisble_area_by_x_axis(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.visible,
			property : "row",
			observer : function (change) {
				prototype.move_visisble_area_by_y_axis(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.change.value,
			property : "value",
			observer : function (change) {
				prototype.submit_changed_value(change);
			}
		});

		this.create_table_titles();
		this.create_table_options(wake.options);
	},

	set_rows : function (rows) {
		console.log(rows);
		this.self.table.rows = rows;
		this.popuplate_table_rows();
	},

	set_row : function (row) { 

		// var row_html, column_number, column_name;

		// row_html      = "";
		// column_number = 0;

		// for (column_name in row ) {
		// 	column_number++;
		// 	row_html += this.create_and_return_html_of_a_table_field({
		// 		column_number : column_number,
		// 		column_name   : column_name,
		// 		row           : this.self.table.rows.length,
		// 		value         : row[column_name]
		// 	});
		// }

		this.self.table.rows.push(row);
		this.self.table.visible.row.bottom++;
		// this.self.table.component.box.insertAdjacentHTML("beforeend", row_html );

	},

	remove_selected_rows : function () {

		var rows, index, row;

		selected_rows = this.self.table.selected_rows;
		rows          = [];
		index         = 0;

		for (; index < this.self.table.rows.length; index++) {
			if ( selected_rows.indexOf(index) < 0 ) {
				row = this.self.table.rows.slice(index, index+1);
				rows.push(row[0]);
			}
		};
		this.self.table.selected_rows = [];
		this.self.table.rows          = rows;
		this.popuplate_table_rows();
	},

	calculate_the_order_number_of_the_first_field_in_the_currently_selected_row : function () {

		return field_child_number = ( this.self.table.selected.current.row ) * ( this.self.table.wake.column_number + 1 );
	},

	get_the_first_field_of_a_selected_row : function () {
		return this.self.table.component.box.children[this.calculate_the_order_number_of_the_first_field_in_the_currently_selected_row()];
	},

	add_or_remove_the_currently_selected_row_to_selected_rows : function () {

		var current_rows_index_in_array = this.self.table.selected_rows.indexOf(this.self.table.selected.current.row);

		if ( current_rows_index_in_array === -1 ) {
			this.self.table.selected_rows.push(this.self.table.selected.current.row);
			return true;
		} else { 
			this.self.table.selected_rows.splice(current_rows_index_in_array, 1 );
			return false;
		};
	},

	select_or_unselect_all_rows : function () { 
		if ( this.self.table.selected_rows.length === this.self.table.rows.length ) { 
			this.unselect_all_rows();
			return false;
		} else { 
			this.select_all_rows();
			return true;
		}
	},

	select_all_rows : function () {

		this.self.table.selected_rows = [];

		for (var index = 0; index < this.self.table.rows.length; index++) {
			this.self.table.selected_rows.push(index);
		};
	},

	unselect_all_rows : function () {

		this.self.table.selected_rows = [];
	},

	get_selected_rows  : function () {
		
		var index, rows, row_number, row;

		index = 0;
		rows  = [];
		for (; index < this.self.table.selected_rows.length; index++) {
			row_number = this.self.table.selected_rows[index];
			row        = this.self.table.rows[row_number];
			rows.push(row);
		}

		return rows;
	},

	get_selected_rows_property  : function (property) {
		var rows, desired_properties, index;

		rows  = this.get_selected_rows();
		index = 0;
		desired_properties = [];

		for (; index < rows.length; index++ ) {
			if ( !rows[index][property] ) throw new Error("property does not exist in the row, aborting");
			desired_properties.push(rows[index][property]);
		}

		return desired_properties;
	},

	move_visisble_area_by_y_axis : function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.self.table.wake.row_height * change.new.top );
		this.self.table.component.box.style.top = shift_by_this_much +"px";
	},

	move_visisble_area_by_x_axis : function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.get_width_of_the_hidden_column() * change.new.left );
		this.self.table.component.box.style.left = shift_by_this_much +"px";
		this.self.table.component.titles.style.marginLeft = shift_by_this_much +"px";
	},

	get_width_of_the_hidden_column : function () { 

		var column_number = this.self.table.visible.column.right + this.self.table.visible.column.left - 1;
		console.log(column_number);
		// return this.self.table.component.box.children[column_number].clientWidth;
		return this.self.table.wake.column_width;
	},

	visible_area_calculator : function (change) {

		if ( change.new.column < this.self.table.visible.column.left ) { 
			this.self.table.visible.column = {
				left  : change.new.column,
				right : this.self.table.wake.number_of_columns_that_can_show+change.new.column
			};
		}

		if ( change.new.column > this.self.table.visible.column.right ) { 
			this.self.table.visible.column = {
				left  : change.new.column-this.self.table.wake.number_of_columns_that_can_show,
				right : change.new.column
			};
		}

		if ( change.new.row < this.self.table.visible.row.top ) { 
			this.self.table.visible.row = {
				top    : change.new.row,
				bottom : this.self.table.wake.number_of_rows_that_can_show+change.new.row
			};
		}

		if ( change.new.row > this.self.table.visible.row.bottom ) { 
			this.self.table.visible.row = {
				top    : change.new.row-this.self.table.wake.number_of_rows_that_can_show,
				bottom : change.new.row
			};
		}
	},

	field_selection_value_changer : function (event) {

		this.self.table.selected.current = {
			column : parseInt( event.target.getAttribute("data-type-column-number") ),
			row    : parseInt( event.target.getAttribute("data-type-row") )
		}
	},

	field_selection_mover : function (change) {

		if ( change.new.row === change.old.row && change.new.column === change.old.column ) return;

		var current_field, previous_field;

		this.reveal_rows(change.new);

		previous_field = this.get_a_field_node(change.old);
		current_field  = this.get_a_field_node(change.new);

		this.self.table.selected.history.unshift({
			row    : change.old.row,
			column : change.old.column
		});

		current_field.focus();

		this.apply_style_to_node(current_field, this.self.table.wake.visuals.on_field);
		this.apply_style_to_node(previous_field, this.self.table.wake.visuals.not_on_field);
	},

	get_a_field_node : function (position) { 
		return document.getElementById( this.self.table.wake.table_name +"_column_"+ position.column +"_row_"+ position.row )
	},

	apply_style_to_node : function (node, style) {

		var property;

		for (property in style ) node.style[property] = style[property];
	},

	keypress_handler : function (event) {

		// left 37, up 38, right 39, down 40, ctr 17, z 90, x 88, enter 13, escape 27
		
		if ( event.keyCode === 27 ) {
			if ( event.target.tagName !== "TEXTAREA"  ) return;
			this.come_out_of_field_editing();		
		}

		if ( this.self.table.change.value.changeing ) return;

		if ( event.keyCode === 37 ) this.change_selected_field_based_on_current_position("left");

		if ( event.keyCode === 38 ) this.change_selected_field_based_on_current_position("up");

		if ( event.keyCode === 39 ) this.change_selected_field_based_on_current_position("right");

		if ( event.keyCode === 40 ) this.change_selected_field_based_on_current_position("down");

		if ( event.keyCode === 13 ) {
			if ( event.target.tagName !== "TEXTAREA" ) return;
			this.come_into_field_editing(event.target);
		}
	},

	change_selected_field_based_on_current_position : function (direction) {

		var current = {
			row    : this.self.table.selected.current.row,
			column : this.self.table.selected.current.column 
		};

		if ( direction === "up" ) {
			var row = current.row-1;
			current.row = ( row < 0 ? 0 : row );
		}

		if ( direction === "down" ) {
			var row = current.row+1;
			current.row = ( row > this.self.table.rows.length-1 ? this.self.table.rows.length-1 : row );
		}

		if ( direction === "left" ) {
			var column = current.column-1;
			current.column = ( column < 0 ? 0 : column );
		}

		if ( direction === "right" ) {
			var column = current.column+1;
			current.column = ( column > this.self.table.wake.column_number ? this.self.table.wake.column_number : column );
		}

		this.self.table.selected.current = current;
	},

	come_into_field_editing : function (target) { 

		if ( this.self.table.change.value.changeing ) return;

		target.removeAttribute("readonly");
		this.self.table.change.value.selected  = target;
		this.self.table.change.value.column    = target.getAttribute("data-type-column");
		this.self.table.change.value.row       = target.getAttribute("data-type-row");
		this.self.table.change.value.changeing = true;
	},

	come_out_of_field_editing : function () { 

		if ( !this.self.table.change.value.changeing ) return;

		this.self.table.change.value.selected.setAttribute("readonly");
		this.self.table.change.value.value = this.self.table.change.value.selected.value;
		this.self.table.rows[this.self.table.change.value.row][this.self.table.change.value.column] = this.self.table.change.value.value;
		this.self.table.change.value.changeing = false;
		this.self.table.change.history.unshift({
			row    : this.self.table.change.value.row,
			column : this.self.table.change.value.column,
			value  : this.self.table.change.value.value,
		});
	},

	reveal_rows : function (rows) { 

		if ( rows.row !== this.self.table.revealed_rows-2 ) return;

		var rows_to_reveal, number_of_rows_to_reveal, number_of_rows_revealed, index, column_number, html_of_rows;

		html_of_rows                   = "";
		index                          = 0;
		number_of_rows_revealed        = this.self.table.revealed_rows;
		number_of_rows_to_reveal       = this.self.table.rows.length - number_of_rows_revealed;
		number_of_rows_to_reveal       = ( number_of_rows_to_reveal > this.self.table.wake.max_row_load ? this.self.table.wake.max_row_load : number_of_rows_to_reveal );
		rows_to_reveal                 = this.self.table.rows.slice( number_of_rows_revealed-1, ( number_of_rows_revealed + number_of_rows_to_reveal ) );
		this.self.table.revealed_rows += number_of_rows_to_reveal+1;
		
		for (; index < rows_to_reveal.length; index++) { 

			column_number = -1;

			for (column_name in rows_to_reveal[index] ) {
				column_number++;
				html_of_rows += this.create_and_return_html_of_a_table_field({
					column_number : column_number,
					column_name   : column_name,
					row           : ( number_of_rows_revealed + index ) -1,
					value         : rows_to_reveal[index][column_name]
				});
			}
		}

		this.self.table.component.box.insertAdjacentHTML("beforeend", html_of_rows );

	},

	submit_changed_value : function (change) { 

		if ( change.old === change.new ) return;

		this.self.table.wake.submit_field_callback({
			value       : change.new,
			row         : this.self.table.rows[this.self.table.selected.current.row],
			column_name : this.self.table.submision_column_names[this.self.table.selected.current.column],
		});
	},

	// Creating,

	create_and_return_html_of_a_table_field : function (wake) { 

		return '<textarea '+ 
			'placeholder="empty"'+
			'id="'+ this.self.table.wake.table_name +'_column_'+ wake.column_number +'_row_'+ wake.row +'" '+
			'data-type-field="true"'+ 
			'data-type-row="'+    wake.row +'" '+
			'data-type-column="'+ wake.column_name +'" '+
			'data-type-column-number="'+ wake.column_number +'" '+
			'class="'+ this.self.table.wake.class_names.field +'" readonly="true">'+
			wake.value +
		'</textarea>';
	},

	create_table_titles : function () { 

		var index, titles;

		index  = 0;
		titles = "";

		for (; index < this.self.table.wake.columns.length; index++) {
			titles += '<div class="'+ this.self.table.wake.class_names.title +'">'+ 
				this.self.table.wake.columns[index] +
			'</div>';
		};

		this.self.table.component.titles.insertAdjacentHTML("afterbegin", titles );
	},

	popuplate_table_rows : function () { 

		var column_number, rows, column_name;
		
		rows = "";

		this.empty(this.self.table.component.box);
		this.self.table.selected_rows = [];

		for (var index = 0; index < this.self.table.rows.length; index++) {

			if ( index < this.self.table.wake.max_row_load -1 ) {

				column_number = -1;

				for (column_name in this.self.table.rows[index] ) {
					column_number++;
					rows += this.create_and_return_html_of_a_table_field({
						column_number : column_number,
						column_name   : column_name,
						row           : index,
						value         : this.self.table.rows[index][column_name]
					});
				}
			}
		};

		this.self.table.component.box.insertAdjacentHTML("afterbegin", rows );
	},

	empty : function (what) {
		while ( what.firstChild ) what.removeChild(what.firstChild);
	},

	create_table_options : function (options) {

		var index, html;

		html  = "";
		index = 0;

		this.self.table.options = {
			data        : [],
			definition  : [],
			box         : {
				initialised_box : [],
				open            : false
			}
		};

		for (; index < options.length; index++ ) {
			
			this.self.table.options.data.push({});
			this.self.table.options.definition.push(options[index]);

			html += '<div '+
				'data-type-option-index="'+ index +'" '+
				'class="'+ this.self.table.wake.class_names.option.button +'">'+
					options[index].name +
			'</div>';
		}

		this.self.table.component.options.insertAdjacentHTML("afterbegin", html );
	},

	call_method_for_clicked_option : function (change) {
		
		var option, box, previous_box;

		option_index = change.target.getAttribute("data-type-option-index");
		option       = this.self.table.options.definition[option_index];
		option.type  = ( option.type.constructor === String ? this.options[option.type] : option.type );

		if ( option.type.constructor === Function ) option.type.call(this, change);
		
		if ( option.type.constructor === Array ) {

			option.index           = option_index;
			option.button          = change.target;
			previous_opened_option = this.self.table.options.box.open;
			
			if ( this.self.table.options.box.open !== false ) {
				previous_box                     = document.getElementById(this.self.table.wake.table_name +'_option_'+ previous_opened_option );
				previous_box.style.display       = "none"
				this.self.table.options.box.open = false;	
			}

			if ( previous_opened_option === option.index ) return;

			if ( this.self.table.options.box.initialised_box.indexOf(option.index) === -1 ) {

				this.construct_an_box_option(option);
				this.self.table.options.box.initialised_box.push(option.index);
			} else { 
				box               = document.getElementById(this.self.table.wake.table_name +'_option_'+ option.index);
				box.style.display = "block";
			}

			this.self.table.options.box.open = option.index;
		}			
	},

	construct_an_box_option : function (option) {

		var box, index, part;

		index = 0;
		box   = document.createElement("div");
		box.id        = this.self.table.wake.table_name +'_option_'+ option.index;
		box.className = this.self.table.wake.class_names.option.box;

		for (; index < option.type.length; index++ ) {

			option.type[index].instructions.index = option.index;

			part = this.option_box_parts[option.type[index].type].call(
				this, option.type[index].instructions
			);

			box.appendChild(part);
		}
		
		option.button.insertAdjacentElement("afterend", box);
	},

	make_node : function (define_node) {

		var node, property;

		node = document.createElement(define_node.type);
		for ( property in define_node.with ) node[property] = define_node.with[property];

		return node;
	},

	add_events_to_node : function (instructions) { 

		var index, events;
		index = 0;

		if ( instructions.events.constructor === Array ) {

			for (; index < instructions.events.length; index++ ) this.add_an_event_listener_to_an_option_part({
				index  : instructions.option_index,
				node   : instructions.node,
				event  : instructions.events[index].event,
				call   : instructions.events[index].call
			});
		}

		if ( instructions.events.constructor === Object ) {

			events = ( instructions.events.event.constructor === String ? instructions.events.event.replace(/[\s]+/g, "").split(",") : instructions.events.event );

			for (; index < events.length; index++ ) this.add_an_event_listener_to_an_option_part({
				index : instructions.option_index,
				node  : instructions.node,
				event : events[index],
				call  : instructions.events.call
			});
		}
	},

	add_an_event_listener_to_an_option_part : function (instructions) {

		var self = this;

		instructions.node.addEventListener(instructions.event, function (event) {
			
			instructions.call.call(self, {
				box            : document.getElementById(self.self.table.wake.table_name +'_option_'+ instructions.index),
				element        : instructions.node,
				box_data       : self.self.table.options.data[instructions.index],
				original_event : event
			});
		});
	},

	option_box_parts : {

		text : function (instructions) {

			return this.make_node({ 
				type : "div",
				with : {
					className   : this.self.table.wake.class_names.option.description,
					placeholder : instructions.placeholder,
					textContent : instructions.content
				}
			});
		},

		input : function (instructions) {

			var input = this.make_node({ 
				type : "input",
				with : {
					className   : this.self.table.wake.class_names.option.input,
					placeholder : instructions.placeholder
				}
			});

			if ( instructions.on ) this.add_events_to_node({
				option_index : instructions.index,
				node         : input,
				events       : instructions.on
			});

			return input;
		},

		button : function (instructions) {

			var button = this.make_node({
				type : "div",
				with : {
					className   : this.self.table.wake.class_names.option.button,
					textContent : instructions.text
				}
			});

			if ( instructions.on ) this.add_events_to_node({
				option_index : instructions.index,
				node         : button, 
				events       : instructions.on
			});

			return button;
		},

		audio : function (instructions) {

			var audio = this.make_node({
				type : "audio",
				with : {
					src : instructions.source
				}
			});

			return audio;					
		}
	},

	options : {

		un_select : function () {

			var row_field_index, last_row_field, selected, field;
			
			row_field_index = this.calculate_the_order_number_of_the_first_field_in_the_currently_selected_row();
			last_row_field  = row_field_index+this.self.table.wake.column_number+1;
			selected        = this.add_or_remove_the_currently_selected_row_to_selected_rows();

			for (; row_field_index < last_row_field; row_field_index++ ) {
				field = this.self.table.component.box.children[row_field_index];
				field.className = ( selected ? this.self.table.wake.class_names.selected_field : this.self.table.wake.class_names.field );
			}
		},

		remove : function () {

			if ( !confirm("Really Remove the rows?") ) return;

			var row_properties;
			row_properties = this.get_selected_rows_property("id");
			this.remove_selected_rows();
		},

		un_select_all : function () {

			var selected, index, fields_that_exist, field;

			selected          = this.select_or_unselect_all_rows();
			index             = 0;
			fields_that_exist = this.self.table.rows.length * ( this.self.table.wake.column_number + 1 );

			for (; index < fields_that_exist; index++ ) {
				field           = this.self.table.component.box.children[index];
				field.className = ( selected ? this.self.table.wake.class_names.selected_field : this.self.table.wake.class_names.field );
			}
		},
	},
});