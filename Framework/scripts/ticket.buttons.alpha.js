var alpha = (function ( alpha, $ ) {

	alpha.change_ticket = function (wake) { 
		
		if (confirm("Are you sure you want to do this? Consiquences could be dire you know?")) {
			
			$.ajax({
				type : 'POST',
				url  : ajaxurl,
				data : { action : 'change_ticket', information : wake.instructions.ticket },
				complete : function (message) { 					
					$.jGrowl( wake.instructions.message.message, { header : wake.instructions.message.header, sticky : true });
					wake.element.closest('.ticket_window').children('.reload_ticket').trigger('click');
				},
				dataType : 'json'
			});
		}
	};

	alpha.extend_ticket_expirey = function (wake) { 

		var thoughts_of_what_to_manifest = {
			wrap : {
				self   : '<div class="ticket_box"></div>',
				branch : {
					branch : {
						row : {
							self   : '<div class="ticket_information_row"></div>',
							branch : {
								label    : '<div class="ticket_information_type">Extend Expiery</div>',
								expiery_input : '<input class="ticket_input" type="text" value="1">',
								plus  : '<div data-function-to-call="extend_ticket_expirey.prototype.plus"  class="button"> + </div>',
								minus : '<div data-function-to-call="extend_ticket_expirey.prototype.minus" class="button"> - </div>'
							}},
						button_row : {
							self   : '<div class="ticket_information_row"></div>',
							branch : {
								label : '<div class="ticket_information_type">Options</div>',
								cancel : '<div data-function-to-call="extend_ticket_expirey.prototype.cancel" class="button">Cancel</div>',
								finish : '<div data-function-to-call="extend_ticket_expirey.prototype.finish" class="button">Finish</div>',
							}
						}
					}					
				}}};

		this.prototype.being = {};
		this.prototype.parts = {};
		this.prototype.being.ticket_id = wake.instructions.ticket;
		this.prototype.parts.current_ticket_box = wake.element.closest('.ticket_box_wrap');		
		this.prototype.parts.box = alpha.manifest({
			what_to_manifest : thoughts_of_what_to_manifest,
			append_to_who    : this.prototype.parts.current_ticket_box
		});

	};

	alpha.extend_ticket_expirey.prototype.finish = function () { 

		$.ajax({
			type : 'POST',
			url  : ajaxurl,
			data : { action : 'change_ticket', information : wake.instructions.ticket },
			complete : function (message) { 					
				$.jGrowl( wake.instructions.message.message, { header : wake.instructions.message.header, sticky : true });
				wake.element.closest('.ticket_window').children('.reload_ticket').trigger('click');
			},
			dataType : 'json'
		});
	};

	alpha.extend_ticket_expirey.prototype.cancel = function () { 

		var prototype = alpha.extend_ticket_expirey.prototype;

			prototype.parts.box.wrap.self.remove();
			prototype.parts = {};
	};

	alpha.extend_ticket_expirey.prototype.plus = function () { 

		var prototype = alpha.extend_ticket_expirey.prototype,
			input = prototype.parts.box.wrap.branch.branch.row.branch.expiery_input;
			
			input.val(( parseInt(input.val()) + 1 ));
	};

	alpha.extend_ticket_expirey.prototype.minus = function () { 

		var prototype = alpha.extend_ticket_expirey.prototype,
			input = prototype.parts.box.wrap.branch.branch.row.branch.expiery_input;
			number_of_days_to_add = parseInt( input.val() );

			if ( number_of_days_to_add > 0 ) input.val(( number_of_days_to_add - 1 ));
	};

	return alpha;

})(alpha || {}, jQuery );