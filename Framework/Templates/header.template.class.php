<?php 

/**
* A class which generates the header template
*/
class template_header
{
	
	function __construct($options)
	{
		
	}

	protected function _advert($options)
	{ ?>
		<div class="header-ad<?php echo $options['ad_size']; ?>">

			<?php echo $options['ad_code']; ?>

		</div>
<?php }

	protected function _logo()
	{ ?>
		<div class="header-logo">

			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">

				<img src="<?php echo $this->saved_options['logo']; ?>">

			</a>

		</div>
<?php }

	protected function _title()
	{ ?>
		<hgroup class="header-title">
			
			<h1>
			
				<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">

					<?php bloginfo('name'); ?>

				</a>
			
			</h1>

		</hgroup>
	<?php }

}

?>