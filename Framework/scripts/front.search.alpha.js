var alpha = (function ( alpha, $ ) {

	alpha.front = alpha.front || function () {};

	alpha.front.prototype.search_bar = function () { 

		this.parts = this.parts || {};

		this.parts.search = {
			wrap : {
				self   : '<div class="input_for_bar"></div>',
				branch : {
					branch : {
						input : {
							self : '<div class="field_for_input"></div>',
							branch : {
								input_block : '<input type="text" class="input_block_for_search block_for_search" placeholder="isbn, book title, keyword, etc...">'
								}
							},
						button : {
							self : '<div class="button_for_input"></div>',
							branch : {
								icon : '<span data-function-instructions="{\'type\':\'bar\'}" data-function-to-call="front.prototype.search_though_amazon" class="with-icon-search"></div>'
								}}}
							}}};

		this.parts.search = alpha.manifest({
			what_to_manifest : this.parts.search,
			append_to_who : $('.bar') 
		});
	};

	return alpha;

})(alpha || {}, jQuery );