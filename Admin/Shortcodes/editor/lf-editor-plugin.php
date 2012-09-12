<?php 

header("Content-Type:text/javascript");

$wp_path = explode( 'wp-content', __FILE__ );

$the_url = $wp_path[0];

require_once( $the_url.'/wp-load.php' );

?>
( function () { 
	tinymce.create( 
		'tinymce.plugins.lfinterface', {
		
		createControl : function( n, cm, url ) {
		
			switch ( n ) {
				case 'lf_dropdown' : 
					var c = cm.createMenuButton(
								'lf_dropdown', { 
								title : 'lf dropdown',
								image : '<?php echo get_template_directory_uri(). '/Admin/Shortcodes/editor/menulogo.png'; ?>',
								icons : false 
							});	
						c.onRenderMenu.add(
							function ( c, m ) { 
							var sub;
										
							m.add({
								title : "Open Generation Window",
								onclick : function () {
									tinyMCE.activeEditor.windowManager.open({
										file : '<?php echo get_template_directory_uri(). '/Admin/Shortcodes/editor/lf-editor-dialog.php'; ?>',
										width : 480,
										height : 520,
										inline : 1 
										});
									}
								});
							
							m.addSeparator();
								
							sub = m.addMenu({
								title : 'Text Elements'
								});
							
							subsub = sub.addMenu({
								title : 'Plain Underline'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline color=""]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Medium Underline'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_medium]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_medium color=""]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Tall Underline'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_tall]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_tall color=""]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Custom Thickness Underline'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_custom width=""]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_custom color="" width=""]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Underline With Note'
								});
									
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_text][/underline_text]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_text color=""][/underline_text]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Short Underline '
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_short]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[underline_short color=""]' );
									}
								});
								
							subsub = sub.addMenu({ 
								title : 'Highlight'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[highlight]' + tinyMCE.activeEditor.selection.getContent() + '[/highlight]' );
									}
								});
								
							subsub.add({
								title : "Custom Color",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[highlight color=""]' + tinyMCE.activeEditor.selection.getContent() + '[/highlight]' );
									}
								});
								
							sub.add({
								title : "Invisible Divider",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[divider]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Images'
								});
								
							subsub.add({
								title : "Align Image Left",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[img_align side="left"]' + tinyMCE.activeEditor.selection.getContent() + '[/img_align]' );
									}
								});
								
							subsub.add({
								title : "Align Image Right",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[img_align side="right"]' + tinyMCE.activeEditor.selection.getContent() + '[/img_align]' );
									}
								});
								
							subsub.add({
								title : "Make Image Fit Post Width",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[img_wrap"]' + tinyMCE.activeEditor.selection.getContent() + '[/img_wrap]' );
									}
								});
							
							m.addSeparator();
							
							sub = m.addMenu({
								title : 'Text Boxes'
								});
							
							subsub = sub.addMenu({
								title : 'Info Box'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[infobox]' + tinyMCE.activeEditor.selection.getContent() + '[/infobox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[infobox color="" textcolor=""]' + tinyMCE.activeEditor.selection.getContent() + '[/infobox]' );
									}
								});

							subsub.add({
								title : "Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[infobox style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/infobox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors & Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[infobox color="" textcolor="" style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/infobox]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Question Box'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[qbox]' + tinyMCE.activeEditor.selection.getContent() + '[/qbox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[qbox color="" textcolor=""]' + tinyMCE.activeEditor.selection.getContent() + '[/qbox]' );
									}
								});

							subsub.add({
								title : "Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[qbox style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/qbox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors & Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[qbox color="" textcolor="" style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/qbox]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Warning Box'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[warnbox]' + tinyMCE.activeEditor.selection.getContent() + '[/warnbox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[warnbox color="" textcolor=""]' + tinyMCE.activeEditor.selection.getContent() + '[/warnbox]' );
									}
								});

							subsub.add({
								title : "Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[warnbox style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/warnbox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors & Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[warnbox color="" textcolor="" style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/warnbox]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Quote Box'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[quotebox]' + tinyMCE.activeEditor.selection.getContent() + '[/quotebox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[quotebox color="" textcolor=""]' + tinyMCE.activeEditor.selection.getContent() + '[/quotebox]' );
									}
								});

							subsub.add({
								title : "Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[quotebox style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/quotebox]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors & Italic Text",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[quotebox color="" textcolor="" style="italic"]' + tinyMCE.activeEditor.selection.getContent() + '[/quotebox]' );
									}
								});
								
							m.addSeparator();
							
							sub = m.addMenu({
								title : 'Buttons'
								});
								
							subsub = sub.addMenu({
								title : 'Fixed Width Button'
								});
								
							subsub.add({
								title : "Default",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button name="" link=""]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button name="" link="" color="" background=""]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Chosen Width Button'
								});
									
							subsub.add({
								title : "Full Width",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button_wide name="" link="" width="full"]' );
									}
								});
								
							subsub.add({
								title : "Half Width",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button name="" link="" width="half"]' );
									}
								});
								
							subsub.add({
								title : "One Third",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button name="" link="" width="third"]' );
									}
								});
								
							subsub.add({
								title : "One Quarter",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[button name="" link="" width="quarter"]' );
									}
								});
							
							m.addSeparator();
								
							sub = m.addMenu({
								title : 'Boxes'
								});
								
							subsub = sub.addMenu({
								title : 'Message Box'
								});
							
							subsub.add({
								title : "Plain",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[display_box head_name=""]' + tinyMCE.activeEditor.selection.getContent() + '[/display_box]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[display_box head_name="" header="" contentcol="" htext="" ctext=""]' + tinyMCE.activeEditor.selection.getContent() + '[/display_box]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Single Toggle Box'
							});
							
							subsub.add({
								title : "Plain Open",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_box id="" head_name=""]' + tinyMCE.activeEditor.selection.getContent() + '[/toggle_box]' );
									}
								});
								
							subsub.add({
								title : "Plain Closed",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_box id="" head_name="" state="close"]' + tinyMCE.activeEditor.selection.getContent() + '[/toggle_box]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors Open",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_box id="" head_name="" header="" contentcol="" htext="" ctext=""]' + tinyMCE.activeEditor.selection.getContent() + '[/toggle_box]' );
									}
								});
								
							subsub.add({
								title : "Custom Colors Closed",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_box id="" head_name="" state="close" header="" contentcol="" htext="" ctext=""]' + tinyMCE.activeEditor.selection.getContent() + '[/toggle_box]' );
									}
								});
								
							subsub = sub.addMenu({
								title : 'Multi Toggle Box'
							});
							
							subsubsub = subsub.addMenu({
								title : 'Default Open'
							});
							
							subsubsub.add({
								title : "Two Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Three Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Four Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Five Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Seven Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Eight Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Nine Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Ten Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub = subsub.addMenu({
								title : 'Default Closed'
								});
							
							subsubsub.add({
								title : "Two Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Three Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Four Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Five Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Seven Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Eight Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Nine Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Ten Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][toggle head_name=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub = subsub.addMenu({
								title : 'Custom Color Open'
								});
							
							subsubsub.add({
								title : "Two Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Three Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Four Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Five Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Seven Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Eight Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Nine Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Ten Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id=""][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub = subsub.addMenu({
								title : 'Custom Color Closed'
								});
							
							subsubsub.add({
								title : "Two Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Three Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Four Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Five Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Six Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Seven Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Eight Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Nine Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							subsubsub.add({
								title : "Ten Toggle Fields",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[toggle_many id="" state="close"][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][toggle head_name="" header="" contentcol="" htext="" ctext=""][/toggle][/toggle_many]' );
									}
								});
								
							m.addSeparator();
								
							sub = m.addMenu({
								title : "Width Columns"
								});
								
							sub.add({
								title : "Column Wrapper",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap]' + tinyMCE.activeEditor.selection.getContent() + '[/col_wrap]' );
									}
								});	
								
							subsub = sub.addMenu({
								title : "One Column"
							});
								
							subsub.add({
								title : "1/2 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[half_col]' + tinyMCE.activeEditor.selection.getContent() + '[/half_col]' );
									}
								});	
								
							subsub.add({
								title : "1/3 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[one_third_col]' + tinyMCE.activeEditor.selection.getContent() + '[/one_third_col]' );
									}
								});	
								
							subsub.add({
								title : "1/4 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[quarter_col]' + tinyMCE.activeEditor.selection.getContent() + '[/quarter_col]' );
									}
								});	
								
							subsub.add({
								title : "2/3 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[two_third_col]' + tinyMCE.activeEditor.selection.getContent() + '[/two_third_col]' );
									}
								});	
								
							subsub.add({
								title : "1/6 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[six_col]' + tinyMCE.activeEditor.selection.getContent() + '[/six_col]' );
									}
								});	
								
							subsub.add({
								title : "1/8 Column",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[eight_col]' + tinyMCE.activeEditor.selection.getContent() + '[/eight_col]' );
									}
								});	
								
							subsub = sub.addMenu({
								title : 'Column Combinations'
							});
							
							subsub.add({
								title : "1/2 | 1/2 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][half_col][/half_col][half_col][/half_col][/col_wrap]' );
									}
								});	
								
							subsub.add({
								title : "1/4 | 1/4 | 1/4 | 1/4 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][quarter_col][/quarter_col][quarter_col][/quarter_col][quarter_col][/quarter_col][quarter_col][/quarter_col][/col_wrap]' );
									}
								});	
								
							subsub.add({
								title : "1/4 | 1/4 | 1/2 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][quarter_col][/quarter_col][quarter_col][/quarter_col][half_col][/half_col][/col_wrap]' );
									}
								});	
								
							subsub.add({
								title : "1/2 | 1/4| 1/4 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][half_col][/half_col][quarter_col][/quarter_col][quarter_col][/quarter_col][/col_wrap]' );
									}
								});	
								
							subsub.add({
								title : "2/3 | 1/3 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][two_third_col][/two_third_col][one_third_col][/one_third_col][/col_wrap]' );
									}
								});	
								
							subsub.add({
								title : "1/6 | 1/6 | 1/6 | 1/6 | 1/6 | 1/6 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][six_col][/six_col][six_col][/six_col][six_col][/six_col][six_col][/six_col][six_col][/six_col][six_col][/six_col][/colr_wrap]' );
									}
								});
								
							subsub.add({
								title : "1/8 | 1/8 | 1/8 | 1/8 | 1/8 | 1/8 ",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[col_wrap][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][eight_col][/eight_col][/col_wrap]' );
									}
								});	
								
							m.addSeparator();
								
							sub = m.addMenu({
								title : 'Video'
							});
							
							sub.add({
								title : "You Tube",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[video type="youtube" link=""]' );
									}
								});	
								
							sub.add({
								title : "Vimeo",
								onclick : function () {
									tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[video type="vimeo" link=""]' );
									}
								});	
							
							
							
							});
								
						return c;
					}				
				return null;		
			},
				
		getInfo : function () { 
		
			return {
				longname : 'lf dropwdown',
				author : 'cikica',
				authorurl : 'cikica.com',
				infourl : 'cikica.com',
				version : '1.0'
			};
		
		}			
	});
	
	tinymce.PluginManager.add('lf_dropdown', tinymce.plugins.lfinterface );

})();