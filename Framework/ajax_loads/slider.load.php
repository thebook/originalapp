
<?php 
	
	// Gets the current slide numberwhich is passed on by the js
	$current_slide_index = $_GET['index']; 

	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );
	
?>

	<div class="postbox " id="slide<?php echo $current_slide_index; ?>">

		<div title="Click to toggle" class="handlediv"><br></div>

		<h3 class="hndle"><span>Slide <?php echo $current_slide_index; ?></span></h3>

		<div class="inside">

			<?php 
				// Create a single meta box by initing the slide_opt class as an ajax specific instance
				new leaf_slide(
					array(
						'id' => 'lf-post-meta',
						'class' => 'lf-admin-post-meta-td',
						'default_type' => 'meta', 
						'definition' => FRAMEWORK .'/Definitions/slider.definition.php',
						'ajax' => $current_slide_index
						));
			?>

		</div>

	</div>