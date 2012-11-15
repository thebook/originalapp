<?php

/**
* A helper class which handles content text generation
*/
class produce_helper extends helper_featured_image
{

	public function _lf_more_text ($link = false, $n = 'Read More') 
	{
		$mo = get_option( 'main_options' );
		
		$rm = $mo['more_button_read_more_text'];

		$n  = ( isset($rm) ? $rm : $n );

		$n  = ( $link ? '<a href="'.get_permalink().'" title="'.get_the_title().'">'.$n.'</a>' : $n );

		return $n = "<p class='lf-button'>$n</p>";
	}


	public function _lf_get_content () 
	{

		$c = get_the_content( $this->_lf_more_text() );

		$c = str_replace(']]>', ']]&gt;', $c );

		return $c;

	}


	public function _lf_is_more ($c) 
	{

		$c = ( strpos( $c, 'id="more-' ) !== false ? true : false );

		return $c;

	}


	public function _lf_more_cut ($c) 
	{

		$cut = strpos( $c, 'id="more-' );	

		return $c = ( !is_page_template('list-page.php') ? $c : $this->_lf_cut_excerpt( $c, $cut ) );

	}


	public function _lf_cut_excerpt ($e, $l, $b = true) 
	{

		if ( mb_strlen( $e ) > $l ) {

	 		$ec = mb_substr( $e, 0, $l );
	 		$ee = explode( ' ', $e );
	 		$et = -( mb_strlen( $ee[ count( $ee ) -1 ] ) );

	 		$e = ( $et < 0 ? mb_substr( $ec, 0, $et ) : $ec );

	 		$e = ( $b ? ( $e . $this->_lf_more_text( true ) ) : $e );

	 		return $e;

	 	}
	 	else {

	 		return $e;
	 	}
	}


	public function lf_excerpt () 
	{

		$l = 150; 
		
	 	$e = ( has_excerpt() ? get_the_excerpt() : $this->_lf_get_content() ); 

		echo $e = ( $this->_lf_is_more( $e ) ? $this->_lf_more_cut($e) : $this->_lf_cut_excerpt( $e, $l ) );

	}


	public function lf_content () 
	{

		( is_single() and !is_page_template('list-page.php') ) ? the_content() : $this->lf_excerpt();

	}

	public function lf_title() 
	{
		if ( is_page_template('list-page.php') ) {

			echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';

		} 
		else {

		 	the_title();

		} 

	}
}
?>