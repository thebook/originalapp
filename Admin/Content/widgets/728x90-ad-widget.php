<?php 

class lf_leaderboard_ad_widget extends WP_Widget { 

	function __construct() {
	
		$this->WP_Widget( 'leaderboard_ad_widget', 
						  'Ad : 728 x 90 Size Widget',
						  array(
							'classname' => 'lf-leaderboard-ad-widget',
							'description' => 'A leaderboard ad widget. Dimensions : 728 x 90. Do not put this widget into sidebars which are too small to fit it. Sidebars which are to small to fit it are quarter and half page size sidebars; therefore if a sidebar is larger than half the page size, this widget will display properly. ' ) );
							
	}
	
	function form( $instance ) {
	
		$default = array( 
						'title' => '',
						'ad_code' => '',
						'ad_with_us' => '',
						'ad_cover' => '',
						'ad_text' => 'Your Ad Here',
						'ad_link' => '' );

		$instance = wp_parse_args( $instance, $default );
	
		echo '<p>';
			
		echo '<label for="'. $this->get_field_id( 'title' ) .'">Title : </label>';
			
		echo '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" type="text" value="'. esc_attr(  $instance['title'] ) .'" />';
			
		echo '</p>';
		
		echo '<label for="'. $this->get_field_id( 'ad_code' ) .'">Paste Ad Code : </label>';
		
		echo '<p>';
		
		echo '<textarea id="'. $this->get_field_id( 'id_ad_code' ) .'" name="'. $this->get_field_name( 'ad_code' ) .'" class="widefat">'. esc_attr(  $instance['ad_code'] ) .'</textarea>';
		
		echo '</p>';
		
		echo '<label for="'. $this->get_field_id( 'ad_with_us' ) .'">Have An "Advertise With Us" Link ? </label>';
		
		echo '<p><small>An advertising link will appear bellow your ad. If only this option is checked then the link will appear bellow an ad. If the "Dummy Advert" option is checked, then the advert will be replaced with a dummy one.</small></p>';
			
		echo '<p>';
		
		echo '<input type="checkbox" id="'. $this->get_field_id( 'id_ad_with_us' ) .'" name="'. $this->get_field_name( 'ad_with_us' ) .'" value="yes" '. checked( $instance['ad_with_us'], 'yes', false ) .' />';
		
		echo '</p>';	
		
		echo '<label for="'. $this->get_field_id( 'ad_cover' ) .'">Use Dummy Advert ? </label>';
		
		echo '<p><small>A dummy advert is what you would use when you have no real advert and want to show off advert space on your website to potential advertisers.</small></p>';
		
		echo '<p>';
		
		echo '<input type="checkbox" id="'. $this->get_field_id( 'id_ad_cover' ) .'" name="'. $this->get_field_name( 'ad_cover' ) .'" value="yes" '. checked( $instance['ad_cover'], 'yes', false ) .' />';
		
		echo '</p>';
		
		echo '<label for="'. $this->get_field_id( 'ad_text' ) .'">"Advertise With Us" Text : </label>';
		
		echo '<p>';
		
		echo '<input type="text" id="'. $this->get_field_id( 'id_ad_text' ) .'" name="'. $this->get_field_name( 'ad_text' ) .'" class="widefat" value="'. $instance['ad_text'] .'" />';
		
		echo '</p>';
		
		echo '<label for="'. $this->get_field_id( 'ad_link' ) .'">"Advertise With Us" Link : </label>';
		
		echo '<p>';
		
		echo '<input type="text" id="'. $this->get_field_id( 'id_ad_link' ) .'" name="'. $this->get_field_name( 'ad_link' ) .'" class="widefat" value="'. $instance['ad_link'] .'" />';
		
		echo '</p>';
		
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = array( 
						'title' => '',
						'ad_code' => '',
						'ad_with_us' => '',
						'ad_cover' => '',
						'ad_text' => '',
						'ad_link' => '' );

		$instance = wp_parse_args( $new_instance, $instance );

		return $instance;
		
	}
		
	function widget( $args, $instance ) {
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		echo $before_title . $title . $after_title;
		
		lf_ad_widget_display( $instance, '728x90' );
		
		echo $after_widget;
		
	}

} 

register_widget( 'lf_leaderboard_ad_widget' );

?>