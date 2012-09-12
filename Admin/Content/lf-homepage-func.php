<?php 

function lf_homepage_func() { ?>

<div class="LF-main-options-wrapper">
	<div>
		
		<div>							
			<form name="main_options_form" action="options.php" method="post" class="main-options-form" >
			
				<div class="main-form-tabs">
											
					<div class="main-options-tab-nav-hook"></div>
													
					<div class="lf-main-options-save-button-wrap">
											
						<input type="submit" class="lf-main-options-save-button" name="submit" value="Save" />
														
						<div class="LF-option-inv-desc"> 
											
							<p> The Save Button, which... well... saves your options. </p>
												
						</div>
											
					</div>
																
					<div class="main-options-tiny-info-box">Press the "+" button on your keyboard to open help.</div>
													
					<div class="main-options-info-box"></div>
			
		<?php 

			settings_fields('homepage_options');
			 
			do_settings_sections('lf_homepage_setup');
			 
		?>

				</div>
			
			</form>
			
		</div>
		
	</div>
	
</div>

<?php 

}

function lf_create_home_widget_area( $array = null, $optone = null, $opttwo = null, $sidebarname = null ) { 

	$opts = get_option( $array );
	
	if ( is_array( $opts ) ) {
	
		if ( isset( $opts[$optone], $opts[$opttwo] ) ) {
	
			$optone = $opts[$optone];
			
			$opttwo = $opts[$opttwo];
			
			if ( $optone == 'active' ) {

			echo '<div style="width: '. $opttwo .';" class="lf-resp-aside-wrap">';

			dynamic_sidebar( $sidebarname );

			echo '</div>';
			
			}
		
		}
	
	}

}

function homepage_setup_callback_section() { 

	echo '<div class="form-table">';
	
	lf_create_option( 
		'select',
		'homepage_options[home_header_state]',
		'home_header_state_opt',
		'homepage_options',
		'home_header_state',
		'<p>Chose the state of your homepage header. You can have a leaderboard size advert displayed to the left, right, top or bottom of your website name/ or logo, remove the header.</p>',
		'Use Footer In Homepage',
		array( 'justheader', 'adleft', 'adright', 'adtop', 'adbot', 'noheader' ),
		array( 'Plain Header', 'Leaderboard Ad Left', 'Leaderboard Ad Right', 'Leaderboard Ad Top', 'Leaderboard Ad Bottom', 'Remove Header',  ) );
		
		
	lf_create_option( 
		'select',
		'homepage_options[home_footer_use]',
		'home_footer_use_opt',
		'homepage_options',
		'home_footer_use',
		'<p>Display a footer in your homepage; the footer displayed will have the same number of widget coluns as set default in the layouts section.</p>',
		'Use Footer In Homepage',
		array( 'activate', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );

	lf_create_option( 
			'divider', 
			'Homepage Sidebar One',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'0px' ); 
	
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_one_switch]',
		'home_sidebar_one_switch_opt',
		'homepage_options',
		'home_sidebar_one_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar One',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_one_widths]',
		'home_sidebar_one_widths_opt',
		'homepage_options',
		'home_sidebar_one_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Two',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_two_switch]',
		'home_sidebar_two_switch_opt',
		'homepage_options',
		'home_sidebar_two_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Two',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_two_widths]',
		'home_sidebar_two_widths_opt',
		'homepage_options',
		'home_sidebar_two_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Three',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_three_switch]',
		'home_sidebar_three_switch_opt',
		'homepage_options',
		'home_sidebar_three_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Three',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_three_widths]',
		'home_sidebar_three_widths_opt',
		'homepage_options',
		'home_sidebar_three_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Four',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_four_switch]',
		'home_sidebar_four_switch_opt',
		'homepage_options',
		'home_sidebar_four_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Four',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_four_widths]',
		'home_sidebar_four_widths_opt',
		'homepage_options',
		'home_sidebar_four_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Five',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_five_switch]',
		'home_sidebar_five_switch_opt',
		'homepage_options',
		'home_sidebar_five_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Five',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_five_widths]',
		'home_sidebar_five_widths_opt',
		'homepage_options',
		'home_sidebar_five_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Six',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_six_switch]',
		'home_sidebar_six_switch_opt',
		'homepage_options',
		'home_sidebar_six_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Five',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_six_widths]',
		'home_sidebar_six_widths_opt',
		'homepage_options',
		'home_sidebar_six_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Seven',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_seven_switch]',
		'home_sidebar_seven_switch_opt',
		'homepage_options',
		'home_sidebar_seven_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Five',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_seven_widths]',
		'home_sidebar_seven_widths_opt',
		'homepage_options',
		'home_sidebar_seven_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
		
	lf_create_option( 
			'divider', 
			'Homepage Sidebar Eight',
			'<p>To add widgets to the sidebar, go to <b>"Apperance->Widgets"</b> and find the sidebar with the same name in the widgets section.</p>
			<p><b>Note :</b> Certain widgets will need sidebars to be greater than a certain width, in order to display properly.</p>
			<p>For example : </p>
			<ul>
			<li>A <b>"300x250 Ad"</b> Widget will need the sidebar to be above 25% in order to display properly. </li>
			<li>This is a thing to keep in mind when assigning certain widgets to smaller sidebars.</li>
			</ul>',
			'24px' ); 
			
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_eight_switch]',
		'home_sidebar_eight_switch_opt',
		'homepage_options',
		'home_sidebar_eight_switch',
		'<p>Select <b>Use</b> to show all of the widgets within that Homepage Sidebar. </p>
		<p>Sometimes you may want to remove all the widgets from a certain Homepage Sidebar, with the option of adding them back in again when you desire. This option enables you do to that easily. </p>',
		'Use Homepage Sidebar Five',
		array( 'active', 'dontuse' ),
		array( 'Use', 'Dont Use' ) );
		
	lf_create_option( 
		'select',
		'homepage_options[home_sidebar_eight_widths]',
		'home_sidebar_eight_widths_opt',
		'homepage_options',
		'home_sidebar_eight_widths',
		'<p>You Homepage Sidebar
		can be various widths, here you can choose the widths you want it to be. </p>
		<p>Choosing widths can provide different and interesting arrangements of Sidebars; </p>
		<p>For example : </p>
		<p>If a sidebar is 50% and two other sidebars are both 25% width, then the sidebars will line up next to each other; whilst any other active sidebars will be pushed a row bellow those.</p>',
		'Set This Sidebars Width',
		array( '25%', '33%', '50%', '66%', '75%', '100%'  ),
		array( '25%', '33%', '50%', '66%', '75%', '100%' ) );
	
	echo '</div>';

}

function lf_add_homepage_options() { 

	add_submenu_page( 	'liquidfluxadmin', 
						'Homepage Setup', 
						'Homepage Setup', 
						'manage_options', 
						'lf_homepage_setup',
						'lf_homepage_func' );
						
	register_setting(	'homepage_options', 	
						'homepage_options' ); 
						
	add_settings_section(
						'main_options_homepage_setup_section', 	
						'Sidebars', 
						'homepage_setup_callback_section', 	
						'lf_homepage_setup' ); 
						
}

add_action( 'admin_menu', 'lf_add_homepage_options' );




?>