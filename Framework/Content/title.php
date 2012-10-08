<?php

function lf_title() {

	if ( is_page_template('list-page.php') ) {

		$t = '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';

		echo $t;

	} 
	else {

	 	the_title();

	} 

}

?>