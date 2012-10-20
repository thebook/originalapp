
<?php $slide = layout_finder( 'main_options', 'main_meta', get_the_ID(), 'chosen_layout', 'slider_state' ); ?>

<?php $m = get_post_meta( 545, 'main_meta', true ); ?>

<?php include('template.class.php'); ?>

<?php $ss = new slide( 545 ); ?>