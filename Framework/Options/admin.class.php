<?php 

/**
* Theme admin page options
*/
class admin extends branch_admin
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
	 * Add a admin page with a modified verison of add_settings_section() to all callback argument passing
	 * Use to create a new admin page and then pass arguments to create options within that page
	 * @param  array $a The options array 
	 * @return     Creates bnew admin page
	 */
	public function pop($a)
	{	
		lf_add_settings_section( $a['id'], $a['title'], array($this, 'wrap'), $a['page'], $a );
	}

	/**
	 * Wraps the multi function of a page and then calls it to further display its options
	 * @return html A option page
	 */
	public function wrap($a)
	{ ?>
		<table class="lf-admin-table form-table">
			<tbody>
			
				<h2>
					<?php echo $a['title']; ?>
				</h2>
				
				<p>
					<?php echo $a['callargs']['desc']; ?>
				</p>
				
				<?php multi( $a['callargs']['options'] ); ?>
			
			</tbody>
		</table>	

	<?php }
}

?>