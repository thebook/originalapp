var alpha = (function ( alpha, $ ) {

	alpha.table = function (wake) {

		var prototype;

		prototype = this;
		this.self = wake.self;
		wake.self.table = {};
		wake.self.table.wake = {
			column_width : wake.column_width,
			column_number: wake.column_number-1,
			class_names  : wake.class_names,
			length       : wake.column_number * wake.column_width,
			number_of_columns_that_can_show : Math.floor(wake.self.clientWidth/wake.column_width)-1
		};
		wake.self.table.visible = {
			column : {
				left  : 0,
				right : wake.self.table.wake.number_of_columns_that_can_show
			},
			row : {
				top    : 0,
				bottom : 0
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
		wake.self.table.rows = [
				{
					id    : 1,
					email   : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place",
					stuff   : "stuff"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place",
					stuff   : "stuff"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place",
					stuff   : "stuff"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place",
					stuff   : "stuff"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place",
					stuff   : "stuff"
				},
		];
		console.log(this.self.table);

		this.self.insertAdjacentHTML("afterbegin", 
			'<div style="width:'+ this.self.table.wake.length                 +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_wrap +'">');

		this.self.addEventListener("keydown", function (event) {
			prototype.keypress_handler(event);
		});

		this.self.addEventListener("click", function (event) {

			prototype.field_selection_value_changer(event);
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
				prototype.visible_area_mover(change);
			}
		});

		new alpha.observe({
			object   : this.self.table.change.value,
			property : "value",
			observer : function (change) {
				prototype.submit_changed_value();
			}
		});

		this.popuplate_table_rows();
	};

	alpha.table.prototype.visible_area_mover = function (change) {
		this
		console.log(this.self.firstChild);
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

		console.log(this.self.table.visible.column);
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

		console.log(this.self.table.selected.current);
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

	alpha.table.prototype.submit_changed_value = function () { 
		console.log("change");
		console.log(this.self.table.change.value.value);
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

	alpha.table.prototype.popuplate_table_rows = function () { 

		var column_number, rows, column_name;
		
		rows = "";

		while ( this.self.firstChild.firstChild ) this.self.removeChild(this.self.firstChild.firstChild);

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

		this.self.firstChild.insertAdjacentHTML("afterbegin", rows );

	};

	return alpha;

})(alpha || {}, jQuery );