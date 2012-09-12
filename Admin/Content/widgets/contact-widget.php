<?php 

function lf_contact_widget_display( $opts ) {

	if (  $opts['mobile'] != null ) {

		echo '<p class="lf-meta-text" ><label>Mobile : <span class="lf-meta-highlight"> '. $opts['mobile'] .'</span></label></p>';
	
	}
	
	if ( $opts['home_phone'] != null ) {
	
		echo '<p class="lf-meta-text" ><label>Home Phone :  <span class="lf-meta-highlight"> '. $opts['home_phone'] .'</span></label></p>';
	
	}
	
	if ( $opts['email'] != null ) {
	
		echo '<p class="lf-meta-text" ><label><span class="lf-meta-highlight">'. $opts['email'] .'</span></label></p>';
	
	}
	
	if ( $opts['address'] != null ) {
	
		echo '<p class="lf-meta-text" ><label>Address : <span class="lf-meta-highlight">'. $opts['address'] .'</span></label></p>';
	
	}
	
	if ( $opts['last_name'] != null ) {
	
		echo '<p class="lf-meta-text" ><label><i>' . $opts['first_name'] . ' ' . $opts['last_name'] .'</i></label></p>';
	
	}
	
} 

class lf_contact_widget extends WP_Widget { 

	function __construct() {
	
		$this->WP_Widget( 'lf_contact', 
						  'White Whale Contact',
						  array(
							'classname' => 'lf-contact-widget',
							'description' => 'A widget which will display your contact details.' ),
						  array(
							'height' => 300,
							'width' => 300 ));
							
	}
	
	function form( $instance ) {
	
		$default = array( 
						'title' => '',
						'mobile' => '',
						'home_phone' => '',
						'email' => '',
						'address' => '',
						'first_name' => '',
						'last_name' => '' ); 
		
		$instance = wp_parse_args( $instance, $default );
	
		$original = array( 
						'title' => 'Title :',
						'mobile' => 'Mobile :',
						'home_phone' => 'Home Phone',
						'email' => 'E-mail :',
						'address' => 'Adress :',
						'first_name' => 'First Name :',
						'last_name' => 'Last Name :' ); 
	
		foreach ( $original as $key => $value ) {
		
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( $key ) .'">'. $value .'</label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( $key ) .'" name="'. $this->get_field_name( $key ) .'" type="text" value="'. esc_attr(  $instance[$key] ) .'" />';
			
			echo '</p>';
		
		}
		
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = array( 
						'title' => '',
						'mobile' => '',
						'home_phone' => '',
						'email' => '',
						'address' => '',
						'first_name' => '',
						'last_name' => '' ); 
		
		$instance = wp_parse_args( $new_instance, $instance );

		return $instance;
		
	}
		
	function widget( $args, $instance ) {
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		echo $before_title . $title . $after_title;
		
		lf_contact_widget_display( $instance );
		
		echo $after_widget;
		
	}

} 

register_widget( 'lf_contact_widget' );

?>