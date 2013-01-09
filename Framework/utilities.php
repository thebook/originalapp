<?php 

function lf_comment_edit_link ( $text ) 
{ ?>
	<?php global $comment; ?>

	<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>

		<a class="lf-comment-edit" href="<?php echo get_edit_comment_link( $comment->comment_ID); ?>" title="Edit your comment"><?php echo $text; ?></a>

	<?php endif; ?>
<?php }


function timestamp () { 

	return time('YmdHis');
}

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

function option_spitter ( $array_of_options, $saved_value ) 
{?>

	<?php foreach ( $array_of_options  as $option ) : ?>

		<option <?php selected( $saved_value, $option['value'], true ); ?> value="<?php echo $option['value']; ?>"><?php echo $option['name']; ?></option>

	<?php endforeach; ?>

<?php }            

function lf_whitespace( $string ) { 
	
	if ( $string == '' ) { 
		
		return false;
		
	}
		
	elseif ( ctype_space( $string ) ) {
		
		return false;
		
	}
		
	else { 
		
		return true;
		
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