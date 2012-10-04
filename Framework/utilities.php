<?php 

function scripter($script) {

	echo "<script>$script</script>";

}


function lf_head_hook() {

	do_action( 'lf_head_hook' );

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