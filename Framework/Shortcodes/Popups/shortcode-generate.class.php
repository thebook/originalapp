<?php 
	
/**
* Fnction takes an array object, whose key is specified by the "popup" value passed with the plugin.js to the manifest.php
* based on this value options are created and event listeners for them by javascript
*/
class short
{
	var $val;
	var $key;
	/**
	 * Sets the $this->val variable and $this->key variable, so as to get the option array and the option to generate
	 * @param array $v The manifest array, this array holds all the shortcode option definitions
	 * @param string $k The key of the shortcode options to generate from the manifest array
	 */
	function __construct($v, $k)
	{			
		$this->val = $v[$k];
		$this->key = $k;
	}

	/**
	 * Generates option based on the $this->key['o'] array and gives it an id
	 * @param  string $type The type of option to create
	 * @param  string $text The option name as seen by user
	 * @param  string $desc The option description
	 * @param  string $id   The option element id,( this is used for the js )
	 * @param  array $val  If its a mutli opt option ( e.g "select" ) the $val array is used to give a name to each option
	 * @return HTML       Echos tr element with the option and td with the name and desc 
	 */
	public function options($type, $text, $desc, $id, $val = null)
	{	

		echo "<tr><th><strong>$text</strong><span>$desc</span></th>";

		echo '<td>';

		switch ( $type ) { 

			case 'text':
				
				echo "<input type='text' id='$id' />";		

				break;

			case 'textarea':
				
				echo "<textarea id='$id' ></textarea>";

				break;

			case 'select':
				
				echo "<select id='$id'>"; 

				foreach ($val as $l) {

					echo "<option>$l</option>";
				}

				echo '</select>';

				break; 		
		}	

		echo '</td></tr>';
	}

	/**
	 * Generates the script necesary to insert the shortcode into the editor, it takes the values of all the inputs and 
	 * fills in the appropriate shortcode variables with them upon insertion
	 * @param  array $j The array which holds all of the shortcode options
	 * @param  string $n The shorcode name, which would look like this ( [shortcodename ... ] );
	 * @return javascript    Class responsible for inserting the shortcode
	 */
	public function script( $j, $n )
	{ ?>
		<script>

		var lfDialog = {
		
			local_ed : 'ed',
				init : function( ed ) {
					lfDialog.local_ed = ed;
					tinyMCEPopup.resizeToInnerSize();
				},

			insert : function insertButton( ed ) {

				tinyMCEPopup.execCommand('mceRemoveNode', false, null);

				var o = '[<?php echo $n; ?> ';

					<?php foreach ($j as $key => $v) : ?>

					<?php $v = $v['id']; ?>

					o += '<?php echo $v; ?>="' + $('#<?php echo $v; ?>').val() + '" ' ;

					<?php endforeach; ?>

					o += ']';
				
					tinyMCEPopup.execCommand('mceReplaceContent', false, o );
					
					tinyMCEPopup.close();	
			}
		};

		tinyMCEPopup.onInit.add( lfDialog.init, lfDialog );

		</script>

<?php }

	/**
	 * Generates the body of the manifest ( i.e the pop up box ), and calls all the functions which init everything
	 * @return html the body of the whole popup box
	 */
	public function body()
	{ ?>
		<html>
			<head>
				<meta charset="UTF-8" content="text/html" http-equiv="Content-Typse">
				<?php include('./scripts.php'); ?>
				<style><?php include('./style.css'); ?></style>
				<?php $this->script( $this->val['o'], $this->val['shortcode'] ); ?>
			</head>
			<body>
				<div class="desc">
					<div class="title">
						<h1><?php echo $this->val['name']; ?></h1>
					</div>
					<div class="d">
						<p><?php echo $this->val['description']; ?></p>
					</div>
				</div>
				<table>
					<tbody>
						<?php $this->multi($this->val['o']); ?>
					</tbody>
				</table>
				<a href="javascript:lfDialog.insert(lfDialog.local_ed)" class="ins" >Insert</a>
			</body>
		</html>
<?php }
	
	/**
	 * Literates though an array of options uses the 'o' key to literate though arrays within it and calls the options() func
	 * @param  array $o An multi array
	 * @return function    calls the options function and passes arrays as paramaters
	 */
	public function multi($o)
	{
			
		if ( !is_array( $o ) ) return false;

		foreach ( $o as $op ) {

			call_user_func_array( array( $this, 'options' ), $op );	
		} 
	
	}
}

?>