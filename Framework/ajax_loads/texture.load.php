<?php 
	
	// Get the passed array
	$ajax = $_GET['data'];

	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
		
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' ); ?>

	<?php extract($ajax); ?>

	<?php $textures = new DirectoryIterator( FRAMEWORK .'/CSS/Includes/Textures/' ); ?>

	<?php while ( $textures->valid() ) : ?>
		
		<?php if ( !$textures->isDot() && $move_forward-- < 1 ) : ?>

			<?php $css = "url( ". FRAMEWORKURI ."/CSS/Includes/Textures/". $textures->current() ." ) repeat;"; ?>

			<label id="<?php echo "$id-$name"; ?>" class="<?php echo "$class";?>-texture-radio">

				<input class="admin-radio" type="radio" name="<?php echo $array ."[$name]"; ?>" <?php checked( $saved, $css ); ?> value="<?php echo $css; ?>">
				
				<div class="<?php echo "$class";?>-texture-image" style="background: <?php echo $css; ?>"></div>
		
			</label>

		<?php endif; ?>
		
		<?php $textures->next(); ?>	
			
	<?php endwhile; ?>