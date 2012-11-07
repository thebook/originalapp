<?php 

/**
* A upload generator
*/
class generate_upload extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<?php if ( $saved != '' ) : ?>

			<img src="<?php echo $saved; ?>" class="lf-uploaded-image" />

		<?php endif; ?>
			
		<input id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="Upload Image">

		<script>load.upload( '#<?php echo "$this->id-$name"; ?>-button', '#<?php echo "$this->id-$name"; ?>' );</script>

<?php }
}

?>