<?php 

/**
* A text option generator
*/
class generate_amazon_list extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php global $post; ?> 

	<?php extract($options); ?>

		<div id="<?php echo "$this->id-$name"; ?>-amazon">
	
			<input type="text" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-search-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">

			<input data-function-instructions="{ 'id' : '<?php echo $post->ID;?>', 'input_id' : '<?php echo "$this->id-$name"; ?>', 'search_for' : 'books', 'numerical_search' : 'isbn', 'filter_by' : 'tiny' }" data-function-to-call="amazon" id="<?php echo "$this->id-$name"; ?>-button" class="button <?php echo $this->class; ?>-button" type="button" value="Search">
		</div>

		<script>alpha.track_events_on_this('#<?php echo "$this->id-$name"; ?>-amazon', 'click');</script>

<?php }
}

?>