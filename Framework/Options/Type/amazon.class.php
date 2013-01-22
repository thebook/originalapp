<?php 

/**
* A text option generator
*/
class generate_amazon_list extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<input data-function-to-call="amazon" type="text" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<script>alpha.track_events_on_this('#<?php echo "$this->id-$name"; ?>', 'click');</script>

<?php }
}

?>