
<?php 
	
	// Gets the current slide numberwhich is passed on by the js
	$i 	  = $_GET['index']; 
	// Get current file path
	$p  = explode( 'wp-content', __FILE__ );
	$f  = $p[0] .'wp-content/themes/WhiteWhale';
	
	// Load wordpress
	require_once( $p[0] .'/wp-load.php' );
	// Include option generator ( this will brake once its included in the main functions php, therefore remove after that )
	include( $f . '/Framework/options.class.php');
	// Create New options instance 
	$op = new options(
					array(
						'input' => 'lf-admin-post-meta-td',
						'head'  => 'lf-admin-post-meta-th',
						'id'    => 'lf-post-meta',
						'wrap'  => array('tr', 'th', 'td' ) ) );

	// Return the option array into $m
	$m = lf_slide_meta();

	foreach ($m['options']['opt'] as $index => $v) {

		$m['options']['opt'][$index]['f'] = array( $op, 'put' );
	
	}

?>

<div class="postbox " id="slide<?php echo $i; ?>">

	<div title="Click to toggle" class="handlediv"><br></div>

	<h3 class="hndle"><span>Slide <?php echo $i; ?></span></h3>

	<div class="inside">

		<?php wrap_ite( false, $m ); ?>

	</div>

</div>