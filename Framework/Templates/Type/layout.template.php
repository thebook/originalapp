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

		<script>
			layout_builder.close_layout_builder_window({
				id : '#layout-builder-layout-close',
				box_to_close : '.layout-builder'
			});
			layout_builder.close_options_sidebar({
				id : '.layout-builder-colapse-button',
				canvas_to_expand : '.layout_builder_body'
			});
		</script>

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
					
					<span class="layout-builder-colapse-arrow"></span>
				
				</a>
				
			<!-- <a id="layout-builder-save-layout" class="button">Save</a><a id="layout-builder-use" class="button">Use</a> -->
				
			</div>

			<div  class="layout-builder-canvas">

				<?php $this->_generate_layout_builder_insert_iframe(); ?>

			</div>

			<script>
				layout_builder.get_template_name_and_generate({
					bind_event_to                      : "layout-builder-template-generators",
					element_to_respond_to_when_clicked : 'li',
					element_to_append_to			   : "layout-builder-drop-in",
					options_ajax_path                  : "<?php echo FRAMEWORKURI .'/ajax_loads/template.options.load.php'; ?>",
					template_ajax_path				   : "<?php echo FRAMEWORKURI .'/ajax_loads/template.load.php'; ?>"
				});
			</script>

		</div class="layout_builder_body">

<?php }

	protected function _generate_layout_builder_insert_iframe ($options_to_build = null)
	{?>

		<iframe id="layout-builder-drop-in" src="<?php echo FRAMEWORKURI .'/layout.builder.php?' ?>" >

		</iframe>

<?php }

}

?>