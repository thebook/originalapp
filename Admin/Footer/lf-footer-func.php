<?php 

function lf_footer_reg_sidebar() { 

	register_sidebar( 
		array( 'name' => __( 'Footer Widget Column One', 'liquidflux' ),
			   'id' => 'footer-sidebar1',
			   'before_widget' => '<div id="%1$s" class="lf-footer-widget %2$s">', 
			   'after_widget' => "</div>",
			   'before_title' => '<h3 class="lf-footer-widget-h3 ">',
			   'after_title' => '</h3>' ) );
			   
	register_sidebar( 
		array( 'name' => __( 'Footer Widget Column Two', 'liquidflux' ),
			   'id' => 'footer-sidebar2',
			   'before_widget' => '<div id="%1$s" class="lf-footer-widget %2$s">', 
			   'after_widget' => "</div>",
			   'before_title' => '<h3 class="lf-footer-widget-h3 ">',
			   'after_title' => '</h3>' ) );
			   
	register_sidebar( 
		array( 'name' => __( 'Footer Widget Column Three', 'liquidflux' ),
			   'id' => 'footer-sidebar3',
			   'before_widget' => '<div id="%1$s" class="lf-footer-widget %2$s">', 
			   'after_widget' => "</div>",
			   'before_title' => '<h3 class="lf-footer-widget-h3 ">',
			   'after_title' => '</h3>' ) );
			   
	register_sidebar( 
		array( 'name' => __( 'Footer Widget Column Four', 'liquidflux' ),
			   'id' => 'footer-sidebar4',
			   'before_widget' => '<div id="%1$s" class="lf-footer-widget %2$s">', 
			   'after_widget' => "</div>",
			   'before_title' => '<h3 class="lf-footer-widget-h3 ">',
			   'after_title' => '</h3>' ) );

}	

add_action( 'widgets_init', 'lf_footer_reg_sidebar' );

function lf_footer_section_callback() { 

	echo '<div class="form-table">';

	lf_create_option( 'select',
					  'main_options[footer_height_state]',
					  'footer_height_state_opt',
					  'main_options',
					  'footer_height_state',
					  '<p>Set the state of your footer height :</p>
					  <ul>
					   <li><b>Automatic Height</b> : Have the footer automatically adjust its height to fit the content within it.</li>
					   <li><b>Set Height</b> : Set the height of the footer yourself. </li>
					  </ul>',
					  'Set Footer Height State',
					  array( 'auto', 'manual' ),
					  array( 'Automatic Height', 'Set Height' ) );
					  
	lf_create_option( 'slider',
					  'main_options[footer_height]',
					  'footer_height_opt',
					  'main_options',
					  'footer_height',
					  '<p>Set the height of the footer by choosing any value from 48 pixels to 1000 pixels. </p>',
					  'Set Footer Height',
					  ' pixels' );
					  
	lf_create_option( 'select',
					  'main_options[footer_hide_shadow]',
					  'footer_hide_shadow_opt',
					  'main_options',
					  'footer_hide_shadow',
					  '<p>Hide the footer drop shadow.</p>
					   <p>The footer drop shadow is a shadow at the very top of the footer which falls on any part which is above the footer. </p>',
					  'Hide Footer Drop Shadow',
					  array( 'no', 'yes' ),
					  array( 'Dont Hide', 'Hide' ) );
					  
	lf_create_option( 'color',
					  'main_options[footer_text_color]',
					  'footer_text_color_opt',
					  'main_options',
					  'footer_text_color',
					  '<p>Set the color of the footer text.</p>
					  <p>( after saving the right hand box will display the chosen color )</p>',
					  'Set Footer Text Color' );
					  
	lf_create_option( 'color',
					  'main_options[footer_background_color]',
					  'footer_background_color_opt',
					  'main_options',
					  'footer_background_color',
					  '<p>Set the background color of the footer.</p>
					  <p>( after saving the right hand box will display the chosen color )</p>',
					  'Set Footer Background Color' );
					  
	echo '</div>';
	

}

function lf_editable_style_footer() {

	$main_opt = get_option( 'main_options' );
			
	lf_style_change( 
		'single',
		$main_opt['footer_height_state'],
		'manual',
		'.lf-footer',
		'height',
		$main_opt['footer_height'] . 'px' );
		
	lf_style_change( 
		'double',
		$main_opt['footer_text_color'],
		null,
		'.lf-footer-widget-h3,
		.lf-footer-widget,
		.lf-footer .lf-recent-posts-widget p',
		'color',
		array( '#e7e7e7',
				$main_opt['footer_text_color'] ) );
		
	lf_style_change( 
		'double',
		$main_opt['footer_background_color'],
		null,
		'.lf-footer-wrap',
		'background-color',
		array( '#444',
				$main_opt['footer_background_color'] ) ); 
		
}

add_action( "lf_editable_style", "lf_editable_style_footer" );


?>