<?php 

function lf_content_reg_sidebars() { 

	register_sidebar( 
		array(
			'name' => __( 'First Sidebar', 'liquidflux' ),
			'id' => 'lf-content-sidebar-first',
			'before_widget' => '<div id="%1$s" class="lf-core-content-aside-widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Second Sidebar', 'liquidflux' ),
			'id' => 'lf-content-sidebar-second',
			'before_widget' => '<div id="%1$s" class="lf-core-content-aside-widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Default Single Post Widget Area', 'liquidflux' ),
			'id' => 'lf-content-default-single-widget-area',
			'before_widget' => '<div id="%1$s" class="lf-article-widget-wrap %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-article-widget-name">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar One', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-first',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Two', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-second',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Three', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-third',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Four', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-fourth',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Five', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-fifth',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Six', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-sixth',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Seven', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-seventh',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );
			
	register_sidebar( 
		array(
			'name' => __( 'Homepage Sidebar Eight', 'liquidflux' ),
			'id' => 'lf-homepage-sidebar-eight',
			'before_widget' => '<div id="%1$s" class="lf-resp-widget-area %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3 class="lf-core-content-aside-widget-h3">',
			'after_title' => '</h3>', ) );

}

add_action( "widgets_init", "lf_content_reg_sidebars" );

// Include all widget essential files 

include( ADMINPATH . '/Content/widgets/contact-widget.php' );

include( ADMINPATH . '/Content/widgets/recent-posts-widget.php' );

include( ADMINPATH . '/Content/widgets/twitter-widget.php' );

include( ADMINPATH . '/Content/widgets/ads-widget.php' );

?>