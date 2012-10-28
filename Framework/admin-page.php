<?php 

function admin_page() 
{ ?>

	<div>
		<form id="main-opts-form-hook" name="main_options_form" action="options.php" method="post" class="main-options-form" >
			<div>
				<h1><?php echo "White Whale"; // get theme name and any other modules ?></h1>
				<span></span>
				<div>Image</div>
				<span><button>Save</button><button>Reset</button></span>
			</div>
			<div>
				<?php settings_fields('main_options');?>
				<?php do_settings_sections('whitewhale');?>
			</div>
		</form>
	</div>

<?php } ?>