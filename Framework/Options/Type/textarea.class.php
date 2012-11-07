<?php 

/**
* A textarea option generator
*/
class generate_textarea extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<textarea id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>"><?php echo $saved; ?></textarea>

<?php }
}

?>