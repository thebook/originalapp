<?php 

	$get_the_template_data = $_GET['template_data'];
	
	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );

	$template_definition = ( include FRAMEWORK .'/Definitions/templates.definition.php' );

	$template_name = "template_{$get_the_template_data['name']}";

	$template_id = date('dwmyGis');

?> 

	<div data-template-name="<?php echo $get_the_template_data['name']; ?>" id="<?php echo $template_id; ?>" class="layoutbuilder-option-wrap drag">

		<?php if ( isset($get_the_template_data['params']) && !isset($get_template_data['not_template_part']) ) : ?>

			<?php new $template_name($get_the_template_data['params']); ?>

			<span>
				<a id ="<?php echo $get_the_template_data['name'] . $template_id; ?>" class ="layoutbuilder_edit has_options" title ="Edit part">
				   Edit
				</a>
			</span>

		<?php else : ?>

			<?php new $template_name; ?>

		<?php endif; ?>

		<?php if ( empty($get_the_template_data['not_a_template_part']) ) : ?>
	
			<span class="layoutbuilder_template_close_button"><a title="Remove part">Close</a></span>			

			<span><!-- <ul><li>Template 1</li><li>Template 2</li></ul> --></span>

			<script>console.log("normal template");</script>

		<?php endif; ?>
				
	</div>	