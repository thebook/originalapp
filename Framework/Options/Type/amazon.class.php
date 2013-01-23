<?php 

/**
* A text option generator
*/
class generate_amazon_list extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<input type="text" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-search-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

		<input data-function-instructions="{'input_id' : '<?php echo "$this->id-$name"; ?>', 'search_for' : 'books', 'numerical_search' : 'isbn', 'filter_by' : 'tiny' }" data-function-to-call="amazon" id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="Search">

		<script>alpha.track_events_on_this('#<?php echo "$this->id-$name"; ?>-button', 'click');</script>

<?php }
}

?>