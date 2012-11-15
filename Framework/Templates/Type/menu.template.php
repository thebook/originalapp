<?php 

/**
* A class which manifest menu templates
*/
class template_menu extends alpha_tree_template
{
	
	function __construct($params)
	{ ?>
		<div class="liquidflux-menu-wrap">

			<div class="liquidflux-menu-holder">

				<?php $this->_get_every_template_part_and_pass_paramaters($params['template_parts_to_get']); ?>

			</div>

		</div>
	<?php }

	protected function _navigation($params)
	{ ?>
		<nav id="liquidflux-menu-<?php echo $params['id']; ?>" class="liquidflux-menu-navigation-<?php echo $params['navigation_size']; ?>">
		
			<?php wp_nav_menu( array( 'theme_location' => 'liquidflux_navigation', 'menu' => $params['id'], 'container' => false, 'depth' => 2 ) ); ?>

		</nav>		
<?php }

}

?>