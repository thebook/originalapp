<?php 


/**
 * Function checks if well known seo plugins are being used( this list can be expanded  )
 * @return bol Returns false if none of the plugins are being used, true otherwise.
 */
function lf_other_use_seo() {

	include_once( ABSPATH .'wp-admin/includes/plugin.php' );
	
	if( is_plugin_active('headspace2/headspace.php') ) return true;
	if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
	if( is_plugin_active('wordpress-seo/wp-seo.php') ) return true;
	
	return false;
}

/**
 * Functions filters though wp_title(), by taking checking if there is a seo title set, if so it uses it.
 * 	
 * @param  string? $title Paramater is passed through the filter, it is the original title 
 * @return string        Returns the modified seo title or the original title set in wp options as well as website name
 */
function lf_title_seo( $title ) { 

	global $post;

	$name = ' | ' . get_bloginfo( 'name' );

	if ( $post and !lf_other_use_seo() ) {

		$id = ( ( is_home() or is_archive() or is_search() ) ? get_option( 'page_for_posts' ) :  $post->ID );

		$me = get_post_meta( $id, 'main_meta', true );

		$st = $me['post_seo_title'];

		if ( $st !== '' ) { 

			return $st . $name;

		}
	}
	else { 

		return $title . $name;
	}
}

add_filter( 'wp_title', 'lf_title_seo', 15 );

/**
 * Echos the website description, if a seo description is set it echos that instead
 * 
 * @return string The post/page or website description
 */
function lf_desc_seo() {

	global $post;

	if ( $post and !lf_other_use_seo() ) {

		$id = ( ( is_home() or is_archive() or is_search() ) ? get_option( 'page_for_posts' ) :  $post->ID );

		$me = get_post_meta( $id, 'main_meta', true );

		$sd = $me['post_seo_description'];

		if ( $sd !== '' ) {

			echo "<meta name='description' content='". esc_html(strip_tags( $sd ) ) ."' />\n";
			
		}
		else { 

			echo "<meta name='description' content='". get_bloginfo( 'description' ) ."' />\n";
		}
	}
	else { 

		echo '<meta name="description" content="'. get_bloginfo( 'description'  ) .'" />' . "\n";

	}
}

add_action( 'lf_head_hook', 'lf_desc_seo' );

/**
 * Echoes the keywords meta. if no keywords are specified it does not echo anything
 * 
 * @return string Meta element
 */	
function lf_key_seo() {

	global $post;

	if ( $post and !lf_other_use_seo() ) {

		$id = ( ( is_home() or is_archive() or is_search() ) ? get_option( 'page_for_posts' ) :  $post->ID );

		$me = get_post_meta( $id, 'main_meta', true );

		$sk = $me['post_seo_key'];

		if ( $sk !== '' ) {

			echo "<meta name='keywords' content='". esc_html(strip_tags( $sk ) ) ."' />\n";	

		}
	}
}

add_action( 'lf_head_hook', 'lf_key_seo' );

/**
 * Echoes a meta element for robots, showing weather to follow and index or not, because of set defaults in the option,
 * it will echo "index, follow" by default
 * 
 * @return string Meta element
 */
function lf_meta_seo() {

	global $post;

	if ( $post and !lf_other_use_seo() ) {

		$id = ( ( is_home() or is_archive() or is_search() ) ? get_option( 'page_for_posts' ) :  $post->ID );

		$me = get_post_meta( $id, 'main_meta', true );

		$index  = $me['post_seo_robots_index'];

		$follow = $me['post_seo_robots_follow'];

		echo "<meta name='robots' content='". $index ."," . $follow ."' />\n";

	}

}

add_action( 'lf_head_hook', 'lf_meta_seo' );

?> 