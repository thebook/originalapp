var alpha = (function ( alpha, $ ) {

	alpha.table = function (wake) {

		if ( wake.self.table ) return;

		var prototype;

		prototype = this;
		this.self = wake.self;
		wake.self.table = {};
		wake.self.table.wake = {
			width        : wake.columns.length * wake.column_width,
			submit_field_callback : wake.submit_field_callback,
			columns      : wake.columns,
			column_width : wake.column_width,
			column_number: wake.column_number-1,
			row_height   : wake.row_height,
			class_names  : wake.class_names,
			length       : wake.column_number * wake.column_width,
			number_of_columns_that_can_show : Math.floor(wake.self.clientWidth/wake.column_width)-1,
			number_of_rows_that_can_show    : Math.floor(wake.table_height/wake.row_height)-1
		};
		wake.self.table.component = {
			box    : "",
			titles : ""
		};
		wake.self.table.visible = {
			column : {
				left  : 0,
				right : wake.self.table.wake.number_of_columns_that_can_show
			},
			row : {
				top    : 0,
				bottom : wake.self.table.wake.number_of_rows_that_can_show
			}
		};
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
		};
		wake.self.table.selected = {
			history: [],
			current: {
				column : 0,
				row    : 0
			}
		};
		wake.self.table.selected_rows = [];
		wake.self.table.set_rows      = function (rows) {
			prototype.set_rows.call(prototype, rows);
		};
		wake.self.table.remove_rows   = function (rows) {
			prototype.remove_rows.call(prototype, rows);
		};

		wake.self.table.get_selected_rows   = function (rows) {
			return prototype.get_selected_rows.call(prototype);
		};
		wake.self.table.submision_column_names = wake.submision_column_names,
		wake.self.table.rows = [];

		// wake.self.table.rows = [
		// 		{
		// 			id    : 1,
		// 			email   : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// 		{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// 		{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// 		{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// 		{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// 		{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},	{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},	{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},	{
		// 			id : 1,
		// 			email : "some@email",
		// 			address : "30 THe Grange",
		// 			town    : "Cardiff",
		// 			place   : "THe place",
		// 			stuff   : "stuff"
		// 		},
		// ];

		// this.self.style.height = ( this.self.table.wake.number_of_rows_that_can_show * this.self.table.wake.row_height ) +"px";

		this.self.insertAdjacentHTML("afterbegin", 
			'<div style="width:'+ this.self.table.wake.width                   +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_titles +'"></div>'+
			'<div '+
			'class="'+            this.self.table.wake.class_names.row_options +'">'+
			'</div>'+
			'<div style="width:'+ this.self.table.wake.width                 +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_wrap +'"></div>');

		this.self.table.component.titles      = this.self.children[0];
		this.self.table.component.row_options = this.self.children[1];
		this.self.table.component.box         = this.self.children[2];

		this.self.addEventListener("keydown", function (event) {
			prototype.keypress_handler(event);
		});

		this.self.addEventListener("click", function (event) {

			if ( event.target.tagName === "TEXTAREA" )           prototype.field_selection_value_changer(event);
			if ( event.target.getAttribute("data-type-option") ) prototype.option_interaction(event);
			if ( event.target !== prototype.self.table.change.value.selected ) prototype.come_out_of_field_editing();
		});

		this.self.addEventListener("dblclick", function (event) {
			console.log("doubleclick");
			console.log(event.target);
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

		this.popuplate_table_rows();
		this.popuplate_table_titles();

	};

	alpha.table.prototype.set_rows    = function (rows) {
		this.self.table.rows = rows;
		this.popuplate_table_rows();
	};

	alpha.table.prototype.remove_rows = function (rows_to_be_removed) {

		var rows, index, row;

		rows  = [];
		index = 0;

		for (; index < this.self.table.rows.length; index++) {
			if ( rows_to_be_removed.indexOf(index) < 0 ) {
				row = this.self.table.rows.slice(index, index+1);
				rows.push(row[0]);
			}
		};
		
		this.self.table.rows = rows;
		this.popuplate_table_rows();
	};

	alpha.table.prototype.get_selected_rows  = function () {
		
		var index, rows, row_number, row;

		index = 0;
		rows  = [];
		for (; index < this.self.table.selected_rows.length; index++) {
			row_number = this.self.table.selected_rows[index];
			row        = this.self.table.rows[row_number];
			rows.push(row);
		}

		return rows;
	};

	alpha.table.prototype.option_interaction = function (change) {

		var row_number, index_of_row;

		row_number = parseInt(change.target.getAttribute("data-type-row"));

		if ( change.target.className === this.self.table.wake.class_names.selected_row ) {

			change.target.className = this.self.table.wake.class_names.row_option;
			change.target.setAttribute("title", "unselect row");
			index_of_row = this.self.table.selected_rows.indexOf(row_number);
			this.self.table.selected_rows.splice(index_of_row, 1);
		} else { 

			change.target.className = this.self.table.wake.class_names.selected_row;
			change.target.setAttribute("title", "select row");
			this.self.table.selected_rows.push(row_number);
		}
	};

	alpha.table.prototype.move_visisble_area_by_y_axis = function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.self.table.wake.row_height * change.new.top );
		this.self.table.component.box.style.top = shift_by_this_much +"px";
		this.self.table.component.row_options.style.marginTop = shift_by_this_much +"px";
	};

	alpha.table.prototype.move_visisble_area_by_x_axis = function (change) {

		var shift_by_this_much;

		shift_by_this_much = 0 - ( this.get_width_of_the_hidden_column() * change.new.left );
		this.self.table.component.box.style.left = shift_by_this_much +"px";
		this.self.table.component.titles.style.marginLeft = shift_by_this_much +"px";
	};

	alpha.table.prototype.get_width_of_the_hidden_column = function () { 

		var column_number = this.self.table.visible.column.right + this.self.table.visible.column.left - 1;
		return this.self.table.component.box.children[column_number].clientWidth;
	};

	alpha.table.prototype.visible_area_calculator = function (change) {

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
	};

	alpha.table.prototype.field_selection_value_changer = function (event) {

		this.self.table.selected.current = {
			column : parseInt( event.target.getAttribute("data-type-column-number") ),
			row    : parseInt( event.target.getAttribute("data-type-row") )
		}
	};

	alpha.table.prototype.field_selection_mover = function (change) {

		this.self.table.selected.history.unshift({
			row    : change.old.row,
			column : change.old.column
		});
		document.getElementById("column_"+ change.new.column +"_row_"+ change.new.row ).focus();
	};

	alpha.table.prototype.keypress_handler = function (event) {

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
	};

	alpha.table.prototype.change_selected_field_based_on_current_position = function (direction) {

		var current = this.self.table.selected.current;

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
	};


	alpha.table.prototype.come_into_field_editing = function (target) { 

		if ( this.self.table.change.value.changeing ) return;

		target.removeAttribute("readonly");
		this.self.table.change.value.selected  = target;
		this.self.table.change.value.column    = target.getAttribute("data-type-column");
		this.self.table.change.value.row       = target.getAttribute("data-type-row");
		this.self.table.change.value.changeing = true;
	};

	alpha.table.prototype.come_out_of_field_editing = function () { 

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
	};

	alpha.table.prototype.submit_changed_value = function (change) { 

		// should be some method here to check if it has changed at all

		this.self.table.wake.submit_field_callback({
			value       : change.new,
			row         : this.self.table.rows[this.self.table.selected.current.row],
			column_name : this.self.table.submision_column_names[this.self.table.selected.current.column],
		});
	};

	alpha.table.prototype.table_field_factory = function (wake) { 

		return '<textarea '+ 
			'placeholder="empty"'+
			'id="column_'+        wake.column_number +'_row_'+ wake.row +'" '+ 
			'data-type-row="'+    wake.row +'" '+ 
			'data-type-column="'+ wake.column_name +'" '+ 
			'data-type-column-number="'+ wake.column_number +'" '+ 
			'class="'+ this.self.table.wake.class_names.field +'" readonly="true">'+
			wake.value +
		'</textarea>';
	};

	alpha.table.prototype.popuplate_table_row_options = function () { 

		var options, index;

		index   = 0;
		options = "";

		this.empty(this.self.table.component.row_options);
		this.self.table.component.row_options.style.height = ( this.self.table.rows.length * this.self.table.wake.row_height ) +"px";

		for (; index < this.self.table.rows.length; index++) {			
			options += '<div data-type-row="'+ index +'" data-type-option="true" '+
					   'title="select row" class="'+ this.self.table.wake.class_names.row_option +'"></div>';
		};

		this.self.table.component.row_options.insertAdjacentHTML("afterbegin", options );
	};

	alpha.table.prototype.popuplate_table_titles = function () { 

		var index, titles;

		index  = 0;
		titles = "";

		for (; index < this.self.table.wake.columns.length; index++) {
			titles += '<div class="'+ this.self.table.wake.class_names.title +'">'+ 
				this.self.table.wake.columns[index] +
			'</div>';
		};

		this.self.table.component.titles.insertAdjacentHTML("afterbegin", titles );
	};

	alpha.table.prototype.popuplate_table_rows = function () { 

		var column_number, rows, column_name;
		
		rows = "";

		this.empty(this.self.table.component.box);
		this.self.table.selected_rows = [];
		// while ( this.self.firstChild.firstChild ) this.self.removeChild(this.self.firstChild.firstChild);

		for (var index = 0; index < this.self.table.rows.length; index++) {

			column_number = -1;

			for (column_name in this.self.table.rows[index] ) {
				column_number++;
				rows += this.table_field_factory({
					column_number : column_number,
					column_name   : column_name,
					row           : index,
					value         : this.self.table.rows[index][column_name]
				});
			}
		};

		this.self.table.component.box.insertAdjacentHTML("afterbegin", rows );
		this.popuplate_table_row_options();
	};

	alpha.table.prototype.empty = function (what) {
		while ( what.firstChild ) what.removeChild(what.firstChild);
	};

	return alpha;

})(alpha || {}, jQuery );