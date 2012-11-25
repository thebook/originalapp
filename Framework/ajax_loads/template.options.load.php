<?php 

	$get_the_template_name = $_GET['template_data'];
	
	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );

	$template_definition = ( include FRAMEWORK .'/Definitions/templates.definition.php' );

	$template_definition = $template_definition[$get_the_template_name['name']];

?>	
	<?php if ( isset( $template_definition['options']) ) : ?>

		<div class="layout-builder-options-box">
			
			<table class="form-table layout-builder-options-table">
	
				<tbody>
					
					<?php foreach ($template_definition['options'] as $options_array) : ?>

						<?php extract($options_array); ?>

						<?php $class = "generate_" . $type; ?>

						<tr>
							<th>			
								<strong><?php echo $title; ?>      </strong>
								<span>  <?php echo $description; ?></span>
							</th>

							<td><?php new $class($options_array, 'layout-builder', 'layout-builder-options-td'); ?></td>
						</tr>
						
					<?php endforeach; ?>

				</tbody>

			</table>

			<a id="options_box_insert" class="button">Insert</a>

			<a id="options_box_cancel" class="button">Cancel</a>

		</div>

		<script>
			!function ($) {
				$(document).ready(
					function () { 
						layout_builder.take_options_box_values_and_manifest_a_template({
							insert_button_id	  : "options_box_insert",
							cancel_button_id	  : "options_box_cancel",
							template_name         : '<?php echo $get_the_template_name["name"]; ?>',
							paramaters_name       : "params",
							name_prefix_to_remove : "main_meta",
							ajax_path 			  : "<?php echo FRAMEWORKURI .'/ajax_loads/template.load.php'; ?>",
							element_to_append_to  : "layout-builder-drop-in",
							is_using_iframe 	  : true
						});
					});
			}(jQuery);
		</script>

	<?php endif; ?>
