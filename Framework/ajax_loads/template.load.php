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

	<div id="<?php echo $template_id; ?>" class="layoutbuilder-option-wrap">

		<?php if ( isset($get_the_template_data['params']) ) : ?>

			<?php new $template_name($get_the_template_data['params']); ?>

			<span>
				<a id="<?php echo $get_the_template_data['name'] . $template_id; ?>" class="layoutbuilder-edit has_options" title="Edit part">Edit
				</a>
			</span>

			<script>
				!function ($) { 
					$(document).ready(
						function () { 
							layout_builder.open_options_box_for_an_inserted_template({
								bind_event_to		 : "#<?php echo $get_the_template_data['name'] . $template_id; ?>",
								element_to_append_to : ".layout_builder_body",
								template_id			 : "#<?php echo $template_id; ?>",
								ajax_path  			 : "<?php echo FRAMEWORKURI .'/ajax_loads/template.options.load.php'; ?>",
								template_name 		 : "<?php echo $get_the_template_data['name']; ?>"
							});
						});
				}(jQuery);
			</script>

		<?php else : ?>

			<?php new $template_name; ?>

		<?php endif; ?>
		
		<span><a class="layoutbuilder-close-button" title="Remove part">Close</a></span>

		<span><!-- <ul><li>Template 1</li><li>Template 2</li></ul> --></span>
	
	</div>

	<script>console.log("added");</script>