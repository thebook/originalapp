<?php 

/**
* A meta options generator
*/
class meta_options
{
	var $params;

	function __construct($id, $class)
	{
		$this->params['id']		= $id;
		$this->params['class']  = $class;
	}

	public function put ( $ty, $t, $d, $a, $n, $s, $o, $v, $h = null)
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

	public function opt ( $type, $a, $n, $s, $ov, $o, $h )
	{ 	
		// Set default value or retrive an old one if exists
		$s = _default_meta( $a, $n, $s );
		// Consolidate option paramaters into an array
		$opt = array_combine( array('name', 'array', 'saved', 'options', 'values' ), array( $n, $a, $s, $o, $ov ) );
		// Create a class basde on type and first name
		$class = "generate_" . $type;
		// Call option by creating new class ( the option is echoed from class construct )
		new $class( $opt, $this->params['id'], $this->params['class'] );
	}

	public function hider($h, $n)
	{
		if ( isset( $h ) )
		{	
			echo '<script>reveal.reveal( "#'.$this->params['id'].'-'.$h[0].'", "#'.$n.'-hook", '.$h[1].' );</script>';
		}
	}
}

?>