<?php 

function lf_create_header_ad() {

	$main_opts = get_option('main_options');

	echo '<div class="lf-header-ad-wrap">';
					
		if ( $main_opts['header_advert_type'] == 'leaderboard' ) {

			echo '<div class="lf-header-leaderboard-ad">';
				
			echo $main_opts['header_leaderboard_ad_code'];

			echo '</div>';
			
		}
			
		if ( $main_opts['header_advert_type'] == 'banner' ) {
			
			echo '<div class="lf-header-banner-ad">';
				
			echo $main_opts['header_banner_ad_code'];
				
			echo '</div>';
			
		}
			
	echo '</div>';

} 

function lf_header_section_callback() {
										
	echo '<div class="form-table">';
	
	lf_create_option( 
			'divider', 
			'Header Ads',
			'<p>Chose what dimension you would like your header ads to be, and enter their ad code; the ads can be set to be displayed for tablets, as well.</p>
			<p>Note : Header adverts will only be displayed if you have set them to be shown.</p>',
			'0px' ); 
	
	lf_create_option( "select", 
					  "main_options[header_advert_type]", 
					  "header_advert_type_opt", 
					  "main_options", 
					  "header_advert_type", 
					  "", 
					  "Set Header Advert Type", 
					  array( 'leaderboard', 'banner' ),
					  array( 'Leaderboard (728x90)', 'Banner (468x60)' ) );
					 				  
	lf_create_option( "text-box", 
					  "main_options[header_leaderboard_ad_code]", 
					  "header_leaderboard_ad_code_opt", 
					  "main_options", 
					  "header_leaderboard_ad_code", 
					  "<p>Paste in here the code for your leaderboard advert, this advert will only display, if you have set the <b>'Header Advert Type'</b> to <b>'Leaderboard'</b>.</p>", 
					  "Leaderboard Ad Code" );
					  
	lf_create_option( "text-box", 
					  "main_options[header_banner_ad_code]", 
					  "header_banner_ad_code_opt", 
					  "main_options", 
					  "header_banner_ad_code", 
					  "<p>Paste in here the code for your banner advert, this advert will only display, if you have set the <b>'Header Advert Type'</b> to <b>'Banner'</b>.</p>", 
					  "Banner Ad Code" );
					  
	lf_create_option( 
			'divider', 
			'Header Title&Background',
			'<p>Set the position of your header title and/or logo, style them in various number of ways; </p>
			<p>and chose the background of your header, amongst many other options.</p>',
			'24px' ); 
	
	// lf_create_option( "select", 
	// 				  "main_options[header_title_state]", 
	// 				  "header_title_state_opt", 
	// 				  "main_options", 
	// 				  "header_title_state", 
	// 				  "<p>Your title state sets what type of title look is shown in your header.</p><ul>
	// 				  <li><b>Title Text & Logo</b> : Show your website name and the logo you have uploaded.</li>
	// 				  <li><b>Logo Only</b> : Only your logo is visible</li>
	// 				  <li><b>Title Only</b> : Shows only your site title, regardless of weather you have uploaded a logo image</li>
	// 				  <li><b>None</b> : Hides both logo and title ( your website title is still seen by the browser for SEO purposes )</li></ul>", 
	// 				  "Set Title State", 
	// 				  array( "titlelogo", "logo", "title", "none" ),
	// 				  array( "Title Text & Logo", "Logo Only", "Title Only", "None" ) );
					  
	// lf_font_style( 'option',
	// 			   'main_options[header_title_font]',
	// 			   'header_title_font_opt',
	// 			   'main_options',
	// 			   'header_title_font',
	// 			   '<p>Chose the font of your Website Title, from any of the fonts listed.</p>
	// 				<p>Only select one option. </p>',
	// 			   'Set Header Title Font' );
				   
	// lf_create_option( 'select',
	// 				  'main_options[header_text_style]',
	// 				  'header_text_style_opt',
	// 				  'main_options',
	// 				  'header_text_style',
	// 				  '<p>Set the header title style to be :</p>
	// 					<ul>
	// 					<li>Normal, <i>Italic</i>, <b>Bold</b> or <i><b>Bold & Italic</b></i></li>
	// 					</ul>',
	// 				  'Set Header Text Style',
	// 				  array( 'normal', 'italic', 'bold', 'italicbold' ),
	// 				  array( 'Normal', 'Italic', 'Bold', 'Italic & Bold' ) );
	
	// lf_create_option( "slider",
	// 				  "main_options[header_title_font_size]",
	// 				  "header_title_font_size_opt",
	// 				  "main_options",
	// 				  "header_title_font_size",
	// 				  "<p>Sets the size of your title font.</p><p>Use the slider to chose any font size ranging from 16 pixels to 120 pixels.</p>",
	// 				  "Set Title Font Size",
	// 				  " pixels" );
	
	// lf_create_option( "color", 
	// 				  "main_options[header_title_color]", 
	// 				  "header_title_color_opt", 
	// 				  "main_options", 
	// 				  "header_title_color", 
	// 				  "<p>Chose the color of your websites title font.</p><p> ( after saving the right hand box will display the chosen color )</p>", 
	// 				  "Set Title Color" ); 
	
	lf_create_option( "select", 
					  "main_options[header_title_position]", 
					  "header_title_position_opt", 
					  "main_options", 
					  "header_title_position", 
					  "<p>Chose where your title and/or logo is positioned inside the header area, out of nine possible options.</p>
					  <p>It may help to visualize the positions as a grid of nine squares, positioned in your header, with three squares per row.</p>
					  <ul>
					  <li>Top Left - Top Center - Top Right</li>
					  <li>Center Left - Center - Center Right</li>
					  <li>Bottom Left - Bottom Center - Bottom Righ</li>
					  </ul>", 
					  "Set Title and Logo Position", 
					  array( "bottomleft", "bottomcenter", "bottomright", "centerleft", "center", "centerright", "topleft", "topcenter", "topright" ),
					  array( "Bottom Left", "Bottom Center", "Bottom Right", "Center Left", "Center", "Center Right", "Top Left", "Top Center", "Top Right" ) ); 
					  
	// lf_create_option( "upload", 
	// 				  "main_options[logo_upload]", 
	// 				  "logo_upload_opt", 
	// 				  "main_options", 
	// 				  "logo_upload", 
	// 				  "<p>Upload a logo which will appear right next to your title, or just on its own.</p> 
	// 				  <p>The logo preview next to the option is just a example of how your logo will look like, and is not the actual size that your logo will appear as on the header.</p>
	// 				  <p>Logos can be any size or ratio; however, logos which are more square than rectangular might work better.</p>", 
	// 				  "Upload a Logo" ); 
					  
	// lf_create_option( "slider", 
	// 				  "main_options[logo_sizeus]", 
	// 				  "logo_sizeus_opt", 
	// 				  "main_options", 
	// 				  "logo_sizeus", 
	// 				  "<p>Setting the logo size will affect the height of your image, and its width will scale along in proportion with it.</p>
	// 				  <p>Setting the size of your logo greater than what its height is will result in pixelation.</p>", 
	// 				  "Set Logo Size", 
	// 				  ' pixels' ); 
					  
	lf_create_option( "select", 
					  "main_options[logo_orentation]", 
					  "header_logo_orentation_opt", 
					  "main_options", 
					  "logo_orentation", 
					  "<p>Chose weather your logo will display to left of the title, or to the right. ( <b>Title Text & Logo</b> state only )</p> ", 
					  "Set Logo Orentation", 
					  array( 'before', 'after' ),
					  array( 'Before Title', 'After Title' ) ); 
	/* unused */
	// lf_create_option( "select", 
	// 				  "main_options[header_background_state]", 
	// 				  "header_background_state_opt", 
	// 				  "main_options", 
	// 				  "header_background_state", 
	// 				  "<p>Your header can have four different background states.</p>
	// 				  <ul>
	// 				  <li><b>Transparent</b> : Makes your header background colorless</li>
	// 				  <li><b>Rays</b> : This is the default White Whale background image, which displays light rays from the top right of your header. </li>
	// 				  <li><b>Uploaded Header Image</b> : Upload your own image, which will be used as the header background. ( Your logo and/or title will still be visible, unless set otherwise by you )</li>
	// 				  <li><b>Chosen Color</b> : Set any color to be your header background</li>
	// 				  </ul>", 
	// 				  "Set Header Background State", 
	// 				  array( 'none', 'custom', 'color' ),
	// 				  array( 'Transparent', 'Uploaded Header Image', 'Chosen Color' ) );

	// lf_create_option( "slider", 
	// 				  "main_options[header_height]", 
	// 				  "header_height_opt", 
	// 				  "main_options", 
	// 				  "header_height", 
	// 				  "<p>Set the height of your header ranging from 24 pixels to 2000 pixels. ( If you wish to hide your header completely, chose the <b>no header</b> state, in the layout section )</p>", 
	// 				  "Set Header Height",
	// 				  ' pixels' );
					  
	lf_create_option( "upload", 
					  "main_options[header_background_image]", 
					  "header_background_image_opt", 
					  "main_options", 
					  "header_background_image", 
					  "<p>Upload any imagine to act as the background of the header.</p>
					  <p>If the background image height is bigger than the header height, the background image will be clipped.</p>", 
					  "Upload Header Background Image" ); 
					  
	lf_create_option( "color", 
					  "main_options[header_background_color]", 
					  "header_background_color_opt", 
					  "main_options", 
					  "header_background_color", 
					  "<p>Set the background color of your header</p>
					  <p>( after saving the right hand box will display the chosen color )</p>", 
					  "Set Header Background Color" ); 
	/* Unused */				  
	// lf_create_option( 
	// 		'divider', 
	// 		'Header Top&Bottom Bars',
	// 		'<p>A header bar is a decorational element, that stretches the width of your header. You can set the bars to show at the top, or bottom or both. </p>
	// 		<p>The header bars can display text, as such they can be used as small disclaimers.</p>
	// 		<p>Another instance in which you might want to use a header bar, is to separate content visualy, or simply because it looks good.</p>',
	// 		'24px' ); 
			
	// lf_create_option( 
	// 				'select',
	// 				'main_options[header_bars_align]',
	// 				'header_bars_align_opt',
	// 				'main_options',
	// 				'header_bars_align',
	// 				'<p>Position your bar text to a certain side.</p>',
	// 				'Text Align',
	// 				array( 'left', 'center', 'right' ),
	// 				array( 'Left', 'Middle', 'Right' ) );
					
	// lf_create_option( 
	// 				'slider',
	// 				'main_options[header_bars_thickness]',
	// 				'header_bars_thickness_opt',
	// 				'main_options',
	// 				'header_bars_thickness',
	// 				'<p>Set the thickness of your bars. </p>',
	// 				'Bar Thickness',
	// 				' pixels' );
					  
	// lf_create_option( "select", 
	// 				  "main_options[header_show_topbar]", 
	// 				  "header_show_topbar_opt", 
	// 				  "main_options", 
	// 				  "header_show_topbar", 
	// 				  "<p>Your header will have a top bar above it. ( A bar is a purely decorative element; you can, also, change the color of your topbar as well as have it hold text that you want, within it.</p>", 
	// 				  "Show Header Topbar", 
	// 				  array( 'yes', 'no' ),
	// 				  array( 'Yes', 'No' ) );
					  
	// lf_create_option( "text", 
	// 				  "main_options[header_topbar_text]", 
	// 				  "header_topbar_text_opt", 
	// 				  "main_options", 
	// 				  "header_topbar_text", 
	// 				  "<p>The topbar text is small and ideal for short messages or disclaimers you may want to add.</p>
	// 				  <p>If you want it to have not text, simply leave the field blank</p>", 
	// 				  "Set Header Topbar Text" ); 
					  
	// lf_create_option( "select", 
	// 				  "main_options[header_show_bottombar]", 
	// 				  "header_show_bottombar_opt", 
	// 				  "main_options", 
	// 				  "header_show_bottombar", 
	// 				  "<p>Your header will have a bottom bar bellow it. ( A bar is a purely decorative element; you can, also, change the color of your bottombar as well as have it hold text, in it</p>", 
	// 				  "Show Header Bottombar", 
	// 				  array( 'yes', 'no' ),
	// 				  array( 'Yes', 'No' ) );
					  				 			  			  				  
	// lf_create_option( "text", 
	// 				  "main_options[header_bottombar_text]", 
	// 				  "header_bottombar_text_opt", 
	// 				  "main_options", 
	// 				  "header_bottombar_text", 
	// 				  "<p>The bottombar text is small and ideal for short messages or disclaimers you may want to add.</p>
	// 				  <p>If you want it to have not text, simply leave the field blank</p>", 
	// 				  "Set Header Bottombar Text" ); 
					  				  
	// lf_create_option( "color", 
	// 				  "main_options[header_bars_color]", 
	// 				  "header_bars_color_opt", 
	// 				  "main_options", 
	// 				  "header_bars_color", 
	// 				  "<p>Set the color of the top and bottom bars.</p>
	// 				  <p>( after saving the right hand box will display the chosen color )</p>", 
	// 				  "Set Header Bars Color" );
					  
	// lf_create_option( "color", 
	// 				  "main_options[header_bars_text_color]", 
	// 				  "header_bars_text_color_opt", 
	// 				  "main_options", 
	// 				  "header_bars_text_color", 
	// 				  "<p>Set the text color of the top and bottom bars.</p>
	// 				  <p>( after saving the right hand box will display the chosen color )</p>", 
	// 				  "Set Header Bars Text Color" ); 
					 	
	echo '</div>';
	
}



function lf_header_editable_style() { 

	$main_opt = get_option("main_options");
	
	global $post;

	$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'header_state' );
	
	$h_height = 120;
	
	if ( isset( $layout ) ) {
	
		if ( $layout == 'topad' 
			|| $layout == 'bottomad' ) {
			
			if ( $main_opt['header_advert_type'] == 'banner' ) {
			
				$h_height = $main_opt["header_height"] - 104;
			
			}
			
			if ( $main_opt['header_advert_type'] == 'leaderboard' ) { 
			
				$h_height = $main_opt["header_height"] - 126;	
			
			}
		
		}
		
		else {
		
			$h_height = $main_opt["header_height"];
		
		}
	
	}
	
	lf_style_change ( 
		'double', 
		$main_opt["header_height"], 
		null, 
		'.lf-header-main-wrap,
		.lf-header', 
		'height', 
		array( '336px', $main_opt["header_height"] . 'px' ));
	
	/* // Header Title // */
	
	lf_style_change ( 
		'double', 
		$main_opt["logo_sizeus"], 
		null,
		'.lf-header-logo img', 
		'height', 
		array( '60px', $main_opt["logo_sizeus"] .'px' ) );
					
	
					
	lf_style_change ( 
			"numerous", 
			$main_opt["header_title_position"], 
			array( 
				'topright',
				'topleft',
				'centerright',
				'centerleft',
				'bottomright',
				'bottomleft' ),
			'.lf-sitetitle-wrap', 
			'text-align', 
			array( 
				'right',
				'left',
				'right',
				'left',
				'right',
				'left' ) );
				
	/* // lf-site-title margin style // */
							
	// 	Title 
	lf_style_change ( 
			"double-single", 
			array ( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ),
			array( 
				'bottomleft', 
				'title' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) - 12 . 'px' );
	
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomcenter',
				'title'),  
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) - 12 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomright',
				'title'),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) - 12 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'centerleft',
				'title' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) / 2 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'center',
				'title' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) / 2 . 'px' );
			
	lf_style_change ( 
			"single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array( 
				'centerright',
				'title' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["header_title_font_size"] ) / 2 . 'px' );
			
	// 	Title & Logo 
	
	$sizeus;
	
	if ( $main_opt["header_title_font_size"] < $main_opt["logo_sizeus"] ) {
	
		global $sizeus;
		
		$sizeus = $main_opt["logo_sizeus"];
	
	}
	
	elseif ( $main_opt["header_title_font_size"] > $main_opt["logo_sizeus"] 
			|| $main_opt["header_title_font_size"] == $main_opt["logo_sizeus"] ) {
	
		global $sizeus;
		
		$sizeus = $main_opt["header_title_font_size"];
	
	}
	
	lf_style_change ( 
			'double-single', 
			array ( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ),
			array( 
				'bottomleft', 
				'titlelogo' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) - 12 . 'px' );
	
	lf_style_change ( 
			'double-single', 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomcenter',
				'titlelogo'),  
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) - 12 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomright',
				'titlelogo'),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) - 12 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'centerleft',
				'titlelogo' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) / 2 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'center',
				'titlelogo' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) / 2 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array( 
				'centerright',
				'titlelogo' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $sizeus ) / 2 . 'px' );
			
	// 	Logo only Position		
	
	lf_style_change ( 
		"double-single", 
		array( 
			$main_opt["header_title_position"],
			$main_opt["header_title_state"]), 
		array(  
			'bottomleft',
			'logo'),  
		'.lf-header-logo', 
		'margin-top', 
		( $h_height - $main_opt["logo_sizeus"] ) - 12 . 'px' );
		
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomcenter',
				'logo'),  
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["logo_sizeus"] ) - 12 . 'px' );	
		
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'bottomright',
				'logo'),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["logo_sizeus"] ) - 12 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'centerleft',
				'logo' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["logo_sizeus"] ) / 2 . 'px' );
			
	lf_style_change ( 
			"double-single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array(  
				'center',
				'logo' ), 
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["logo_sizeus"] ) / 2 . 'px' );
			
	lf_style_change ( 
			"single", 
			array( 
				$main_opt["header_title_position"],
				$main_opt["header_title_state"] ), 
			array( 
				'centerright',
				'logo' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			( $h_height - $main_opt["logo_sizeus"] ) / 2 . 'px' );
			
	lf_style_change ( 
			"numerous", 
			$main_opt["header_title_position"], 
			array( 
				'topright', 
				'topleft',
				'topcenter' ),
			'.lf-sitetitle-wrap', 
			'margin-top', 
			array(
				'12px',
				'12px',
				'12px' ) );
			
			
	/* // Header Title font-size // */
	
	lf_style_change( 
			'double',
			$main_opt["header_title_font_size"],
			null,
			'.lf-sitetitle h1',
			'font-size',
			array( '72px', $main_opt["header_title_font_size"] .'px' ) );
			
	lf_style_change( 
			'double',
			$main_opt["header_title_font_size"],
			null,
			'.lf-sitetitle h1',
			'line-height',
			array( '72px', $main_opt["header_title_font_size"] .'px' ) );
			
	lf_style_change(
			'double',
			$main_opt['header_title_font'],
			null,
			'.lf-sitetitle h1',
			'font-family',
			array( '"Georgia", Serif', $main_opt['header_title_font'] ) );
			
	lf_style_change(
			'numerous',
			$main_opt['header_text_style'],
			array( 
				null,
				'normal',
				'italic',
				'bold',
				'italicbold' ),
			'.lf-sitetitle h1',
			'font-weight',
			array( 'normal', 'normal', 'normal', '700', '700' ) );
			
	lf_style_change(
			'numerous',
			$main_opt['header_text_style'],
			array( 
				null,
				'normal',
				'italic',
				'bold',
				'italicbold' ),
			'.lf-sitetitle h1',
			'font-style',
			array( 'normal', 'normal', 'italic', 'normal', 'italic' ) );
	
	//	Font Color 
	
	lf_style_change( 
			'double',
			$main_opt["header_title_color"],
			null,
			'.lf-sitetitle a',
			'color',
			array( '#444', $main_opt["header_title_color"] ) );
	
	
	/* // Header Background // */
	
	lf_style_change ( 
			"numerous", 
			$main_opt["header_background_state"], 
			array( 
				null, 
				'none', 
				'custom', 
				'color' ),
			'.lf-header', 
			'background', 
			array( 
				'none',
				'none',
				'none',
				$main_opt["header_background_color"])  );
				
				
	/* // Bar Colors // */ 
	
	lf_style_change ( 
			"double", 
			$main_opt["header_bars_color"], 
			null ,
			'.lf-header-bar', 
			'background', 
			array( '#444', $main_opt["header_bars_color"] ) );
			
	lf_style_change ( 
			"double", 
			$main_opt["header_bars_text_color"], 
			null ,
			'.lf-header-bar small', 
			'color', 
			array( '#e7e7e7', $main_opt["header_bars_text_color"] ) );
			
			
	// /* Ad Styles */ //
	
		/* // / Left and right adverts - Width / // */
			
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'rightad',
				'leaderboard' ),
			'.lf-sitetitle-wrap', 
			'width', 
			'20%' );
						
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'rightad',
				'banner' ),
			'.lf-sitetitle-wrap', 
			'width', 
			'35%' );
			
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'leftad',
				'leaderboard' ),
			'.lf-sitetitle-wrap', 
			'width', 
			'20%' );	
			
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'leftad',
				'banner' ),
			'.lf-sitetitle-wrap', 
			'width', 
			'30%' );	
			
		/* // / Left and right adverts - Float / // */
			
	lf_style_change ( 
			"numerous", 
			$layout,
			array(
				'rightad',
				'leftad',
				'topad',
				'bottomad' ),
			'.lf-sitetitle-wrap', 
			'float', 
			array( 
				'left',
				'right',
				'left', 
				'left' ) );
				
	lf_style_change ( 
			"numerous", 
			$layout,
			array(
				'rightad',
				'leftad',
				'topad',
				'bottomad' ),
			'.lf-header-ad-wrap', 
			'float', 
			array( 
				'right',
				'left',
				'left',
				'left' ) );
				
				
		/* // / Top and bottom adverts - Width / // */
					
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'topad',
				'leaderboard' ),
			'.lf-header-ad-wrap', 
			'width', 
			'100%' );
					
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'topad',
				'banner' ),
			'.lf-header-ad-wrap', 
			'width', 
			'100%' );
	
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'bottomad',
				'leaderboard' ),
			'.lf-header-ad-wrap', 
			'width', 
			'100%' );	
			
	lf_style_change ( 
			"double-single", 
			array(	
				$layout, 
				$main_opt['header_advert_type'] ),
			array(
				'bottomad',
				'banner' ),
			'.lf-header-ad-wrap', 
			'width', 
			'100%' );	
			
	/* // Header bars // */
	
	lf_style_change( 
		'double',
		$main_opt["header_bars_align"],
		null,
		'.lf-header-bar',
		'text-align',
		array( 'left', $main_opt["header_bars_align"] )  );
		
	lf_style_change( 
		'double',
		$main_opt["header_bars_thickness"],
		null,
		'.lf-header-bar',
		'padding-top',
		array( '22px', $main_opt["header_bars_thickness"] / 2 . 'px' )  );
		
	lf_style_change( 
		'double',
		$main_opt["header_bars_thickness"],
		null,
		'.lf-header-bar',
		'padding-bottom',
		array( '22px', $main_opt["header_bars_thickness"] / 2 . 'px' )  );
											
}

add_action( 'lf_editable_style', 'lf_header_editable_style' );

function lf_header_editable_style_tablet() { 

	$main_opt = get_option("main_options");
	
	lf_style_change( 
		'double',
		$main_opt["header_title_font_size"],
		null,
		'.lf-sitetitle h1',
		'font-size',
		array( '48px', $main_opt["header_title_font_size"] - 20 .'px' ) );
			
	lf_style_change( 
		'double',
		$main_opt["header_title_font_size"],
		null,
		'.lf-sitetitle h1',
		'line-height',
		array( '48px', $main_opt["header_title_font_size"] - 20 .'px' ) );
			
	lf_style_change ( 
		'double', 
		$main_opt["logo_sizeus"], 
		null,
		'.lf-header-logo img', 
		'height', 
		array( '40px', $main_opt["logo_sizeus"] - 20 .'px' ) );
	
}

add_action( 'lf_editable_style_tablet', 'lf_header_editable_style_tablet' );


function lf_header_editable_style_small() { 

	$main_opt = get_option("main_options");

	lf_style_change( 
		'double',
		$main_opt["header_title_font_size"],
		null,
		'.lf-sitetitle h1',
		'font-size',
		array( '48px', $main_opt["header_title_font_size"] / 2 .'px' ) );
			
	lf_style_change( 
		'double',
		$main_opt["header_title_font_size"],
		null,
		'.lf-sitetitle h1',
		'line-height',
		array( '48px', $main_opt["header_title_font_size"] / 2 .'px' ) );
			
	lf_style_change ( 
		'double', 
		$main_opt["logo_sizeus"], 
		null,
		'.lf-header-logo img', 
		'height', 
		array( '40px', $main_opt["logo_sizeus"] / 2 .'px' ) );
			
}

add_action( 'lf_editable_style_small', 'lf_header_editable_style_small' );



?>