<?php

function lf_twitter_widget_display( $opt ) { 

	$main_opt = get_option( 'main_options' );

	echo '<script src="http://widgets.twimg.com/j/2/widget.js"></script>';
	echo '<script>
	new TWTR.Widget({
	  version: 2,
	  type: "' . $opt['widget_state'] .'",
	  search : "' . $opt['search_query'] . '",
	  title : "' . $opt['search_query'] . '",
	  subject : "' . $opt['search_title'] . '",
	  rpp: '. $opt['tweet_number'] .',
	  interval: 6000,
	  footer : "",
	  width: "auto",
	  height: "auto",
	  theme: {
	    shell: { 
		background:';
	
	if ( $opt['background_state'] == "color" ) {
	
		echo '"'. $opt['background_color'] .'", ';
		
	}
	
	else {
	
		echo '"transparent", ';
	
	}
	echo 'color: "'. $opt['text_color'] .'" },
		 tweets: {
	       background: "transparent",
		   color : "'.  $opt['text_color'] .'",
		   links: "'.  $opt['text_color'] .'" 
			}  
		},
	  features: {
	    scrollbar: false,
	    loop: false,
	    live: '. $opt['looping'] .',
	    hashtags: true,
	    timestamp: true,
	    avatars: '. $opt['show_avatars'] .' ,
	    behavior: "default"
	  }
	}).render()';
	
	if ( $opt['widget_state'] == "profile"
		|| $opt['widget_state'] == "favs" ) {
	
		echo '.setUser( "' . $opt['user_name'] .'" ).start();';
		
	}
	
	else { 
	
		echo '.start();';
	
	}
	
	echo '</script>';

}

class lf_twitter_widget extends WP_Widget { 

	function __construct() {
	
		$this->WP_Widget( 'lf_twitter_widget', 
						  'White Whale Twtitter Widget',
						  array(
							'classname' => 'lf-twitter-widget',
							'description' => 'Choose whether to show your personal tweets, favorites, or tweets relating to a search term which you type in. The look of the widget can be changed by setting colors through the color picker, as well as being able to hide avatars, loop tweets, and choosing how many tweets to display.' ),
						  array(
							'height' => 500,
							'width' => 500 ));
							
	}
	
	function form( $instance ) {
	
		$default = array( 
						'title' => '',
						'user_name' => '', 
						'tweet_number' => '',
						'widget_state' => '',
						'looping' => '',
						'background_state' => '',
						'background_color' => '', 
						'text_color' => '' ); 
		
		$instance = wp_parse_args( $instance, $default );
	
		echo '<p>';
				
		echo '<label for="'. $this->get_field_id( 'title' ) .'">Title : </label>';
			
		echo '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" value="' . esc_attr(  $instance['title'] ) . '" >';
			
		echo '</p>';
	
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'background_color' ) .'">Background Color:</label>';
			
		echo '<input class="widefat" id="'. $this->get_field_id( 'background_color' ) .'" name="'. $this->get_field_name( 'background_color' ) .'" onclick="colorPicker(event)" value="' . esc_attr(  $instance['background_color'] ) . '" >';
			
		echo '</p>';
		
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'text_color' ) .'">Text Color:</label>';
			
		echo '<input class="widefat" id="'. $this->get_field_id( 'text_color' ) .'" name="'. $this->get_field_name( 'text_color' ) .'" onclick="colorPicker(event)" value="' . esc_attr(  $instance['text_color'] ) . '" >';
			
		echo '</p>';
	
		echo '<p>';
			
		echo '<label for="'. $this->get_field_id( 'widget_state' ) .'">Widget Type : </label>';
		
		echo '<select class="widefat" id="'. $this->get_field_id( 'widget_state' ) .'" name="'. $this->get_field_name( 'widget_state' ) .'" >';
		
		echo '<option value="profile" '. selected( $instance['widget_state'], 'profile', true ) .' >Profile</option>';
		
		echo '<option value="search" '. selected( $instance['widget_state'], 'search', true ) .' >Search</option>';
		
		echo '<option value="favs" '. selected( $instance['widget_state'], 'favs', true ) .' >Favorites </option>';
		
		echo '</select>';
		
		echo '</p>';
		
		if ( $instance['widget_state'] == 'search' ) {
		
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'search_query' ) .'">Search For : </label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( 'search_query' ) .'" name="'. $this->get_field_name( 'search_query' ) .'" value="' . esc_attr(  $instance['search_query'] ) . '" >';
			
			echo '</p>';	
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'search_title' ) .'">Search Title : </label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( 'search_title' ) .'" name="'. $this->get_field_name( 'search_title' ) .'" value="' . esc_attr(  $instance['search_title'] ) . '" >';
			
			echo '</p>';
		
		}
		
		else { 
		
			echo '<p>';
		
			echo '<label for="'. $this->get_field_id( 'user_name' ) .'">User Name :</label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( 'user_name' ) .'" name="'. $this->get_field_name( 'user_name' ) .'" value="' . esc_attr(  $instance['user_name'] ) . '" >';
			
			echo '</p>';
		
		}
		
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'tweet_number' ) .'">Number of Tweets : </label>';
			
		echo '<input class="widefat" id="'. $this->get_field_id( 'tweet_number' ) .'" name="'. $this->get_field_name( 'tweet_number' ) .'" value="' . esc_attr(  $instance['tweet_number'] ) . '" >';
			
		echo '</p>';
		
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'looping' ) .'">Loop Tweets : </label>';
		
		echo '<select class="widefat" id="'. $this->get_field_id( 'looping' ) .'" name="'. $this->get_field_name( 'looping' ) .'" >';
		
		echo '<option value="true" '. selected( $instance['looping'], 'true', true ) .' >Yes</option>';
		
		echo '<option value="false" '. selected( $instance['looping'], 'false', true ) .' >No</option>';
		
		echo '</select>';
		
		echo '</p>';
		
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'show_avatars' ) .'">Show Avatars : </label>';
		
		echo '<select class="widefat" id="'. $this->get_field_id( 'show_avatars' ) .'" name="'. $this->get_field_name( 'show_avatars' ) .'" >';
		
		echo '<option value="true" '. selected( $instance['show_avatars'], 'true', true ) .' >Yes</option>';
		
		echo '<option value="false" '. selected( $instance['show_avatars'], 'false', true ) .' >No</option>';
		
		echo '</select>';
		
		echo '</p>';
		
		echo '<p>';
		
		echo '<label for="'. $this->get_field_id( 'background_state' ) .'">Background State : </label>';
		
		echo '<select class="widefat" id="'. $this->get_field_id( 'background_state' ) .'" name="'. $this->get_field_name( 'background_state' ) .'" >';
		
		echo '<option value="color" '. selected( $instance['background_state'], 'color', true ) .' >Color</option>';
		
		echo '<option value="transparent" '. selected( $instance['background_state'], 'transparent', true ) .' >Transparent </option>';
		
		echo '</select>';
		
		echo '</p>';
		
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = array( 
						'title' => '',
						'user_name' => '', 
						'tweet_number' => '',
						'widget_state' => '',
						'looping' => '',
						'background_state' => '',
						'background_color' => '', 
						'text_color' => '' ); 
		
		$instance = wp_parse_args( $new_instance, $instance );

		return $instance;
		
	}
		
	function widget( $args, $instance ) {
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		echo $before_title . $title . $after_title;
		
		 lf_twitter_widget_display( $instance );
		
		echo $after_widget;
		
	}

}

register_widget( 'lf_twitter_widget' ); 

?>