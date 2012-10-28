<?php 

/**
* Theme admin page options
*/
class admin extends options
{	

	/**
	 * Includes the definition array of options and passes them into the multi() function
	 * @return html
	 */
	public function body()
	{	
		$options = ( include FRAMEWORK .'/Definitions/admin.php' );
		multi($options);
	}

	/**
	 * The put function spits out a single option row, ( the title, desc, option and any js needed for it )
	 * @param  string $ty "Type" of option
	 * @param  string $t  "Title" of option
	 * @param  string $d  "Description" of option
	 * @param  string $a  "Array" name of array which holds the option
	 * @param  string $n  "Name" of specific option 
	 * @param  string $s  "Saved" value of option if there is nothing saved
	 * @param  string $o  "Options" name of the input if is a select or radio
	 * @param  string $v  "Values" of the options if the input is a select or radio
	 * @param  array  $h  "Hider" or the option, the array takes two values, one($h[0]) for the name of the option which trigers
	 *                    	the hide, and two($h[1]) a js array of the value/s which trigger/s it
	 * @return html     A single option row
	 */
	public function put ( $ty, $t, $d, $a, $n, $s = null, $o = null, $v = null, $h = null)
	{ ?>
		<tr id="<?php echo $n ?>-hook" >
			<th>			
				<strong>
					<?php echo $t; ?>
				</strong>
				<span>
					<?php echo $d; ?>
				</span>
			</th>
			<td>
				<?php $this->opt( $ty, $a, $n, $s, $o, $v, $h); ?>
			</td>
			<?php $this->hider( $h, $n ); ?>
		</tr>

<?php }
	
	/**
	 * Add a admin page with a modified verison of add_settings_section() 
	 * @param  array $a The options array 
	 * @return     Creates a new page
	 */
	public function pop($a)
	{	
		lf_add_settings_section( $a['id'], $a['title'], array($this, 'wrap'), $a['page'], $a );
	}

	/**
	 * Wraps the multi function of a page and then calls multi to further display its options
	 * @return html A option page
	 */
	public function wrap($a)
	{ ?>
		<table class="form-table">
			<tbody>
				<?php multi( $a['callargs']['options'] ); ?>
			</tbody>
		</table>	

	<?php }
}

?>