<?php 

function include_fol($fol) {

	$folder = new DirectoryIterator($fol);

	foreach ($folder as $info) 
	{	
		if (!$info->isDot())
		{
			include $fol.$info->getFilename();
		}
	}

}

function _default_meta($array, $name, $default) {

	global $post;

	if ( !$post ) 
	{ 
		return $default; 
	}
	else 
	{
		$m = get_post_meta( $post->ID, $array, true );
		return (isset( $m[$name] ) ? $m[$name] : $default );
	}
}

function _default_option($array, $name, $default) {

	$option = get_option( $array );
	
	return ( $option && isset($option[$name]) ? $option[$name] : $default );

}

function _default($type, $array, $name, $default) {

	$d = '_default_'.$type;

	return $d($array, $name, $default);

}

function multi( $o ) { 

	if ( !is_array( $o ) ) return false;

	foreach ( $o['opt'] as $a ) {

		call_user_func_array( $a['f'], $a['o'] ); 
		
	} 
	
}


function scripter($script) {

	echo "<script>$script</script>";

}

function lf_head_hook() {

	do_action( 'lf_head_hook' );

}

function lf_pxc($v) {

	if ( strpos( $v, 'px' ) === false ) { $v = $v . 'px'; }

	return $v;

}

function lf_cat_posts() { ?>

	<ul>

		<?php $c = get_categories(); ?>

		<?php foreach ($c as $cat) : ?>

		<?php query_posts( 'cat=' .$cat->cat_ID ); ?>

			<span><?php echo $cat->cat_name; ?></span>

			<ul>

				<?php while ( have_posts() ) : the_post(); ?>

				<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

				<?php endwhile; ?>

			</ul>

		<?php endforeach; ?>

	</ul>

<?php }

?>