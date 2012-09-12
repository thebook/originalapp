<?php 

function breadcrumbs( $wrap = 'lf-main-navigation-style' ) {

   $main_opt = get_option( 'main_options' );
   
   if ( $main_opt['nav_breadcrumbs_state'] != 'hidden' ) {
    
	echo "<nav class='$wrap' id='lf-breadcrumbs-id'>";
	
	echo '<ul>';
	
	if ( !is_home() ) {
	
		echo '<li>';
		
		echo '<a href="'. get_option('home') . '">Home </a>';
		
		echo '</li>';
		
		if ( is_category() || is_single() ) {
		
			echo '<li> > ';
		
			the_category('>');
		
			echo '</li>';
			
			if ( is_single() ) {
				
				echo '<li> > ';
				
				echo '<a href="'. get_permalink() .'">';
		
				the_title();
				
				echo '</a>';
		
				echo '</li>';
				
			}
		
		}
		
		elseif ( is_tag() ) {
		
			echo '<li> > ';
			
			echo '<a>';
		
			single_tag_title();
			
			echo '</a>';
		
			echo '</li>';
		
		}
		
		elseif ( is_page() ) {
		
			echo '<li> > ';
				
			echo '<a href="'. get_permalink() .'">';
		
			the_title();
				
			echo '</a>';
		
			echo '</li>';
		
		}
		
	}
	
	elseif ( is_home() ) {
		
		echo '<li>';
		
		echo '<a href="'. get_option('home') . '">Home </a>';
		
		echo '</li>';
		
		}
   
	echo '</ul>';
	
	echo '</nav>';
	
	}
	
}

function pagnation($pages = '', $range = 2) { 
 
	$showitems = ($range * 2)+1;  

		global $paged;
										
		if(empty($paged)) $paged = 1;

			if($pages == '') {
				
				global $wp_query;
										
				$pages = $wp_query->max_num_pages;
											
				if(!$pages) {
					
					$pages = 1;
											
				}
										
			}   

			if(1 != $pages) {
										
				echo '<nav id="" class="lf-pagnation-nav">';
										
				if	($paged > 2 && $paged > $range+1 && $showitems < $pages) 
				
					echo "<a class='lf-pagnation-num' href='".get_pagenum_link(1)."'>&laquo;</a>";
										
				if	($paged > 1 && $showitems < $pages) 
				
					echo "<a class='lf-pagnation-num' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
												
				for ($i=1; $i <= $pages; $i++) {
													
					if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
														
						echo ($paged == $i)? "|<span class='lf-pagnation-num-current'>".$i."  </span>":"|<a class='lf-pagnation-num' href='".get_pagenum_link($i)."'>".$i."  </a>";
													
					}
												
				}
												

				if ($paged < $pages && $showitems < $pages) 
				
					echo "<a class='lf-pagnation-num' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
										
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				
					echo "<a class='lf-pagnation-num' href='".get_pagenum_link($pages)."'>&raquo;</a>";
										
				echo "</nav>";
				
			}
			
}		

function lf_navigation_section_callback () { 

	echo '<div class="form-table">';
	
	lf_create_option( 
					'select',
					'main_options[navigation_state]',
					'navigation_state_opt',
					'main_options',
					'navigation_state',
					'<p>Set your navigation to one of the three available states.</p>
					<ul>
					<li><p><b>Full Navigation</b> : Your website has a drop-down navigation bar.</p>
					<p>You can add multiple navigation link levels to your navigation bar by going to "Apperance->Menus".</p> 
					<p>You make a link a sub level by clicking and dragging the link box a bit to the right, then you will see an indented box-outline appear, when this happens release your click.</p>
					</li>
					<li><b>No Drop-down Navigation</b> : Your navigation bar has no drop-down option. Your navigation menu, will only have one visible level, and no further levels would show up on mouse hover.</li>
					<li><b>Remove Navigation</b> : Completely removes the navigation bar from the site. </li>
					
					</ul>
					',
					'Set Navigation State',
					array( 'fullnav', 'nodropnav', 'nonav' ),
					array( 'Full Navigation', 'No Drop-down Navigation', 'Remove Navigation' ) );
					
	lf_create_option( 
					'select',
					'main_options[nav_breadcrumbs_state]',
					'nav_breadcrumbs_state_opt',
					'main_options',
					'nav_breadcrumbs_state',
					'<p>Set whether your website breadcrumbs are shown or hidden.</p>
					<p>Your breadcrumbs appear right above the content area. Breadcrumbs show the user where they are currently.</p>
					<p>Your styled by the same options your navigation is.</p>',
					'Set Breadcrumb State',
					array( 'show', 'hidden' ),
					array( 'Show Breadcrumbs', 'Remove Breadcrumbs' ) );
	
	lf_create_option( 
					'color',
					'main_options[navigation_background_color]',
					'navigation_background_color_opt',
					'main_options',
					'navigation_background_color',
					'<p>Set the background color of your navigation bar.</p> 
					<p>To begin choosing the color click the text field. </p>
					<p> ( After saving there will be a box which displays the current chosen color )</p>',
					'Set Nav-bar Background Color' );
					
	lf_create_option( 
					'color',
					'main_options[navigation_text_color]',
					'navigation_text_color_opt',
					'main_options',
					'navigation_text_color',
					'<p>Set the Text color of your navigation bar.</p> 
					<p>To begin choosing the color click the text field.</p>
					<p>( After saving there will be a box which displays the current chosen color )</p>',
					'Set Nav-bar Text Color' );
					
	lf_create_option( 
					'color',
					'main_options[navigation_text_hover_color]',
					'navigation_text_hover_color_opt',
					'main_options',
					'navigation_text_hover_color',
					'<p>Set the Text Hover color of your navigation bar.</p>
					<p>The text hover color is the color that your text will become when a cursor is moved over it.</p>
					<p>To begin choosing the color click the text field.</p>
					<p>( After saving there will be a box which displays the current chosen color )</p>',
					'Set Nav-bar Text Hover Color' );
					
	lf_create_option( 
					'select',
					'main_options[navigation_text_align]',
					'navigation_text_align_opt',
					'main_options',
					'navigation_text_align',
					'<p>Position your navigation text to a certain side.</p>',
					'Navigation Text Position',
					array( 'left', 'center', 'right' ),
					array( 'Left', 'Middle', 'Right' ) );
					
	lf_create_option( 
					'select',
					'main_options[navigation_remove_dropshadow]',
					'navigation_remove_dropshadow_opt',
					'main_options',
					'navigation_remove_dropshadow',
					'<p>Your can remove the drop shadow of your navigation bar by choosing remove.</p> 
					<p>The drop shadow of your navigation bar is the shadow which appears to be coming from the bottom of it.</p>
					<p>Leaving a drop shadow, will give your navigation bar a more 3-D look, whilst removing it will make it seem more flat. </p>',
					'Remove Navigation Drop Shadow',
					array( 'yes', 'no' ),
					array( 'Leave', 'Remove' ) );
											
	echo '</div>';

}

function lf_navigation_editable_style() {

	$main_opt = get_option("main_options");
	
	//	Background Color
	lf_style_change( 
					'double',
					$main_opt["navigation_background_color"],
					null,
					'.lf-main-navigation-style',
					'background-color',
					array( '#444', $main_opt["navigation_background_color"] ) );
					
	lf_style_change( 
					'double',
					$main_opt["navigation_background_color"],
					null,
					'.lf-main-navigation-style .sub-menu,
					.lf-main-navigation-style .children',
					'background-color',
					array( '#444', $main_opt["navigation_background_color"] ) );
	
	// 	Text Color
	lf_style_change( 
					'double',
					$main_opt["navigation_text_color"],
					null,
					'.lf-main-navigation-style a,
					.lf-main-navigation-style li',
					'color',
					array( '#e7e7e7', $main_opt["navigation_text_color"] ) ); 
					
	lf_style_change( 
					'double',
					$main_opt["navigation_text_hover_color"],
					null,
					'.lf-main-navigation-style a:hover,
					.lf-pagnation-num-current',
					'color',
					array( '#4a92e8', $main_opt["navigation_text_hover_color"] ) ); 
	
	// 	Text Align
	lf_style_change( 
					'double',
					$main_opt["navigation_text_align"],
					null,
					'.lf-main-navigation-style',
					'text-align',
					array( 'left', $main_opt["navigation_text_align"] ) ); 
					
	lf_style_change( 
					'single',
					$main_opt["navigation_text_align"],
					'right',
					'.lf-main-navigation-style ul.sub-menu ul.sub-menu',
					'margin',
					'0 0 0 -312px'); 
					
	lf_style_change( 
					'double',
					$main_opt["navigation_text_align"],
					'right',
					'.lf-main-navigation-style ul.sub-menu',
					'margin',
					array( '0 0 0 -31px', '0 0 0 -12px' ) ); 
					
	// Text Size 
	
	$nav_font_calc = ( $main_opt['body_text_size'] / 100 ) * 75;
	
	lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'.lf-main-navigation-style a',
			'font',
			array( 
				'normal 12px/24px "Georgia", Serif ',
				'normal ' . 
				$nav_font_calc . 'px/' . 
				( $main_opt['body_text_size'] + ( $main_opt['body_text_size'] / 2 )  ) . 'px ' . $main_opt["body_font_choice"] ) );
				
	lf_style_change(
			'double',
			$main_opt['body_text_size'],
			null,
			'.lf-main-navigation-style a',
			'font',
			array( 
				'normal 0.75rem/1.5rem "Georgia", Serif ',
				'normal ' . 
				$nav_font_calc / 16 . 'rem/' . 
				( $main_opt['body_text_size'] + ( $main_opt['body_text_size'] / 2 )  ) / 16 . 'rem ' . $main_opt["body_font_choice"] ) );
	

	
	//	Dropshadow
	lf_style_change( 
					'numerous',
					$main_opt["navigation_remove_dropshadow"],
					array( 
						null, 
						'yes', 
						'no' ),
					'.lf-main-navigation-style',
					'box-shadow',
					array( '1px 3px 2px 0px rgba(0, 0, 0, 0.2)',
						   '1px 3px 2px 0px rgba(0, 0, 0, 0.2)',
						   'none' ) );
						   
	lf_style_change( 
					'numerous',
					$main_opt["navigation_remove_dropshadow"],
					array( 
						null, 
						'yes', 
						'no' ),
					'.sub-menu',
					'box-shadow',
					array( '1px 3px 2px 1px rgba(0, 0, 0, 0.2)',
						   '1px 3px 2px 1px rgba(0, 0, 0, 0.2)',
						   'none' ) ); 
						   
	lf_style_change( 
					'numerous',
					$main_opt["navigation_remove_dropshadow"],
					array( 
						null, 
						'yes', 
						'no' ),
					'.lf-main-navigation-style',
					'-webkit-box-shadow',
					array( '1px 3px 2px 0px rgba(0, 0, 0, 0.2)',
						   '1px 3px 2px 0px rgba(0, 0, 0, 0.2)',
						   'none' ) );
						   
	lf_style_change( 
					'numerous',
					$main_opt["navigation_remove_dropshadow"],
					array( 
						null, 
						'yes', 
						'no' ),
					'.sub-menu',
					'-webkit-box-shadow',
					array( '1px 3px 2px 1px rgba(0, 0, 0, 0.2)',
						   '1px 3px 2px 1px rgba(0, 0, 0, 0.2)',
						   'none' ) ); 
				
}

add_action( 'lf_editable_style', 'lf_navigation_editable_style' );

function lf_navigation_js () { 

	wp_register_script('longnav', ADMINURI . '/Navigation/assets/longnav.js', array('jquery'), '1.0', false );
	
	wp_enqueue_script ('longnav');

}

add_action( 'wp_enqueue_scripts', 'lf_navigation_js' );


?>