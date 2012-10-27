<?php 

/**
* A registration class, regigstrate scripts and styles
*/
class lf_registrate_scripts
{
	
	function __construct()
	{
		$this->body();
		$this->admin();
	}

	public function register_css_admin ()
	{	
		// The main admin style
		wp_register_style(
			'lf-admin',
			FRAMEWORKURI .'/CSS/style-admin.css',
			array('thickbox'),
			'1.0' );

		global $pagenow, $post_type;

		if (  $pagenow == 'admin.php' 
		  || $pagenow == 'post-new.php' && $post_type == 'lf_slide'
		  || $pagenow == 'post.php'     && $post_type == 'lf_slide'
		  || $pagenow == 'post.php'     && $post_type == 'page' 
		  || $pagenow == 'post-new.php' && $post_type == 'page'
		  || $pagenow == 'post.php'     && $post_type == 'post' 
		  || $pagenow == 'post-new.php' && $post_type == 'post' )
		{
			wp_enqueue_style('lf-admin');
		}
	}

	public function register_script_admin ()
	{	
		global $pagenow, $post_type;
		// Handles post format uploads and gallery aswell as hiding and showing fileds
		wp_register_script(
			'post-ui',  
			trailingslashit( get_template_directory_uri() ) . '/Admin/assets/post-ui.js', 
			array(
				'thickbox', 
				'media-upload'), 
			'0.8', 
			false );
		// Handles slide addition and removal for the slider post type
		wp_register_script(
			'clone-js',
			trailingslashit( get_template_directory_uri() ) . 'Framework/Slider/scripts/remove.js', 
			'',
			'1',
			false );
		// Color picker for admin options
		wp_register_script(
			'color-picker', 
			trailingslashit( get_template_directory_uri() ) . '/Admin/assets/colorpicker/colorPicker.js', 
			'', 
			'9.1', 
			false );

		if ( $pagenow == 'post.php' && $post_type == 'post' or $post_type == 'lf_slide' || 
		 	 $pagenow == 'post-new.php' && $post_type == 'post' or $post_type == 'lf_slide' )
		{
			wp_enqueue_script('clone-js');
			wp_enqueue_script('post-ui');
		}

		if (  $pagenow == 'admin.php' ) 
		{
			wp_enqueue_script('color-picker');
		}
	}

	public function register_script ()
	{
		wp_register_script (
			'jquery', 
			COREURI . '/Js/jquery.js', 
			array(), 
			'1.7.1', 
			true );
							
		wp_register_script (
			'j-ease', 
			COREURI . '/Js/jquery.easing.min.js', 
			array( 'jquery' ), 
			'1.3', 
			true );

		wp_register_script (
			'jplayer', 
			COREURI . '/Js/jquery.jplayer.min.js', 
			array( 'jquery' ), 
			'2.2', 
			true );
							
		wp_register_script ( 
			'lf-functions',
			COREURI . '/Js/lf-functions.js',
			array( 'jquery', 'j-ease' ),
			'1',
			true );

		wp_register_script ( 
			'slimbox',
			COREURI . '/Js/slimbox2.js',
			array( 'jquery' ),
			'2.0',
			true );
		
		wp_register_script( 
			'flexslider', 
			FRAMEWORKURI . '/Slider/scripts/flexslider-min.js',
			array( 'jquery', 'j-ease' ),
			'2.1',
			true );

		wp_enqueue_script  ('lf-functions');
		wp_enqueue_script  ('jplayer');
		wp_enqueue_script  ('slimbox');
		wp_enqueue_script  ('flexslider');
	}

	public function register_css ()
	{
		wp_register_style( 
			'lfstyle', 
			COREURI . '/sass/style-core.css' );

		wp_enqueue_style( 'lfstyle' );
	}

	public function admin ()
	{	
		add_action( 'admin_enqueue_scripts', array( $this, 'register_script_admin' ) );
		add_action( 'admin_head', array( $this, 'register_css_admin' ) );				
	}

	public function body ()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'register_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ) );
	}
}

?>