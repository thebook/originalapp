<?php 

/**
* A gallery generator
*/
class generate_gallery extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<?php if ( $saved != '' ) : ?>

				<?php foreach ( $saved as $key => $v ) : ?>
			
				<span class="lf-removable-image">
				
				<input id="<?php echo "$this->id-$name"; ?>" type="hidden" name="<?php echo $array."[$name][$key]"; ?>" value="<?php echo $v; ?>">
				
				<img src="<?php echo $v; ?>">
					
				</span>	

			<?php endforeach; ?>

		<?php endif; ?>
			
		<input id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="Upload Image">

		<script>load.upload( '#<?php echo "$this->id-$name"; ?>-button', '#<?php echo "$this->id-$name"; ?>' );</script>

<?php }
}

?>