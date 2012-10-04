<?php

function _lf_more_text($link = false, $n = 'Read More') {

	$mo = get_option( 'main_options' );
	
	$rm = $mo['more_button_read_more_text'];

	$n  = ( isset($rm) ? $rm : $n );

	$n  = ( $link ? '<a href="'.get_permalink().'" title="'.get_the_title().'">'.$n.'</a>' : $n );

	return $n = "<p class='lf-button'>$n</p>";


}


function _lf_get_content() {

	$c = get_the_content( _lf_more_text() );

	$c = str_replace(']]>', ']]&gt;', $c );

	return $c;

}


function _lf_is_more($c) {

	$c = ( strpos( $c, 'id="more-' ) !== false ? true : false );

	return $c;

}


function _lf_more_cut($c) {

	$cut = strpos( $c, 'id="more-' );	

	return $c = ( !is_page_template('list-page.php') ? $c : _lf_cut_excerpt( $c, $cut ) );

}


function _lf_cut_excerpt($e, $l) {

	if ( mb_strlen( $e ) > $l ) {

 		$ec = mb_substr( $e, 0, $l );
 		$ee = explode( ' ', $e );
 		$et = -( mb_strlen( $ee[ count( $ee ) -1 ] ) );

 		$e = ( $et < 0 ? mb_substr( $ec, 0, $et ) : $ec );

 		return $e . _lf_more_text( true );

 	}
 	else {

 		return $e;

 	}

}


function lf_excerpt() {

	$l = 150; 
	
 	$e = ( has_excerpt() ? get_the_excerpt() : _lf_get_content() ); 

	echo $e = ( _lf_is_more( $e ) ? _lf_more_cut($e) : _lf_cut_excerpt( $e, $l ) );

}


function lf_content() {

	( is_single() and !is_page_template('list-page.php') ) ? the_content() : lf_excerpt();

}

?>