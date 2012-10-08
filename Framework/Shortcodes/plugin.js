( function () { 
	tinymce.create( 
		'tinymce.plugins.lfshortcodes', { 

		// Used to get the url of the plugin and store it in a variable( within this scope ) to be acessed by other functons
		// 
		// object ed The editor
		// string url The plugin file url 
		init : function( ed, url ) {

			l = url;

		},
		// Function used to add dropdown buttons with popup boxes to a button
		// 
		// object editor The dropdown button is added to this
		// string title The text of the button 
		// string name Passed as a global variable though the url, the name will determine which shortcode options will 
		//             be generated, as they are stored in an array. 
		Box : function ( editor, title,	name ) {

			editor.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.windowManager.open({
						file : l + '/Popups/manifest.php?popup=' + name,
						width : 700,
						height : 500,
						inline : 1,
						title : title,
						popup_css : false 
					});
				}
			})
		},	
		// Creates dropdown button for calling .Box() function which adds buttons in the dropdown
		// 
		// string c  [The]"Control", the name(id) of the button, can have as many buttons as wanted
		// object cm "Control Manager", factory used to create buttons and more ( eg : cm.createMenuButton(...) )
		createControl : function( c, cm ) {
		
			if ( c == 'lf_dropdown' ) {

					var t = this;

					// Create a split button through the "Control Manager"
					var c = cm.createSplitButton(
								'lf_dropdown', { 
								title : 'lf dropdown',
								image : l + "/Popups/css/menulogo.png",
								icons : false 
							});	


						// Adds dropdown buttons once the menu is rendered or ready
						// 
						// event onRenderMenu we add the dropdown buttons after the event
						// object c The "Control" object from createControl is passed into here
						// object editor The editor object
						c.onRenderMenu.add( function ( c, editor ) { 

								t.Box( editor, 'Alert', 'alert' );

								t.Box( editor, 'Buttons', 'buttons' );

								t.Box( editor, 'Columns', 'column' );

								t.Box( editor, 'Toggle', 'toggles' );

								t.Box( editor, 'Tabs', 'tabs' );

								t.Box( editor, 'Embed', 'embed' );
																		
							});
								
						return c;
					}	

				return null;		
			},	
		getInfo : function () { 
		
			return {
				longname : 'lf dropwdown',
				author : 'Cikica',
				authorurl : 'cikica.com',
				infourl : 'cikica.com',
				version : '1.0'
			};
		}			
	});
	
	tinymce.PluginManager.add('lf_dropdown', tinymce.plugins.lfshortcodes );

})();