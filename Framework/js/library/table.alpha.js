var alpha = (function ( alpha, $ ) {

	alpha.table = function (wake) {

		var prototype;

		prototype = this;
		this.self = wake.self;
		wake.self.table = {
			wake    : {
				column_width : wake.column_width,
				column_number: wake.column_number-1,
				class_names  : wake.class_names,
				length       : wake.column_number * wake.column_width
			},
			change   : {
				history : [],
				value   : {
					column : 0,
					row    : 0,
					value  : ""
				}
			},
			selected : {
				history: [],
				current: {
					column : 0,
					row    : 0
				}
			},
			rows : [
				{
					id    : 1,
					email   : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place"
				},
				{
					id : 1,
					email : "some@email",
					address : "30 THe Grange",
					town    : "Cardiff",
					place   : "THe place"
				},
			],
		};

		this.self.insertAdjacentHTML("afterbegin", 
			'<div style="width:'+ this.self.table.wake.length                 +'px;"'+
			'class="'+            this.self.table.wake.class_names.table_wrap +'">');

		this.self.addEventListener("keydown", function (event) {
			prototype.keypress_handler(event);
		});

		this.self.addEventListener("click", function (event) {
			prototype.field_selection_value_changer(event);
		});

		this.self.addEventListener("dblclick", function (event) {
			console.log("doubleclick");
			console.log(event.target);
		});

		new alpha.observe({
			object   : this.self.table.selected,
			property : "current",
			observer : function (change) {
				prototype.field_selection_mover(change);				
			}
		});

		this.popuplate_table_rows();


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
		// left 37, up 38, right 39, down 40, ctr 17, z 90, x 88, enter 13 
		
		if ( event.keyCode === 37 ) this.change_selected_field_based_on_current_position("left");

		if ( event.keyCode === 38 ) this.change_selected_field_based_on_current_position("up");

		if ( event.keyCode === 39 ) this.change_selected_field_based_on_current_position("right");

		if ( event.keyCode === 40 ) this.change_selected_field_based_on_current_position("down");

		if ( event.keyCode === 13 ) {
			if ( event.target.tagName !== "TEXTAREA" ) return;
			console.log(event.target);
			event.target.removeAttribute("readonly");
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

	alpha.table.prototype.table_field_factory = function (wake) { 

		return '<textarea '+ 
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