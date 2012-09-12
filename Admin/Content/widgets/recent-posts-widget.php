<?php 

function lf_recent_posts_widget_display( $opts ) {


	$query = new WP_Query( array( 'cat' => $opts['post_category'], 'posts_per_page' => $opts['number_of_posts'] ) );
	
	while ( $query->have_posts() ) : $query->the_post(); 
		
		if ( $opts['show_title'] != "hide" ) {
		
			echo '<p>';
			
			echo '<a class="lf-widget-recent-posts" href="'.get_permalink() .'" title="'. get_the_title() .'" >';
			
			the_title();
			
			echo '</a>';
			
			echo '</p>';
		
		}
	
		echo '<p class="lf-featured-image">';
		
		echo '<a class="lf-widget-recent-posts" href="'.get_permalink() .'" title="'. get_the_title() .'" >';
		
		the_post_thumbnail();
		
		echo '</a>';
		
		echo '</p>';
		
		if ( $opts['show_excerpt'] != "hide" ) {
		
			the_excerpt();
		
		}
	
	endwhile;
	
} 

class lf_recent_posts_widget extends WP_Widget { 

	function __construct() {
	
		$this->WP_Widget( 'lf_recent_posts', 
						  'White Whale Recent Posts',
						  array(
							'classname' => 'lf-recent-posts-widget',
							'description' => 'Show any number of recent posts from any category, as well as chose whether to show just a thumbnail, text, title or any combination of the three, including all of them.' ) );
							
	}
	
	function form( $instance ) {
	
		$default = array( 
						'title' => '',
						'post_category' => '',
						'number_of_posts' => '',
						'show_thumb' => '',
						'show_excerpt' => '',
						'show_title' => '' ); 
		
		$instance = wp_parse_args( $instance, $default );
	
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'title' ) .'">Title : </label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" type="text" value="'. esc_attr(  $instance['title'] ) .'" />';
			
			echo '</p>';
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'post_category' ) .'">Category : </label>';
			
			echo '<select class="widefat" id="'. $this->get_field_id( 'post_category' ) .'" name="'. $this->get_field_name( 'post_category' ) .'" >';
			
			foreach ( ( get_categories() ) as $category ) { 
			
				echo '<option value="'.$category->cat_ID.'" '. selected( $instance['post_category'], $category->cat_ID, true ) .' >'. $category->cat_name .'</option>';
			
			}
			
			echo '</select>';
			
			echo '</p>';
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'number_of_posts' ) .'">Number of Posts : </label>';
			
			echo '<input class="widefat" id="'. $this->get_field_id( 'number_of_posts' ) .'" name="'. $this->get_field_name( 'number_of_posts' ) .'" type="text" value="'. esc_attr(  $instance['number_of_posts'] ) .'" />';
			
			echo '</p>';
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'show_title' ) .'">Show Title : </label>';
			
			echo '<select class="widefat" id="'. $this->get_field_id( 'show_title' ) .'" name="'. $this->get_field_name( 'show_title' ) .'" >';
			
			echo '<option value="show" '. selected( $instance['show_title'], 'show', false ) .' >Show</option>';
			
			echo '<option value="hide" '. selected( $instance['show_title'], 'hide', false ) .' >Hide</option>';
			
			echo '</select>';
			
			echo '</p>';
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'show_thumb' ) .'">Show Thumbnails : </label>';
			
			echo '<select class="widefat" id="'. $this->get_field_id( 'show_thumb' ) .'" name="'. $this->get_field_name( 'show_thumb' ) .'" >';
			
			echo '<option value="show" '. selected( $instance['show_thumb'], 'show', false ) .' >Show</option>';
			
			echo '<option value="hide" '. selected( $instance['show_thumb'], 'hide', false ) .' >Hide</option>';
			
			echo '</select>';
			
			echo '</p>';
			
			echo '<p>';
			
			echo '<label for="'. $this->get_field_id( 'show_excerpt' ) .'">Show Excerpt : </label>';
			
			echo '<select class="widefat" id="'. $this->get_field_id( 'show_excerpt' ) .'" name="'. $this->get_field_name( 'show_excerpt' ) .'" >';
			
			echo '<option value="show" '. selected( $instance['show_excerpt'], 'show', false ) .' >Show</option>';
			
			echo '<option value="hide" '. selected( $instance['show_excerpt'], 'hide', false ) .' >Hide</option>';
			
			echo '</select>';
			
			echo '</p>';
			
		
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = array( 
						'title' => '',
						'post_category' => '',
						'number_of_posts' => '',
						'show_thumb' => '',
						'show_excerpt' => '',
						'show_title' => '' ); 
		
		$instance = wp_parse_args( $new_instance, $instance );

		return $instance;
		
	}
		
	function widget( $args, $instance ) {
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		echo $before_title . $title . $after_title;
		
		lf_recent_posts_widget_display( $instance );
		
		echo $after_widget;
		
	}

} 

register_widget( 'lf_recent_posts_widget' );

?>