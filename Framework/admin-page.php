<?php 

function admin_page() 
{ ?>
	<div>
		<form id="lf-admin-form" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post" class="lf-admin-form">
			
			<!-- Top Stripe -->
			<div class="lf-admin-header">
				
				<!-- Name . Version -->
				<div class="lf-admin-header-wrap">	
					<h1><?php echo "White Whale"; // get theme name and any other modules ?></h1>
					
					<span class="lf-admin-label">.Version One</span>
				</div>

				<!-- Logo -->
				<a href="http://www.cikica.com" title="Go to cikica">
					<img  class="lf-admin-image" src="<?php echo FRAMEWORKURI .'/CSS/Includes/Images/login-logo.png';?>"/>
				</a>

			</div>
			
			<!-- Save Stripe -->
			<div class="lf-admin-save">
				
				<!-- the "wp-admin/admin-ajax.php" looks for the value of an "action" named input,
					that value then is used to append to create a action hook named "wp_ajax_{append your action value here}"
					we then hook into it by adding our ajax handler function to hook -->
				<input type="hidden" name="action" value="white_whale_save">

				<input type="submit" class="lf-admin-button" value="<?php _e('Save', 'liquidflux'); ?>"/>
				
				<input type="button" class="lf-admin-button" value="<?php _e('Reset', 'liquidflux'); ?>"/>
				
			</div>
			
			<!-- Body -->
			<div class="lf-admin-body">
				<?php settings_fields('main_options');?>
				<?php lf_do_settings_sections('whitewhale');?>
			</div>

			<!-- Inits the tabs -->
			<script>tab.init('.nav ul li a', '.holder .content');</script>

		</form>
	</div>
<?php } ?>