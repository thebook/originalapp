<?php 

/**
* A meta box and options within
*/
class meta extends branch_meta
{

	/**
	 * The create function creates a single option row with a title, description, option field and javascript 
	 * 
	 * @param array $passed_options An array of all the options which create the input option, keys are extracted as variables
	 *                              and handeled by methods this array is passed though all the way to the generate_{type} class
	 * @return html     A option row
	 */
	public function create ($passed_options)
	{ ?>
		<?php extract($passed_options); ?>

		<tr id="<?php echo $name; ?>-hook" >
			<th>			
				<strong><?php echo $title; ?></strong>

				<span><?php echo $description; ?></span>
			</th>
			<td>
				<?php $this->opt( $passed_options ); ?>
			</td>

			<?php ( isset($hider) ) and  $this->hider( $hider, $name ); ?>
		</tr>

<?php }
	
	/**
	 * Add a meta box and option fields within it, as well as a description, the meta box is passed a callback argument of the option array
	 * @param  array $option_array An array of options which define the meta box within
	 * @return html              Meta Box
	 */
	public function pop ($option_array)
	{
		add_meta_box( $option_array['id'], $option_array['title'], array($this, 'wrap' ), $option_array['post_type'], $option_array['context'], $option_array['priority'], $option_array );
	}

	/**
	 * Wraps the mutli function of a meta box and calls it to futher display its options 
	 * @param  array $option_array An array of option to define the meta box options
	 * @return html               A Meta Box
	 */
	public function wrap ($post_object, $option_array)
	{ ?>
		<table class="form-table lf-admin-post-meta-table">
	
			<tbody>
			
				<p><?php echo $option_array['args']['desc']; ?></p>

				<?php multi( $option_array['args']['options'] ); ?>
	
			</tbody>
	
		</table>

<?php }
}

?>