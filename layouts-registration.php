<?php 

/* // Registering Levels // */

// 	Level 1 - header 

function header_level() { 

	function create_header_level() {
	
		lf_create_level( 0 ); 

	}

	$firstlevel = array(); 
	
	lf_register_level( $firstlevel, "create_header_level" );


	function header_level_func() {
	
		get_template_part( 'liquidheader' ); 
	
	}
	
	lf_register_level_func( 0, "header_level_func" );
	
	
	
}	

function call_multi_opt_header() { 

	$options = get_option('main_options');
	$value = $options["header_state"];

	echo "<select name='main_options[header_state]' id='header-state-multisort' class='multilev-inv-select'>";
	
	echo "<option value='stripheader' ". selected( $value, "stripheader" ) .">Strip Header</option>";
	echo "<option value='rightad' ". selected( $value, "rightad" ) ." > Right Advert</option>"; 
	echo "<option value='leftad' ". selected( $value, "leftad" ) ." >Left Advert </option>";
	echo "<option value='topad' ". selected( $value, "topad" ) ."  > Advert Above Title</option>"; 
	echo "<option value='bottomad' ". selected( $value, "bottomad" ) ."  > Bottom Advert</option>"; 
	echo "<option value='noheader' ". selected( $value, "noheader" ) ."  >no header</option>"; 

	echo "</select>";
}

function create_header_level_ui() { 
	
	lf_register_level_ui( 
							0, 
							"<div class='sort-multilev-part'>
								<div class='lf-sort-rect-head-box'>
									<div class='lf-sort-rect-text-center-ad-wrap'>
										<small>Sisdalkdaldkal</small>
									</div>
								</div>
							</div>
							<div class='sort-multilev-part'>
								<div class='lf-sort-rect-head-box'>
									<div class='lf-sort-rect-ad-wrap'>
									<small>Sisdalkdaldkal</small><div class='lf-sort-rect-ad-leaderboard-right'></div>
									</div>
								</div>
							</div>
							<div class='sort-multilev-part'>											
								<div class='lf-sort-rect-head-box'>
									<div class='lf-sort-rect-ad-wrap'>
									<div class='lf-sort-rect-ad-leaderboard-left'></div><small>Sisdalkdaldkal</small>
									</div>
								</div>
							</div>
							<div class='sort-multilev-part'>
								<div class='lf-sort-rect-head-big-box'>
									<div class='lf-sort-rect-text-center-ad-wrap'>
									<div class='lf-sort-rect-ad-leaderboard-full-width'></div><small>Sisdalkdaldkal</small>
									</div>
								</div>
							</div>
							<div class='sort-multilev-part'>
								<div class='lf-sort-rect-head-big-box'>
									<div class='lf-sort-rect-text-center-ad-wrap'>
										<small>Sisdalkdaldkal</small>
										<div class='lf-sort-rect-ad-leaderboard-full-width'></div>
									</div>
								</div>
							</div>
							<div class='sort-multilev-part'>
								<div class='lf-sort-rect-box-blank'></div>
							</div>", 
							"<p>This is the header of you website. Position it anywhere and set it to one of its five available layout states. </p>
							<ul>
							<li><b>Strip Header</b> : Your regular header, with title and/or logo.</li>
							<li><b>Header & Right Advert</b> : A banner style advert is positioned to the right of your title and/or logo. Edit advert options in the header section.</li>
							<li><b>Header & Left Advert</b> : A banner style advert is positioned to the left of your title and/or logo. Edit advert options in the header section.</li>
							<li><b>Header & Top Advert</b> : A banner style advert is positioned above of  your title and/or logo. Edit advert options in the header section.</li>
							<li><b>Header & Bottom Advert</b> : A banner style advert is positioned bellow of  your title and/or logo. Edit advert options in the header section.</li>
							<li><b>No Header</b> : Removes your header entirely. ( your site title can still be seen by search engines )</li>
                            </ul>",
							true,
							"call_multi_opt_header", 
							"header-multisort");
	
}

add_action( "lf_all_your_levels_ui", "create_header_level_ui" );
add_action( "lf_all_your_levels", "header_level" );


//	Level 2 - navigation

function navigation_level() { 

	function create_navigation_level() {
	
		lf_create_level( 1 ); 

	}

	$secondlevel = array(); 
	
	lf_register_level( $secondlevel, "create_navigation_level" );


	function navigation_level_func() {
	
		get_template_part( 'liquid-navigation' ); 
	
	}
	
	lf_register_level_func( 1, "navigation_level_func" );
	
	
	
}	

function create_navigation_level_ui() { 
	
	lf_register_level_ui( 
							1, 
							"<div class='lf-sort-rect-thin'></div>", 
							'<p>This is the navigation bar of your website. Position it anywhere.</p>
							 <p>It can display links to various pages, posts and custom post types within your website.</p>
							 <p>To add links to your navigation bar go to "Apperance->Menus".</p>
							 <p>To further customize your navigation bar go to the <b>Navigation</b> section.</p>' );
	
}

add_action( "lf_all_your_levels_ui", "create_navigation_level_ui" );
add_action( "lf_all_your_levels", "navigation_level" );


//	Level 3 - slider

function slider_level() { 

	function create_slider_level() {
	
		lf_create_level( 2 ); 

	}

	$thirdlevel = array(); 
	
	lf_register_level( $thirdlevel, "create_slider_level" );


	function slider_level_func() {
		
			get_template_part( 'liquid-slider' ); 
			
	}
	
	lf_register_level_func( 2, "slider_level_func" );
	
	
	
}	

function call_multi_opt_slider() { 

	$options = get_option('main_options');
	$value = $options["slider_state"];

	echo "<select name='main_options[slider_state]' id='slider-state-multisort' class='multilev-inv-select'>";
	
	echo "<option value='fullslider' ". selected( $value, "fullslider" ) .">Full Slider</option>";
	echo "<option value='nodescslider' ". selected( $value, "nodescslider" ) .">Full Slider</option>";
	echo "<option value='description' ". selected( $value, "description" ) .">Full Slider</option>";
	echo "<option value='noslider' ". selected( $value, "noslider" ) .">Full Slider</option>";

	echo "</select>";
	
}

function create_slider_level_ui() { 
	
	lf_register_level_ui( 	
							2, 
							'<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-blank">
									<div class="lf-sort-rect-thick-dark"></div>
									<div class="lf-sort-rect-thin-white"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-blank">
									<div class="lf-sort-rect-thick-dark"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-blank">
									<div class="lf-sort-rect-thin-white"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-blank">
								</div>
							</div>', 
							'<p>This is the slider of your website. Position it anywhere and set it to one of its four states.<p> 
							<ul>
							<li><b>Slider & Description</b> : Shows a featured slider you set in the "Slider" section, as well as your website description, which you can set in "Settings->General".</li>
							<li><b>Only Slider</b> : Only displays your featured slider and hides the description.</li>
							<li><b>Only Description</b> : Hides your featured slider and only displays your website description.</li>
							<li><b>No Slider & Description</b> : Completely removes the slider area from your website.</li>
							</ul>',
							true,
							'call_multi_opt_slider',
							'slider-multisort');
	
}

add_action( "lf_all_your_levels_ui", "create_slider_level_ui" );
add_action( "lf_all_your_levels", "slider_level" );


//	Level 4 - content

function content_level() { 

	function create_content_level() {
	
		lf_create_level( 3 ); 

	}

	$fourthlevel = array(); 
	
	lf_register_level( $fourthlevel , "create_content_level" );


	function content_level_func() {
	
	$options = get_option('main_options');
	
		if ( $options["content_state"] !== "nocontent" ) {
		
			if ( is_single() ) { 
				
				get_template_part( 'single-content' );
			
			}
			elseif ( is_page() ) {

				if ( is_page_template( 'archive-template.php' ) ) {

					include( FRAMEWORK .'/Pages/archive.php' );

				}	
				elseif ( is_page_template( 'sitemap-page.php' ) ) {

					include( FRAMEWORK .'/Pages/sitemap.php' );

				}
				elseif ( is_page_template( 'list-page.php' ) ) {

					include( FRAMEWORK .'/Pages/list.php' );					

				} 						
				elseif ( !is_page_template() ) { 
				
					include( FRAMEWORK .'/Pages/page.php' );	

				}

			}
			elseif ( is_404() ) {
			
				lf_not_found_generate( 'full' );	

			}
			elseif ( is_archive() ) {
			
				lf_archive_generate( 'archive' );	
			
			}
			elseif ( is_search() ) {
			
				lf_archive_generate( 'search' );	
			
			}	
			else {
		
				get_template_part( 'index-content' ); 
			
			} 
		}
	}
	
	lf_register_level_func( 3, "content_level_func" );
		
}

function call_multi_opt_content() { 

	$options = get_option('main_options');
	$value = $options["content_state"];

	echo "<select name='main_options[content_state]' id='content-state-multisort' class='multilev-inv-select'>";
	
	echo "<option value='nosidebar' ". selected( $value, "nosidebar" ) .">No Sidebar</option>";
	echo "<option value='right' ". selected( $value, "right" ) ." >One Sidebar Right</option>";
	echo "<option value='twosidebarright' ". selected( $value, "twosidebarright" ) ." >Two Sidebar Right</option>"; 
	echo "<option value='threesidebarright' ". selected( $value, "threesidebarright" ) ."  >Three Sidebar Right</option>"; 
	echo "<option value='left' ". selected( $value, "left" ) ."  >One Sidebar Left</option>"; 
	echo "<option value='twosidebarleft' ". selected( $value, "twosidebarleft" ) ."  >Two Sidebar Left</option>"; 
	echo "<option value='threesidebarleft' ". selected( $value, "threesidebarleft" ) ."  >Three Sidebar Left</option>"; 
	echo "<option value='nocontent' ". selected( $value, "nocontent" ) ."  >No Content</option>"; 

	echo "</select>";
}	

function create_content_level_ui() { 
	
	lf_register_level_ui( 
							3, 
							'<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-full-width"></div>	
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-three-width"></div>
									<div class="lf-sort-rect-long-quater-width"></div>	
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-half-width"></div>
									<div class="lf-sort-rect-long-quater-width"></div>	
									<div class="lf-sort-rect-long-quater-width"></div>	
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-quater-width-white"></div>	
									<div class="lf-sort-rect-long-quater-width"></div>	
									<div class="lf-sort-rect-long-quater-width"></div>	
									<div class="lf-sort-rect-long-quater-width"></div>	
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-three-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-half-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long">
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-quater-width"></div>
									<div class="lf-sort-rect-long-quater-width-white"></div>
									
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-long-blank">
								</div>
							</div>
							', 
							"<p>This is the content area of your website, this is what displays all your articles and sidebar widgets. Position it anywhere by dragging and doping it, and set it to one of its eight states. </p>
							<ul>
								<li><b>No Sidebar</b> : The Content is full width of the page, no sidebar being displayed means that there will be no widgets visible in the content area. </li>
								<li><b>One Sidebar</b> : Shows one sidebar to the left or right, if you wish to add widgets to sidebars go to  'Apperance->Widgets'.The sidebar being displayed is called 'First Sidebar' in the Widgets page.</li>
								<li><b>Two Sidebars</b> : Shows two sidebars to the left or right.These sidebars being displayed are called 'First Sidebar' & 'Second Sidebar' in the Widgets page. </li>
								<li><b>Three Sidebars</b> : Shows three sidebars to the left or right. The content area in this state is just as wide as a single sidebar. These sidebars being displayed are called 'First Sidebar', 'Second Sidebar' & 'Third Sidebar' in the Widgets page.</li>							
								<li><b>No Content</b> : Completely removes the content area from  the website. </li>
							</ul>",
							true,
							'call_multi_opt_content',
							'content-multisort');
	
}

add_action( "lf_all_your_levels_ui", "create_content_level_ui" );
add_action( "lf_all_your_levels", "content_level" );


// 	Level 5 - Footer 

function footer_level() { 

	function create_footer_level() {
	
		lf_create_level( 4 ); 

	}

	$fifthlevel = array(); 
	
	lf_register_level( $fifthlevel , "create_footer_level" );


	function footer_level_func() {
		
			get_template_part( 'lf-footer' ); 
	
	}
	
	lf_register_level_func( 4, "footer_level_func" );
	
	
	
}	

function call_multi_opt_footer() { 

	$options = get_option('main_options');
	$value = $options["footer_state"];

	echo "<select name='main_options[footer_state]' id='footer-state-multisort' class='multilev-inv-select'>";
	
	echo "<option value='fourwidget' ". selected( $value, "fourwidget" ) .">Full Width Widgets</option>";
	echo "<option value='twowidget' ". selected( $value, "twowidget" ) .">Third Width Widgets</option>";
	echo "<option value='threewidget' ". selected( $value, "threewidget" ) .">Half Width Widgets</option>";
	echo "<option value='onewidget' ". selected( $value, "onewidget" ) .">Quarter Width Widgets</option>";
	echo "<option value='nofooter' ". selected( $value, "nofooter" ) .">No Footer</option>";

	echo "</select>";

}

function create_footer_level_ui() { 
	
	lf_register_level_ui( 
							4, 
							'<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-dark">
									<div class="lf-sort-rect-short-full-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-dark">
									<div class="lf-sort-rect-short-half-width"></div>
									<div class="lf-sort-rect-short-half-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-dark">
									<div class="lf-sort-rect-short-third-width"></div>
									<div class="lf-sort-rect-short-third-width"></div>
									<div class="lf-sort-rect-short-third-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-dark">
									<div class="lf-sort-rect-short-quarter-width"></div>
									<div class="lf-sort-rect-short-quarter-width"></div>
									<div class="lf-sort-rect-short-quarter-width"></div>
									<div class="lf-sort-rect-short-quarter-width"></div>
								</div>
							</div>
							<div class="sort-multilev-part">
								<div class="lf-sort-rect-box-blank">
								</div>
							</div>', 
							"<p>This is the footer of your website. It displays widgets which you put into it. Position it anywhere by dragging and dropping it and set it to one of its five states.</p> 
							<ul>
							<li><b>One widget column</b> : Show only one, full width, widget column in your footer. If you wish to add widgets to the column go to 'Appearance->Widgets', the column being displayed is called 'Footer Widget Column One'.</li> 
							<li><b>Two widget columns</b> : Show two, half width, widget columns in your footer. The the columns being displayed are called 'Footer Widget Column One' & 'Footer Widget Column two'</li>
							<li><b>Three widget columns</b> : Show three widget columns, which are one third the size of your footer. The the columns being displayed are called 'Footer Widget Column One', 'Footer Widget Column Two' and 'Footer Widget Column Three'</li>
							<li><b>Four widget columns</b> : Show four widget columns, which are quarter size, in your footer. The the columns being displayed are called 'Footer Widget Column One', 'Footer Widget Column Two', 'Footer Widget Column Three' &  'Footer Widget Column Four'</li>
							<li><b>No Footer</b> : Completely remove the footer from your website.</li>
							</ul>",
							true,
							'call_multi_opt_footer',
							'footer-multisort' );
	
}

add_action( "lf_all_your_levels_ui", "create_footer_level_ui" );
add_action( "lf_all_your_levels", "footer_level" );


?>