<?php 

/**
* A template which creates the generation window form which we buld layouts 
*/
class template_layout_creator extends alpha_tree_template
{
	
	function __construct()
	{
		$options_to_build = ( include FRAMEWORK .'/Definitions/templates.definition.php' );
		$this->_body($options_to_build);
	}

	protected function _generate_save_cancel_and_use_options ()
	{?>
		
		<div class="layout-builder-info-box">
			
			<span>Layout Builder for</span>

			<strong>White Whale</strong>

		</div>

<?php }
	
	protected function _generate_template_part_options ($options_to_build)
	{ ?>
		<ul id="layout-builder-template-generators">
			
			<?php foreach ($options_to_build as $template_name => $template_options) : ?>

				<?php $does_the_template_have_options = ( isset( $template_options['options'] ) ? "has_options" : "no_options" ); ?>
				
				<li id="<?php echo $template_name; ?>" class="<?php echo $does_the_template_have_options; ?>">

					<span><?php echo ucfirst($template_name); ?></span>

				</li>

			<?php endforeach; ?>

		</ul>

<?php }

	protected function _body ($options_to_build)
	{ ?>

		<div class="layout_builder_body">

			<div class="layout-builder-options">

				<?php $this->_generate_save_cancel_and_use_options(); ?>

				<?php $this->_generate_template_part_options($options_to_build); ?>

			</div>

			<div class="layout-builder-save-options">
			
				<a id="layout-builder-layout-close" class="button">Close</a>

				<a class="layout-builder-colapse-button button-secondary">
					<span id="layout-builder-colapse" class="layout-builder-colapse-arrow"></span>
				</a>
				
			<!-- <a id="layout-builder-save-layout" class="button">Save</a><a id="layout-builder-use" class="button">Use</a> -->
				
			</div>

			<div  class="layout-builder-canvas">

				<?php $this->_generate_layout_builder_insert_iframe(); ?>

			</div>

			<?php $this->_scripts(); ?>

		</div class="layout_builder_body">

<?php }

	protected function _generate_layout_builder_insert_iframe ($options_to_build = null)
	{?>
		
		<iframe onmousemove="return false;" id="layout-builder-drop-in" src="<?php echo FRAMEWORKURI .'/layout.builder.php?' ?>" >

		</iframe>

<?php }

	protected function _scripts ()
	{ ?>
		<script>
			!function ($) { 
				$('#layout-builder-drop-in')
				.load(
				function () { 

					layout_builder
					.branch.builder_interactions
					.init({
						builder_get : '.layout_builder_body'
					});
					
					// Click event on builder
					layout_builder
					.get_template_name_and_generate({
						bind_event_to                      : "layout-builder-template-generators",
						element_to_respond_to_when_clicked : 'li',
						iframe_id						   : "layout-builder-drop-in",
						element_to_append_to			   : ".liquidflux-wrap-everything",
						options_ajax_path                  : "<?php echo FRAMEWORKURI .'/ajax_loads/template.options.load.php'; ?>",
						template_ajax_path				   : "<?php echo FRAMEWORKURI .'/ajax_loads/template.load.php'; ?>"
					});
						

					// Click event on iframe
					layout_builder
					.branch
					.make_templates_draggable_inside_iframe
					.init({
						iframe_id : 'layout-builder-drop-in'
					});					
					
					// Click event on iframe 
					layout_builder
					.bind_template_remove_button_response_to_iframe({
						iframe_id : 'layout-builder-drop-in'
					});			
				});
			}(jQuery);
		</script>

	<?php }

}

?>