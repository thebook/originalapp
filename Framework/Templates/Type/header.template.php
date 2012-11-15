<?php 

/**
* A class which generates the header template
*/
class template_header extends alpha_tree_template
{
	
	function __construct($template_parts_to_get)
	{ ?>
		<?php $this->_init_option(); ?>
		
		<div class="liquidflux-header">
			
			<?php $this->_get_every_template_part_and_pass_paramaters($template_parts_to_get); ?>

		</div>
<?php }

	protected function _advert($params)
	{ ?>
		<div class="liquidflux-header-ad-<?php echo $params['ad_size']; ?>">

			<?php echo $params['ad_code']; ?>

		</div>
<?php }

	protected function _logo($params)
	{ ?>

		<div class="liquidflux-header-logo">

			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">

				<img src="<?php echo $this->template_paramaters['admin_option']['logo']; ?>">

			</a>

		</div>
<?php }

	protected function _title($params)
	{ ?>
		<hgroup class="liquidflux-header-title">
			
			<h1>
			
				<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">

					<?php bloginfo('name'); ?>

				</a>
			
			</h1>

		</hgroup>
	<?php }

	protected function _title_and_logo($params)
	{ ?>
		<div class="liquidflux-title-wrap">

			<?php $this->_get_every_template_part_and_pass_paramaters($params); ?>

		</div>
<?php }

}

?>