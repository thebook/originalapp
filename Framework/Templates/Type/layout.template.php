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
		
		<div class="layout-builder-save-options">
			
			<button id="layout-builder-save-layout">Save</button>
			
			<button id="layout-builder-use">Use</button>

		</div>

<?php }
	
	protected function _generate_builder_head ()
	{ ?>
		
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>

	<head>
		
		<meta http-equiv="Content-Typse" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
		
		<title><?php wp_title(''); ?></title>

		<!-- SEO stuff hooked onto this -->
		<?php lf_head_hook(); ?>

		<!-- Font insertion here -->
		
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" />
		
		<meta name="viewport" content="width=device-width; initial-scale=0.1; maximum-scale=0.1; user-scalable=0;" />
		
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<style type="text/css"><?php include FRAMEWORK .'/CSS/style-core.php'; ?></style>
			
		<!-- this creates the html5 elements in IE browsers below version 9 -->
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
			
		<?php wp_head(); ?>

		<style> <?php echo include FRAMEWORK .'/CSS/style-admin.css'; ?></style>

		<script><?php echo include FRAMEWORK .'/scripts/layout.js'; ?></script>	

	</head>

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

		<script>
			layout_builder.get_template_name_and_generate({
				bind_event_to                      : "layout-builder-template-generators",
				element_to_respond_to_when_clicked : 'li',
				element_to_append_to			   : "#layout-builder-drop-in",
				options_ajax_path                  : "<?php echo FRAMEWORKURI .'/ajax_loads/template.options.load.php'; ?>",
				template_ajax_path				   : "<?php echo FRAMEWORKURI .'/ajax_loads/template.load.php'; ?>"
			});
		</script>

<?php }

	protected function _body ($options_to_build)
	{ ?>
		<!DOCTYPE html>
		<html lang="en-US" dir="ltr">
				
			<?php $this->_generate_builder_head();?>

			<body>

				<div class="layout-builder-options">

					<?php $this->_generate_save_cancel_and_use_options(); ?>

					<?php $this->_generate_template_part_options($options_to_build); ?>

				</div>

				<div id="layout-builder-drop-in" class="layout-builder-canvas">

					<?php $this->_generate_body(); ?>

				</div>

			</body>

		</html>

<?php }

	protected function _generate_body ($options_to_build = null)
	{?>
		<div class="liquidflux-wrap-everything">

		</div>
		<!-- This is where it should get previous saved options and manifest a layout from them -->
<?php }
}

?>