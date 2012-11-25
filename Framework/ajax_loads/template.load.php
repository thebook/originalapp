<?php 

	$get_the_template_data = $_GET['template_data'];
	
	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );

	$template_definition = ( include FRAMEWORK .'/Definitions/templates.definition.php' );

	$template_name = "template_{$get_the_template_data['name']}";

?>
	<div class="layoutbuilder-option-wrap">

			<span class="layoutbuilder-close-button"></span>
			<span class="layoutbuilder-edit"></span>
		
		<?php if ( isset($get_the_template_data['params']) ) : ?>

			<?php new $template_name($get_the_template_data['params']); ?>

		<?php else : ?>

			<?php new $template_name; ?>

		<?php endif; ?>
	
	</div>

	<script>console.log("added");</script>