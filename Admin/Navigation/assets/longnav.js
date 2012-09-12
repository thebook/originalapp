

( function ($) {

	lf_nav = { 

	longnav : function () {	
	
		if ( $(window).width() <= '600' )  { 							
			if ( $('.longnavhook select')
					.hasClass('longnav-dropdown') ) { 
						return; }
			else { $('.longnavhook').removeClass(
						'longnavhookmedium');
						
					$('.longnavshow')
						.empty()
						.remove();
					
					$('<select />')
						.appendTo(
							'.longnavhook');
											
					$('.longnavhook select')
						.addClass(
							'longnav-dropdown');
											
					$("<option />", {
						"selected": "selected",
						"value"   : "",
						"text"    : "Go to..." }).appendTo('.longnavhook select');
															
					$(".longnavhook a").each(
						function() {
							var lnthis = $(this);
							$("<option />", {
								"value"   : lnthis.attr("href"),
								"text"    : lnthis.text() }
								).appendTo('.longnavhook select'); });	
																	
					$(".longnavhook select").change(
						function() {
							window.location = $(this)
								.find(
								"option:selected"
								).val(); 
							});
							
					$('.longnavhook div')
						.css(
						'display', 'none'
						);							
					}
				}
				
	if ( $(window).width() > '600' 
		&& $('.longnavhook select').hasClass(
		'longnav-dropdown') ) { 
			$('.longnav-dropdown')
				.empty()
				.remove();
				
			$('.longnavhook div').css(
				'display', 'block'
				);
			}
		 	
	},

	dropdown : function () { 
		
		if ( $('.lf-main-navigation-style').hasClass('lf-drop-down-hook') ) { 
		
			$('.lf-drop-down-hook ul.sub-menu')
				.parent()
				.hover(
				function () { 
					$(this).children('.sub-menu').css({
						'display' : 'block' });
					},
				function () {
					$(this).children('.sub-menu').css({
						'display' : 'none' });
				});
				
			$('.lf-drop-down-hook ul.sub-menu ul.sub-menu')
				.parent()
				.hover(
				function () { 
					$(this).children('.sub-menu').css({ 
						'display' : 'inline' });
					},
				function () {
					$(this).children('.sub-menu').css({
						'display' : 'none' });
				});
				
			$('.lf-drop-down-hook ul.children')
				.parent()
				.hover(
				function () { 
					$(this).children('.children').css({
						'display' : 'block' });
					},
				function () {
					$(this).children('.children').css({
						'display' : 'none' });
				});
				
			$('.lf-drop-down-hook ul.children ul.children')
				.parent()
				.hover(
				function () { 
					$(this).children('.children').css({ 
						'display' : 'inline' });
					},
				function () {
					$(this).children('.children').css({
						'display' : 'none' });
				});
		}
	}
}

})(jQuery);

$(document).ready(
	function(){
		lf_nav.dropdown();
		lf_nav.longnav();
});

$(window).resize( 
	function() {  
		lf_nav.longnav();
	});