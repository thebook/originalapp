<?php 

function admin_page() 
{ ?>

	<div>
		<form id="main-opts-form-hook" name="main_options_form" action="options.php" method="post" class="lf-admin-form" >
			<div class="lf-admin-header">
				
				<div class="lf-admin-header-wrap">
					<h1><?php echo "White Whale"; // get theme name and any other modules ?></h1>
					<span class="lf-admin-label">.Version One</span>

				</div>

				<a href="http://www.cikica.com" title="Go to cikica">
					<img  class="lf-admin-image" src="<?php echo FRAMEWORKURI .'/CSS/Includes/Images/login-logo.png';?>"/>
				</a>

			</div>
			<div class="lf-admin-save"><button>Save</button><button>Reset</button></div>
			<div class="lf-admin-body">
				<?php settings_fields('main_options');?>
				<?php lf_do_settings_sections('whitewhale');?>
			</div>
		</form>
	</div>

<?php } ?>