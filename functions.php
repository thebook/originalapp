<?php 

define('TEXTDOMAIN', 'liquidflux');
define('ADMINPATH', TEMPLATEPATH . '/Admin' );
define('FRAMEWORK', TEMPLATEPATH . '/Framework' );
define('FRAMEWORKURI', get_template_directory_uri() . '/Framework' );
define('ADMINURI', get_template_directory_uri(). '/Admin');
define('LAYOUTPATH', TEMPLATEPATH. '/Layout');
define('LAYOUTURI',  get_template_directory_uri(). '/Layout');
define('JSPATH', get_template_directory_uri() . '/Js');
define( 'COREPATH', TEMPLATEPATH . '/Core' );
define( 'COREURI', get_template_directory_uri() . '/Core' );


function lf_theme_update() { 

	$main_opt = get_option( 'main_options' );
	 
	if ( isset( $main_opt['input_envanto_user_name'], $main_opt['input_envanto_key'] ) ) {
	
		include_once( ADMINPATH . '/Update/class-envato-wordpress-theme-upgrader.php' );
		
		$update = new Envato_WordPress_Theme_Upgrader( $main_opt['input_envanto_user_name'], $main_opt['input_envanto_key'] );
		
		$update->check_for_theme_update(); 
		
		$update->upgrade_theme();
				
	}
	
}

add_action('admin_init', 'lf_theme_update' ); 

function lf_whitespace( $string ) { 
	
		if ( $string == '' ) { 
		
			return false;
		
		}
		
		elseif ( ctype_space( $string ) ) {
		
			return false;
		
		}
		
		else { 
		
			return true;
		
		}
	
}

function lf_theme_opt_section_callback() {

	echo '<div class="form-table">';
	
	lf_create_option( 
		'text',
		'main_options[input_envanto_user_name]',
		'input_envanto_user_name_opt',
		'main_options',
		'input_envanto_user_name',
		'<p>This is your envanto marketplace user name. In this case it should be the themeforest user name which you use to log into themeforest in order to purchase items.</p> 
		<p>Note: if you have several themforest accounts you should use the account name of the account with which you have bought this theme.</p>',
		'Input Marketplace Username' );
		
	lf_create_option( 
		'text',
		'main_options[input_envanto_key]',
		'input_envanto_key_opt',
		'main_options',
		'input_envanto_key',
		'<p>Enterthe secret key which you generate for your account.</p>
		<p>To generate the secret key, log into your themeforest account, go to <b>"My Settings"</b>; underneath your avatar in <b>"My Settings"</b> section you will see a list of sub sections with small icons to the left of them.</p>
		<p>At the very bottom of this list you will see a sub section with a key icon, which is called <b>"API Keys"</b>. Click on this sub section, then you will see a new view show up, with a button which says <b>"Generate Api Key"</b>, click this button to generate your key.</p>
		<p>After your key is generated copy and paste it into this input field and click save. </p>',
		'Input Your Secret Key' );
	
	echo '</div>';

}


function liquidflux_comments ($comment, $args, $depth) {	
	
	$GLOBALS['comment'] = $comment; 
	
	extract( $args, EXTR_SKIP );
	
?>
   			
	<li class="lf-comment-article-wrap <?php echo $depth; ?>">	
			
		<div class="lf-comment-article-inner" id="comment-wrap<?php comment_ID() ?>">
		
			<div class="lf-comment-article-inner-wrap"> 
			
			<div id="comment-<?php comment_ID(); ?>" class="lf-comment-article-avatar-wrap">
										
					<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
																										
			</div>	
	
			<div class="lf-comment-article-text">
			
				<address class="lf-comment-article-author-link"> 
											
					<?php echo comment_author_link(); ?> 
												
				</address>
														
				<time class="lf-comment-article-time-meta" datetime="<?php printf( __('%1$s | %2$s'), get_comment_date('d m Y'), get_comment_time() ) ?>" pubdate>
													
					<?php printf( __('%1$s at %2$s'), get_comment_date(), get_comment_time() ) ?>
													
				</time>
				
				<span class="lf-comment-links-wrap">
					&#183; 
<?php 

					comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => $args['reply_text'] )));
					
					edit_comment_link( __('c'),'  ','');
					
?>
	
				</span>
							
				<div class="lf-comment-article-comment">
																						
					<?php comment_text(); ?>
																												
				</div>
																	
			</div>
		
		</div>
		
	</div>
	

	
<?php	}	

function liquid_navigation () { 

	register_nav_menu ('true_navigation', 'True Navigation');

}

add_action('init', 'liquid_navigation');
								
															
function liquidflux_script_reg () { 
															
	wp_deregister_script ('jquery');
																
	wp_register_script (
						'jquery', 
						COREURI . '/Js/jquery.js', 
						array(), 
						'1.7.1', 
						true );
						
	wp_register_script ('j-ease', 
						COREURI . '/Js/jquery.easing.min.js', 
						array( 'jquery' ), 
						'1.3', 
						true );

	wp_register_script ('jplayer', 
						COREURI . '/Js/jquery.jplayer.min.js', 
						array( 'jquery' ), 
						'2.2', 
						true );
						
	wp_register_script ( 'lf-functions',
						COREURI . '/Js/lf-functions.js',
						array( 'jquery', 'j-ease' ),
						'1',
						true );

	wp_register_script ( 'slimbox',
						COREURI . '/Js/slimbox2.js',
						array( 'jquery' ),
						'2.0',
						true );
	
	wp_register_script( 'flexslider', 
						FRAMEWORKURI . '/Slider/scripts/flexslider-min.js',
						array( 'jquery', 'j-ease' ),
						'2.1',
						true );

	wp_enqueue_script  ('lf-functions');

	wp_enqueue_script  ('jplayer');

	wp_enqueue_script  ('slimbox');

	wp_enqueue_script  ('flexslider');
																																								
}

add_action('wp_enqueue_scripts', 'liquidflux_script_reg');

add_theme_support( 'post-thumbnails' );

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'video', 'audio', 'link' ) );


function force_send($args){	

	$args['send'] = true; 
	
	return $args;
	
}

add_filter( 'get_media_item_args', 'force_send' );


function lf_add_styles () { 
	
	//wp_enqueue_style( 'core-style', COREURI . '/core-css.css' );
	
	wp_enqueue_style( 'lfstyle', COREURI . '/sass/style-core.css' );
	
	wp_enqueue_style( 'core-style-media-queries', COREURI . '/core-css-media-queries.css' );

}

add_action( 'wp_enqueue_scripts', 'lf_add_styles' );


include( LAYOUTPATH . '/layouts-core.php');
include( LAYOUTPATH . '/layouts-core-admin.php');
include( ADMINPATH . '/lf-editable-style-setup.php' );
include( ADMINPATH . '/LF-core-admin-setup.php');
include( 'layouts-registration.php' );


function lf_arragment( $postid ) { 
						
	global $the_one_array;
						
	$order 			= layout_finder( 'main_options', 'main_meta', $postid, 'chosen_layout', 'layouts' );
	$neworder 		= array();
	$count_one  	= count( $the_one_array );
	$count_two 		= count( $order );
	
	
	
	if ( $order != null ) {
						
	foreach ( $order as $value ) { 
						
		$trimvalue = trim( $value ); array_push( $neworder, $trimvalue ); 
							
	}
	
	$neworder = array_flip($neworder);
	
	ksort( $neworder );
	
	}
						
	if ( $order != null && $count_one == $count_two ) {
						
		$the_one_array 	= array_combine( $neworder, $the_one_array  );  
						
	}
							
} 

?>