<?php 

/**
 * This be the rewrites section, meaning it rewrites some already used wordpress functions to make them, well better.
 * It doesent really rewrite though just creates a modified new function which is used instead, prefixed "better" or "lf" for short 
 */

/**
 * To be used instead of the regular add_settings_section() func native to wordpress, it adss the callback paramaters 
 * option which will pass paramaters to the callback option, hence allowing greater flexibility with ze code
 * @param  string  $id       THe page id
 * @param  string  $title    The Page title
 * @param  obj/str $callback The callback function 
 * @param  string  $page     The page on which to display the section
 * @param  array   $ca       The "callback args" ( this is the new paramater added over the previous func )
 * @return            		 It creates a new array member in the $wp_settings_section which will be then generated as a section 
 *                           by the do_settings_section(), the callback args are accesed by the 'callargs' paramater in
 *                           the callback function ( note: the callback function is passed a single paramater by do_settings_section();    
 */
function lf_add_settings_section($id, $title, $callback, $page, $ca = null) {

	global $wp_settings_sections;

	if ( !isset($wp_settings_sections) ) 
	{
		$wp_settings_sections = array();
	}

	if ( !isset($wp_settings_sections[$page]) )
	{
		$wp_settings_sections[$page] = array();
	}

	if ( !isset($wp_settings_sections[$page][$id]) )
	{
		$wp_settings_sections[$page][$id] = array();
	}

	$wp_settings_sections[$page][$id] = array( 'id' => $id, 'title' => $title, 'callback' => $callback, 'callargs' => $ca, 'page' => $page );
}


function lf_do_settings_sections($page) {

	global $wp_settings_sections, $wp_settings_fields;

	if ( !isset($wp_settings_sections) || !isset($wp_settings_sections[$page]) )
		return;

	echo '<section class="nav">';

	echo '<ul>';
		
		foreach ( (array) $wp_settings_sections[$page] as $section ) 
		{	
			$page_title = $section['title'];
			$page_id = $section['id'];

			if ( $page_title )
			{
				echo "<li><a href=\"#$page_id\" title=\"Show $page_title options page\">$page_title</a></li>";
			}
		}

	echo '</ul>';

	echo '</section>';

	echo '<section class="holder">';

		foreach ( (array) $wp_settings_sections[$page] as $section ) 
		{

			echo "<div id=\"{$section['id']}-page\"class=\"content\">";

			call_user_func($section['callback'], $section); 

			echo '</div>';


			// If the settings fields are set show settings fields
			if ( isset($wp_settings_fields) 
				 || isset($wp_settings_fields[$page]) 
				 || isset($wp_settings_fields[$page][$section['id']]) )
			{
				echo '<table class="form-table">';
				do_settings_fields($page, $section['id']);
				echo '</table>';
			}	
		}

	echo '</section>';

}

?>