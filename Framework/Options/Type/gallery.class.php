<?php 

/**
* A gallery generator
*/
class generate_gallery extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>

		<?php if ( $saved != '' ) : ?>

			<?php foreach ( $saved as $key => $v ) : ?>
			
				<span class="lf-removable-image">
				
					<input id="<?php echo "$this->id-$name"; ?>" type="hidden" name="<?php echo $array."[$name][$key]"; ?>" value="<?php echo $v; ?>">
				
					<img src="<?php echo $v; ?>">
					
				</span>	

			<?php endforeach; ?>

		<?php endif; ?>
			
		<input id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button-wrap" type="button" value="Upload Image">

		<script>load.gallery( '#<?php echo "$this->id-$name"; ?>-button', '<?php echo $name; ?>', 'main_meta' );</script>

<?php }
}

?>