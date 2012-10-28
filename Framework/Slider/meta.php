
<?php 
	
	// Gets the current slide numberwhich is passed on by the js
	$i 	  = $_GET['index']; 

	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );
	
	// Create new slide_opt instance for adjusting the array
	$sp = new slide_opt('', false);
	
	// Return the option defiition array into $m
	$m = lf_slide_meta();

	// Append current index to end of option names
	$m = $sp->literate( $m, $i );

?>

	<div class="postbox " id="slide<?php echo $i; ?>">

		<div title="Click to toggle" class="handlediv"><br></div>

		<h3 class="hndle"><span>Slide <?php echo $i; ?></span></h3>

		<div class="inside">

			<?php wrap_ite( false, $m ); ?>

		</div>

	</div>