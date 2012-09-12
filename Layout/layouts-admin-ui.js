(function ($) { 

layoutSort = {
	
	multiControlCheck : function ( boxid, selectget, boxheight, position, state, controler, desctext, elementdesc ) { 
	
		var opts	 = $( boxid + ' .sort-multilev-part').length;
			control_height = $( boxheight ).get( position );
			multitext = $( desctext ).get( position );
			
			if ( controler == "left" ) { 
				if ( $( boxid + ' .sort-multilev-control-right').css(
				'visibility') == 'hidden' ) { 
					$( boxid + ' .sort-multilev-control-right').css(
						'visibility', 'visible'
						); 	
					} 
					
				if ( position === 0 ) { 
					$( boxid + ' .sort-multilev-control-left').css('visibility', 'hidden'); 
					} 
			}
			
			else if ( controler == "both" ) { 	
				if ( position == opts -1 ) { 
					$(  boxid + ' .sort-multilev-control-right').css('visibility', 'hidden'); 
					} 

				if ( position === 0 ) { 
					$( boxid + ' .sort-multilev-control-left').css('visibility', 'hidden'); 
					}
			}
			
			else if ( controler == "right" ) { 
				if ( position == opts -1 ) { 
					$(  boxid + ' .sort-multilev-control-right').css('visibility', 'hidden'); 
					}
					
				if ( $( boxid + ' .sort-multilev-control-left').css(
				'visibility') == 'hidden' ) { 
					$( boxid + ' .sort-multilev-control-left').css(
						'visibility', 'visible'
						); 	
					} 
			}

			$( boxid + ' .sort-multilev-box').animate( { 
				'marginLeft' : position * -180, 
				'height' : control_height 
				},
				800 );
				
			if ( state == "bind" ) {
				$( boxid ).animate( { 
					'height' : control_height 
					},
					800 ).find( 
					'.sort-multilev-box' 
					).animate( { 
					'height' : control_height,
					'marginLeft' : position * -180
					},
					800);
				$( boxid + ' .sort-multilev-desc-part' ).fadeOut('slow',
					function () { 
						$(this).text( multitext );
						}).fadeIn('slow');
				$( selectget + ' option').eq(position).attr( 'selected', 'selected' );
				}
				
			if ( state == "init" ) {
				$( boxid ).css({ 
					'height' : control_height 
					}).find( 
					'.sort-multilev-box' 
					).css( { 
					'width' : opts * 180, 
					'height' : control_height 
					}); 
				$( boxid + ' .sort-multilev-desc-part' ).fadeOut('slow',
					function () { 
						$(this).text( elementdesc );
						}).fadeIn('slow');
				}

			$( boxid + ' .sort-multilev-desc' ).animate({ 
				'marginTop' : (control_height - 28) / 2 
				}, 
				400 );
		
			$( boxid + ' .multilev-control' ).animate({ 
				'marginTop' : (control_height - 50) / 2 
				}, 
				400 );
	},	
	multiSort: function ( boxid, selectget, boxheight, desctext, elementdesc ) { 
		
		var position = $('' + selectget + ' option:selected').index();
		//	Init			
		layoutSort.multiControlCheck( 
			boxid, 
			selectget, 
			boxheight, 
			position, 
			"init", 
			"both",
			desctext,
			elementdesc );	
		// 	Right		
		$( boxid + ' .sort-multilev-control-right').bind( 
			'click', 
			function () { 
								
				position = position + 1;									
						
				layoutSort.multiControlCheck( 
					boxid, 
					selectget, 
					boxheight, 
					position, 
					"bind", 
					"right",
					desctext );										
		});
		//	Left																	
		$('' + boxid + ' .sort-multilev-control-left').bind( 
			'click', 
			function () {
														
				position = position -1; 
								
				layoutSort.multiControlCheck( 
					boxid, 
					selectget, 
					boxheight, 
					position, 
					"bind", 
					"left",
					desctext );								
		});			
	} 
}; 
})(jQuery);

jQuery(document).ready(function($){ 

$('.layout-sortable').sortable();

$('.layout-sortable').bind( 
	'sortupdate', 
		function (event, ui ) {
			$('.inputs').each( function (index) { 
					var text = $('.sortable').map( 
						function () { 
							return $(this).text(); 
							}).get(index);
						text = text.replace( /\s/g, '' );
					$(this).val(text);
				});		
			});
				
$('.layout-sortable').trigger('sortupdate');
		
	layoutSort.multiSort( 
		"#header-multisort", 
		"#header-state-multisort", 
		[ "59", "59", "59", "74", "74", "74" ], 
		["Just Header", "Header & Right Advert", "Header & Left Advert", "Header & Top Advert", "Header & Bottom Advert", "No Header"],
		"Header" );
		
	layoutSort.multiSort( 
		"#content-multisort", 
		"#content-state-multisort", 
		[ "136", "136", "136", "136", "136", "136", "136", "136" ], 
		["No Sidebar", "One Sidebar", "Two Sidebars", "Three Sidebars", "One Sidebar", "Two Sidebars", "Three Sidebars", "No Content" ], 
		"Content" );
		
	layoutSort.multiSort( 
		"#footer-multisort", 
		"#footer-state-multisort", 
		[ "68", "68", "68", "68", "68" ], 
		[ "One Widget Column", "Two Widget Columns", "Three Widget Columns", "Four Widget Columns", "No Footer" ], 
		"Footer" );
		
	layoutSort.multiSort( 
		"#slider-multisort", 
		"#slider-state-multisort", 
		[ "117", "78", "52", "52" ], 
		[ "Slider & Description", "Only Slider", "Only Description", "No Slider & Description" ], 
		"Slider" );
		
});	