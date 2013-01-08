<?php

/**
* A branch which inits all admin page classes e.g( they have an admin page to be manipulated ) and create and save options
*/
class branch_admin extends alpha_tree_options
{
	
	function __construct ($options) 
	{
		parent::__construct($options['id'], $options['class'], $options['default_type']);

		$this->params['manifestation'] = ( include $options['definition'] );	
		add_action('admin_menu', array($this, 'create_page') );
		add_action("wp_ajax_{$this->params['manifestation']['form_action']}", array( $this, 'save' ) );
		add_action("wp_ajax_{$this->params['manifestation']['form_action']}_reset", array( $this, 'reset' ) );
	}

	public function create_page ()
	{
		multi($this->params['manifestation']);
	}

	public function save ()
	{
		$this->_not_allowed();

		$option_name         = $this->params['manifestation']['options'];
		$current_option      = get_option($option_name);
		$response['error']   = false;
		$response['header']  = __('Saved', 'liquidflux');
		$response['message'] = __('Your settings have been saved', 'liquidflux');

		foreach ( $_POST[$option_name] as $key => $unsaved_value ) {
			$current_option[$key] = $unsaved_value;
		}
		update_option( $option_name, $current_option );

		echo json_encode($response);
		exit;
	}

	public function reset ()
	{
		$this->_not_allowed();
	
		$option_name         = $this->params['manifestation']['options'];
		$response['error']   = false;
		$response['header']  = __('Settings Reset', 'liquidflux');
		$response['message'] = __('Your current settings have been reset, your website is in striped state', 'liquidflux');	

		update_option( $option_name, array() );

		echo json_encode($response);
		exit;
	}

	protected function _not_allowed()
	{
		if (!isset($_POST["{$this->params['id']}_nonce"]) or !wp_verify_nonce($_POST["{$this->params['id']}_nonce"], $this->params['class'] ) ) 
		{
			$response['error']   = true;
			$response['header']  = __('Not Saved', 'liquidflux');
			$response['message'] = __('You do not seem to have the necessary premission to change these options', 'liquidflux' );
			
			echo json_encode($response);
			exit;
		}
	}

	public function page ()
	{ ?> 

		<?php $config = $this->params['manifestation']; ?>
		
		<div>
			<form id="<?php echo $this->params['id'];?>" 
				  action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" 
				  method="post" class="<?php echo $this->params['id']; ?>-form">
				
				<!-- Top Stripe -->
				<div class="<?php echo $this->params['id']; ?>-header">
					<!-- Name . Version -->
					<div class="<?php echo $this->params['id']; ?>-header-wrap">	
						<!-- Title -->
						<h1><?php echo $config['title']; // get theme name and any other modules ?></h1>
						<!-- Version  -->
						<span class="<?php echo $this->params['id']; ?>-label"><?php echo $config['sub_title']; ?></span>
					</div>
					<!-- Logo -->
					<a href="http://www.recyclabook.co.uk" title="">
						<!-- Image -->
						<img  class="<?php echo $this->params['id']; ?>-image" src="<?php echo FRAMEWORKURI .'/CSS/Includes/Images/login-logo.png';?>"/>
					</a>
				</div>
				
				<!-- Save Stripe -->
				<div class="<?php echo $this->params['id']; ?>-save">

					<!-- the "wp-admin/admin-ajax.php" looks for the value of an "action" named input,
						that value then is used to append to create a action hook named "wp_ajax_{append your action value here}"
						we then hook into it by adding our ajax handler function to hook -->
					<input type="hidden" name="action" value="<?php echo $config['form_action']; ?>">

					<input type="hidden" name="<?php echo $this->params['id']; ?>_nonce" value="<?php echo wp_create_nonce($this->params['class']);?>">

					<input id="<?php echo $this->params['id']; ?>_save" type="submit" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Save', 'liquidflux'); ?>"/>
					
					<input id="<?php echo $this->params['id']; ?>_reset" type="button" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Reset', 'liquidflux'); ?>"/>
					
				</div>

				<!-- Body -->
				<div class="<?php echo $this->params['id']; ?>-body">
					<!-- Echo option fields -->
					<?php lf_do_settings_sections($config['page_name']);?>
				</div>

				<!-- Scripts  -->
				<script>
					// Initiates tabing of pages
					tab.init('.nav ul li a', '.holder .content');
					// Initiates ajax saving
					ajax.save({
						form : "<?php echo $this->params['id']; ?>",
						save : "<?php echo $this->params['id']; ?>_save",
						});
					// Initiates ajax resets
					ajax.reset({
						reset  : "<?php echo $this->params['id']; ?>_reset",
						action : "<?php echo $config['form_action'];?>_reset",
						nonce  : "<?php echo wp_create_nonce($this->params['class']);?>",
						nonce_name: "<?php echo $this->params['id'];?>_nonce"
					});
				</script>
			</form>
		</div>
<?php }
}

?>